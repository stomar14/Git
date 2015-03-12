<?php
// Database connection script
include ("connect.php");


// Clean out expired reservations
$clean = "SELECT c.*, a.avail
		  FROM confirms AS c
		  LEFT JOIN available AS a ON a.roomnum = c.roomnum
		  WHERE c.end_date < NOW()";
$freequery = mysqli_query($connect, $clean) or die (mysqli_error($connect));
$num_check = mysqli_num_rows($freequery);
if ($num_check != 0){
	while ($row = mysqli_fetch_array($freequery, MYSQLI_ASSOC)){
		$id = $row['roomnum'];			
		// Delete the reserves
		$sql = "DELETE FROM confirms WHERE roomnum='$id' LIMIT 1";
		$query = mysqli_query($connect, $sql);
		// Update the database with newly available rooms
		$sql = "UPDATE available SET avail='1' WHERE roomnum LIKE '$id'";
	if (mysqli_query($conn, $sql)) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . mysqli_error($conn);
	}
	}
}

// Get initial state of available rooms
$chart = "";
$sql = "SELECT * FROM available";
$query = mysqli_query($connect, $sql) or die (mysqli_error($connect));
// Loop and get all the data
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
	// Assign table data to variables
	$id = $row['id'];
	$roomnum = $row['roomnum'];
	$avail = $row['avail'];
	$prosjektor = $row['prosjektor'];
	// Build display output
	// Display for available rooms
	if ($avail == 0){
		$chart .= '<div class="full"><div class="numSeats">The room is taken.</div></div>';		
	} else {
		// Display for available rooms - clickable inner div
		$chart .= '<div class="available"><div id="tbl_'.$id.'" class="numSeats" onClick="showRoom(this.id)">The room is free!</div></div>';		
	}
}
$chart .= '<div class="clear">';
	
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="reservations.css">
<script src="reservations.js"></script>
</head>
<body>
	<form name="name"" action="reservator.php" method="POST">
		<fieldset>
			<legend>Booking Details: </legend>
			<label for="date">Når skal du booke?: </label><input id="date" type="datetime" name="date" pattern="[YYYY-MM-DD HH:MM:SS]">
			<br>
			<label for="date_end">Hvor lenge skal dere bruke rommet?: </label><input id="date_end" type="datetime" name="date_end" pattern="[YYYY-MM-DD HH:MM:SS]">
			<br>
			<label for="velgRom">Hvilket rom vil du booke?: </label><input id="velgRom" type="int" name="velgRom" pattern="[0-9]{1,2}" min="1" max="20">
			<br>
			<label for="numberOfPeople">Hvor mange skal bruke rommet?: </label><input id="numberOfPeople" type="number" name="numberOfPeople" min="2" max="5">
			<br>
			<label for="Prosjektor">Trenger dere Prosjektor? </label><input id="Prosjektor" type="checkbox" name="prosjektor" value="Prosjektor">
			<br>
			<label for="name">Hvem booker?: </label><input id="name" type="text" name="name">
			<br>
			<input id="confirmBtn" type="submit" name="submit" href="workplz.php" >
		</fieldset>
	</form>
<div id="wrapper">
   <div id="stage"></div>
   <div id="seats">
      <?php echo $chart; ?>   
   </div>
</div>
</body>
</html>