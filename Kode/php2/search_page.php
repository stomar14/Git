<?php

include ("connect.php");
//put info from form into variables
$prosjektor = $_POST['prosjektor'];
$nop = $_POST['numberOfPeople'];
$date = $_POST['date'];
$date_end = $_POST['date_end'];
// Get initial state of available rooms
$chart = "";
if($prosjektor == 'P') {
	$sql = "SELECT * FROM available WHERE prosjektor = '1' AND storrelse >= '$nop'";
	} else {
	$sql = "SELECT * FROM available
		  WHERE prosjektor = '0' AND storrelse >='$nop'";
	};
$query = mysqli_query($connect, $sql) or die (mysqli_error($connect));
// Loop and get all the data
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
	// Assign room data to variables
	$id = $row['id'];
	$roomnum = $row['roomnum'];
	$avail = $row['avail'];
	$prosjektor = $row['prosjektor'];
    $etasje = $row['etasje'];
    $size = $row['storrelse'];
	// Build display output
	// Display for rooms
 /*if($date < date("Y-m-d H:i") < $date_end) {
	$sql = "UPDATE available SET avail='0' WHERE roomnum = '$roomnum'  ";*/
	if ($avail == 0){
        //Display for unavailable rooms
		$chart .= '<div class="full"><div class="roomText">'.$roomnum.' is taken.</div></div>';
	} else
		// Display for available rooms
		$chart .= '<div class="available"><div id="tbl_'.$roomnum.'" class="roomText">'.$roomnum.' er ledig i etasje '.$etasje.' med plass til '.$size.' personer.</div></div>';
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
	<form name="søk" action="reservator.php" method="POST">
		<fieldset>
			<legend>Booking Details: </legend>
			<label for="date">Når skal du booke?: </label><input id="date" type="datetime" name="date" pattern="[YYYY-mm-dd HH:MM]" value="<?php echo $date?>">
			<br>
			<label for="date_end">Hvor lenge skal dere bruke rommet?: </label><input id="date_end" type="datetime" name="date_end" pattern="[YYYY-mm-dd HH:MM]" value="<?php echo $date_end?>">
			<br>
			<label for="velgRom">Hvilket rom vil du booke?: </label><input id="velgRom" type="int" name="velgRom" pattern="[0-9]{1,2}" min="1" max="20">
			<br>
			<label for="name">Hvem booker?: </label><input id="name" type="text" name="name">
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