<?php
$con  = new mysqli("localhost","root","","server");

// Check connection
if ($con  -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>