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
		echo "Database updated successfully";
	} else {
		echo "Error updating database: " . mysqli_error($conn);
	}
	}
}
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
			<legend>Booking Details: </legend>
			<label for="date">Når skal du booke?: </label><input id="date" type="datetime" name="date" pattern="[YYYY-mm-dd HH:MM]" value="YYYY-mm-dd HH:MM"">
			<br>
			<label for="date_end">Hvor lenge skal dere bruke rommet?: </label><input id="date_end" type="datetime" name="date_end" pattern="[YYYY-mm-dd HH:MM]" value="YYYY-mm-dd HH:mm">
			<br>
			<label for="numberOfPeople">Hvor mange skal bruke rommet?: </label><input id="numberOfPeople" type="number" name="numberOfPeople" min="2" max="4" value="2">
			<br>
			<label for="Prosjektor">Trenger dere Prosjektor? Ja: </label><input id="Prosjektor" type="radio" name="prosjektor" value="P">
			<label for="ikkeProsjektor">Nei: </label><input id="ikkeProsjektor" type="radio" name="prosjektor" value="iP">
			<br>
			<input id="confirmBtn" type="submit" name="submit">
		</fieldset>
	</form>
<div id="wrapper">
   <div id="header"></div>
   <div id="rom">

   </div>
</div>
</body>
</html>