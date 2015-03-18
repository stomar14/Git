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
		/*Update the database with newly available rooms
		$sql = "UPDATE available SET avail='1' WHERE roomnum LIKE '$id'";*/
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
	// Assign room data to variables
	$id = $row['id'];
	$roomnum = $row['roomnum'];
	$avail = $row['avail'];
	$prosjektor = $row['prosjektor'];
	// Build display output
	// Display for available rooms
	if ($avail == 0){
		$chart .= '<div class="full"><div class="numSeats">The room is taken.</div></div>';		
	} else {
		// Display for available rooms
		$chart .= '<div class="available"><div id="tbl_'.$id.'" class="numSeats">The room is available!</div></div>';		
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
	<form name="søk" action="search_page.php" method="POST">
		<fieldset>
			<legend>Booking Detaljer: </legend>
			<label for="date">Når skal du booke?: </label><input id="date" type="datetime" name="date" pattern="[YYYY-mm-dd HH:MM]">
			<br>
			<label for="date_end">Hvor lenge skal dere bruke rommet?: </label><input id="date_end" type="datetime" name="date_end" pattern="[YYYY-mm-dd HH:MM]">
			<br>
			<label for="numberOfPeople">Hvor mange skal bruke rommet?: </label><input id="numberOfPeople" type="number" name="numberOfPeople" min="2" max="4">
			<br>
			<label for="Prosjektor">Trenger dere Prosjektor? Ja: </label><input id="Prosjektor" type="radio" name="prosjektor" value="Prosjektor">
			<label for="ikkeProsjektor">Nei: </label><input id="ikkeProsjektor" type="radio" name="prosjektor" value="ikkeProsjektor">
			<br>
			<input id="confirmBtn" type="submit" name="submit">
		</fieldset>
	</form>
<div id="wrapper">
   <div id="header"></div>
   <div id="rom">
      <?php echo $chart; ?>   
   </div>
</div>
</body>
</html>