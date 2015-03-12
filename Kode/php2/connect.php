<?php 
$connect = mysqli_connect("localhost", "root", "", "reservations"); 
// Evaluate the connection 
if (mysqli_connect_errno()) {
 echo mysqli_connect_error(); exit(); 
 } 
 ?>