<?php
 $host = "localhost";
 $username = "root";
 $password = "";
 $database = "adminpanel";  // Removed the space at the end

  // connection
  $con = mysqli_connect($host, $username, $password, $database);
  if (!$con) {
       header("Location:error/dp.php");
       die();
  }
  //  else {
  //   echo "Database connected";
  // }
?>
