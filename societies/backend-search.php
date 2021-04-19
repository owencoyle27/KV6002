<?php
  require_once "connection.php";
 
  // Search Query
try{
  if(isset($_REQUEST["term"])){
      $connection = getConnection();
      // Create prepared statement
      $sql = "SELECT society_Name FROM Societies WHERE society_Name LIKE :term";
      $stmt = $connection->prepare($sql);
      $term = $_REQUEST["term"] . '%';
      // Bind parameters to statement
      $stmt->bindParam(":term", $term);
      // Execute prepared statement
      $stmt->execute();
      if($stmt->rowCount() > 0){
          while($row = $stmt->fetch()){
              echo "<p>" . $row["society_Name"] . "</p>";
          }
      } else{
          echo "<p>No records found</p>";
      }
  }  
} catch(PDOException $e){
  die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

// Close statement and connection
unset($stmt);
unset($pdo);
?>