<?php

header('Content-type: application/json');
/**
 * script to get the values in the data base fro the dashboard update and return them in JSON format
 *
 * @author Owen Coyle
 * @date 19/04/2021
 */

//connect to DB (this shoudl be seprated into its oen script)
function getDbConnection($dbname) {
    try {
        $dbConnection = new PDO('sqlite:'.$dbname);
    }
    catch( PDOException $e ) {
        echo "Database Connection Error: " . $e->getMessage();
        exit();
    }
    return $dbConnection;
}

//query the databse, retun JSON reults
function getBuildings($conn) {
    $query = "SELECT * FROM Buildings";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $results = array();

    //add each record to an array
    //there shoudl only ever be 1 row returned, a loop is used to
    //handle the event there are two in the database and return only the newest
    if ($stmt) {
        $building = array();
        while ($myLine = $stmt->fetchObject()) {
            array_push($building, $myLine->buildingID);
            array_push($building, $myLine->building_Name);
            array_push($building, $myLine->building_Opening_Time);
            array_push($building, $myLine->building_Closing_Time);
            array_push($building, $myLine->building_Long);
            array_push($building, $myLine->building_Lat);
            array_push($results, $building);
            $building = array();
        }
    }
    else {
        //if no resutls, reutn error code 500 for JS to handle
        array_push($results, "500");
    }
    return JSON_encode($results);
}

$dbname = "../../db/database.db";
$conn = getDbConnection($dbname);
echo getBuildings($conn);



?>