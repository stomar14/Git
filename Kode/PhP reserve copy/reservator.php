<?php
$servername = "localhost";
$username = "root";
$password = "Alexander12#";
$dbname = "reservations";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
include ("connect.php");


$velgRom = $_POST['velgRom'];
$date = $_POST['date'];
$date_end = $_POST['date_end'];
$name = $_POST['name'];

$tbl_insert = "INSERT INTO confirms (roomnum, start_date, end_date, navn)
	VALUES ('$velgRom', '$date', '$date_end', '$name')";
		$query = mysqli_query($connect, $tbl_insert);
	if ($query === TRUE) {
	        echo "<h3>Data inserted</h3>";
	    } else {
	        echo "<h3>NOT inserted</h3>";
    }
mysqli_close($conn);
?>
