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
    $query = "UPDATE UserUpdates SET update_Message = 'test msg' WHERE updateID = 1";
    echo "inside testDB funtion";

    try {           
        $stmt = $conn->prepare($query);
        $stmt->execute();
        echo "inside testDB try";
    } 
    catch( PDOException $e ) {
        echo "Error: " . $e->getMessage();
        exit();
    }
}

$dbname = "db/database.db";
$conn = getDbConnection($dbname);
echo testDB($conn);