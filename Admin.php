<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="AdminAssets/adminPage.css">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Admin </title>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src ="AdminAssets/filePreveiw.js"></script>

</head>

    <!--NAv by Matt Perez-->
    <div class ="nav">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="societies.html">Societies</a></li>
          <li><a href="map.html">Map</a></li>
          <li><a href="forum.html">Forum</a></li>
        </ul>
    </div> 
    
<?php

session_start();

/**
 * checks sesion data to esnure an admin is signed in, if NOT display login form, if so, load input forms
 * @author Tom Hegarty
 */
if ( isset( $_SESSION['user_id'] ) ) {
    //if user is signed in, show admin page
    echo '<div class="userBar"><p> Signed in As <b> ' . $_SESSION['user_id'] . '</b></p><form action="AdminAssets/php/logout.php" method="post"><input type="submit" value="log out"></form></div>';
   
    DashboardUpdate(); //dashbaord update form
    //!!!!add your forms in fucntions to keep this tidy

} else {
    //if no user is signed in, show login form
    echo '<form action="AdminAssets/php/loginProcess.php" id="SignInForm" method="post"><h2> Login to an Admin Account </h2><input type="text" name="username" placeholder="Enter your username" required><input type="password" name="password" placeholder="Enter your password" required><input type="submit" value="Submit"></form>';
}

function DashboardUpdate(){
    echo '<div class="DashboardUpdateOuter"><form action="AdminAssets/php/DashboardUpdate.php" method="post" enctype="multipart/form-data"><h2>Dashboard Message Update</h2><div class="DashFormRow1"><textarea id="campusUpdate" type="textarea" name="updateMessage" placeholder="enter update info" rows="4" cols="50" required></textarea><img id="preveiw" src="#" alt="Upload an Image" /></div><div class="DashFormRow2"><input type="text" name="date" id="date" placeholder="Enter date of update" required><input type="file" id="imgInput" name="filename" onchange="readURL(this)" required/></div><div class="DashFormRow3"><input id="dashSubmit" type="submit" value="Submit"></div></form></div>';
    }
?>

<script>
        /**
         * pre-populates the feilds to enter the campus update with current database info
         * @abstract
         * @author Tom Hegarty
         */
        $.ajax({
            url: "AdminAssets/php/getDashboardUpdate.php",
            success: function(result){
                console.log(result);
                let updateJSON = JSON.parse(result);
                //check if response is good
                if(updateJSON[0] == "200"){
                    document.getElementById("campusUpdate").value = updateJSON[2]; //message body
                    document.getElementById("date").value = updateJSON[3]; //mesage date
                    document.getElementById("preveiw").src = ("dashboard/images/"  + updateJSON[4]);
                }else{
                    //if no records are fetched, dont prepopulate feilds
                }
            }
        });


</script>