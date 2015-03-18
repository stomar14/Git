<?php

include ("connect.php");


$velgRom = $_POST['velgRom'];
$date = $_POST['date'];
$date_end = $_POST['date_end'];
$name = $_POST['name'];

$tbl_insert = "INSERT INTO confirms (roomnum, start_date, end_date, navn)
	VALUES ('$velgRom', '$date', '$date_end', '$name')";
		$query = mysqli_query($connect, $tbl_insert);
	if ($query === TRUE) {
	        echo "<h3>Hei, $name! Du har booket rom $velgRom fra $date til $date_end. Hvis dette ikke er riktig, vennligst kontakt systemansvarlig!</h3>";
	    } else {
	        echo "<h3>Booking ikke fullført, prøv igjen. Hvis det fortsatt ikke funker, vennligst kontakt systemansvarlig!</h3>";
    }
?>
