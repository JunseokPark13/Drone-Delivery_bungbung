<?php
  $db_ip = "localhost";
  $db_user = "qndqndqpscj";
  $db_password = "flyboong1024";
  $db = "flyawaymaindb";
  $conn = mysqli_connect($db_ip,$db_user,$db_password,$db);
  
  if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>
