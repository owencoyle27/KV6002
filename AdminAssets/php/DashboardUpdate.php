<?php
/**
 * script to prcess new updates to the Dashbaord headline message, and save uploaded image to the server
 * 
 * @author Tom Hegarty
 */

$updateMessage = filter_var($_POST["updateMessage"], FILTER_SANITIZE_STRING);
$updateDate = filter_var($_POST["date"], FILTER_SANITIZE_STRING);;

//connect to DB (this coudld be seprated into its own script) 
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
/**
 * function to handle submission of new dasbaord headline updates, savign to database 
 * 
 * @param $conn {PDO db connectin}
 * @param $updateMessage {String} - message body text
 * @param $updateDate {String}
 */
function updateMessage($conn, $updateMessage, $updateDate) {


    //image uplaod handling
    $target_dir = "../../dashboard/images/"; //set file to save image into
    $target_file = $target_dir . basename($_FILES["filename"]["name"]); //file uplaoded through form
    $check = 1; //check if file is suitable 
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $imageNameType = ("updateImage" . "." . strtolower(pathinfo($target_file,PATHINFO_EXTENSION)));

    $params = ["Updmessage" => "$updateMessage", "Upddate" => "$updateDate", "ImageName" => "$imageNameType"];
    $query = "UPDATE UserUpdates SET update_Message = :Updmessage , update_Date = :Upddate, update_Image = :ImageName WHERE updateID = 1";
    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    
    // Check if image file is a actual image or other file type
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["filename"]["tmp_name"]);
      if($check !== false) {
        $check = 1;
      } else {
        echo "<p class='updateError'>Please ensure that file is an image.</p>";
        $check = 0;
      }
    }
    
    // Check file size
    //1MB
    if ($_FILES["filename"]["size"] > 10000000) {
      echo "<p class='updateError'>File size too large, please keep images below 500kB to ensure page loads quickly</p>";
      $check = 0;
    }
    
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "<p class='updateError'>please ensure correct fyle type, only JPG, PNG & GIF files are allowed.</p>"; //change
      $check = 0;
      header("Refresh:1; url=../../Admin.php");
    }
    
    // Check if $uploadOk is set to 0 by an error
    if ($check== 0) {
      echo "<p class='updateError'>Sorry, there was an error saving the update, please try again</p>";
      header("Refresh:1; url=../../Admin.php");
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["filename"]["tmp_name"], $target_dir . "updateImage".".". $imageFileType)) {
        echo "<p class='updateError'>Success: dashbaord headline message has been updated</p>";
        header("Refresh:1; url=../../Admin.php");
      } else {
        echo "<p class='updateError'>Sorry, there was an error updating the dashboard please try again.</p>";
        header("Refresh:1; url=../../Admin.php");
      }
    }
}

$dbname = "../../db/database.db";
$conn = getDbConnection($dbname);
updateMessage($conn, $updateMessage, $updateDate);
?>


<style>

    .updateError{
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 130%;
        width: 100%;
        text-align: center;
        padding: 100px 20%;
    }
</style>