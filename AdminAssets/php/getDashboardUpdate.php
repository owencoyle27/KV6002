<?php
/**
 * script to get the values in the data base fro the dashbaord update and return them in JSON format
 * 
 * @author TOM Hegerty
 * @date 16/03/2021
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
function getUpdates($conn) {
    $query = "SELECT * FROM UserUpdates";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $results = array();

    //add each record to an array
    //there shoudl only ever be 1 row returned, a loop is used to 
    //handle the event there are two in the database and return only the newest
    if ($stmt) {
        while ($myLine = $stmt->fetchObject()) {
            array_push($results, "200");
            array_push($results, $myLine->updateID);
            array_push($results, $myLine->update_Message);
            array_push($results, $myLine->update_Date);
            array_push($results, $myLine->update_Image);
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
echo getUpdates($conn);



?>