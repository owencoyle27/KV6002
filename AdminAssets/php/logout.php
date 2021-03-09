<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../adminPage.css">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Admin </title>
    <meta charset="utf-8">
</head>
<?php
// Always start this first
session_start();

// Destroying the session clears the $_SESSION variable, thus "logging" the user
// out. This also happens automatically when the browser is closed
session_destroy();
header("Refresh:0; url=../../Admin.php");
?>