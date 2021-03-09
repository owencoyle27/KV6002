
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

if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
        // Getting submitted user data from database

        $username = $_POST['username'];
        $password = $_POST['password'];
        $dbname = "../../db/database.db";

        try {           
            $conn = new PDO('sqlite:'.$dbname);
        } catch( PDOException $e ) {
            echo "Database Connection Error: " . $e->getMessage();
            exit();
        }

        $params = ["username" => "$username"];
        $query = "SELECT * FROM Users WHERE username = :username";
   
        
        $stmt = $conn->prepare($query);
        $stmt->execute($params); 


        if ($stmt) {
            while ($myLine = $stmt->fetchObject()) {
                $user =  $myLine->username;
                $password =  $myLine->password;
                $userID = $myLine->username;
                $admin = $myLine->admin;
            }
        } 

    	// Verify user password and set $_SESSION
    	if ( password_verify( $_POST['password'], $password ) ) {
            if($admin == 1 ){
                $_SESSION['user_id'] = $userID;
                header("Refresh:0; url=../../Admin.php");
            }else{
                echo "<div class='loginmessageBox'><h2>you must be an administator to view this page</h2></div>";
                header("Refresh:2; url=../../Admin.php");
            }
    	} else {
            echo "<div class='loginmessageBox'><h2>incorect login details, please try again</h2></div>";
            header("Refresh:2; url=../../Admin.php");
        }

    }
}
?>