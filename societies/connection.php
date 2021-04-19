<?php

function getConnection() //makes connection with database
{
    try {
        //$connection = new PDO("sqlite:C:\wamp64\www\TeamProject\db\database.db");
        $connection = new PDO("sqlite:../db/database.db");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connection;
    } catch (Exception $e) {
        throw new Exception("Connection error " . $e->getMessage(), 0, $e);
    }
}

?>
