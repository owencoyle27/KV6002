<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DBTest</title>
</head>
<body>
<p>test</p>
<?php

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

function testDB($conn) {
    $query = "SELECT * FROM Users";
    $stmt = $conn->prepare($query);
   
    $params = [];
    $stmt->execute($params);
   
    $output = "<h2> Users table </h2>";
    if ($stmt) {
        while ($myLine = $stmt->fetchObject()) {
            $output.= "<p>" . $myLine->username . " - " . $myLine->first_Name . "<br>" . $myLine->last_Name . "<br></p>";
        }
    } 
    else {
        $output = "<p>No data</p>";
    }
    return $output;
}

$dbname = "db/database.db";
$conn = getDbConnection($dbname);
echo testDB($conn);


?>

</body>
</html>