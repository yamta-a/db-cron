<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/

$conTo = mysqli_connect("host-address","username","password","database-name");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
