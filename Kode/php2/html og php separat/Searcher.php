<?php

include ("connect.php");
//put info from form into variables
$prosjektor = $_POST['prosjektor'];
$nop = $_POST['numberOfPeople'];
$date = $_POST['date'];
$date_end = $_POST['date_end'];
//find unavailable rooms
$sql = "UPDATE available AS a LEFT JOIN confirms AS c ON a.id=c.roomnum SET a.avail = '0'
WHERE c.start_date < '$date_end' < c.end_date OR c.start_date > '$date'> c.end_date
OR '$date' < c.start_date < '$date_end'
OR '$date' < c.end_date < '$date_end'
OR ";
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
    if ($avail == 0){
        //Display for unavailable rooms
        $chart .= '<div class="full"><div class="roomText">'.$roomnum.' is taken.</div></div>';
    } else
        // Display for available rooms
        $chart .= '<div class="available"><div id="tbl_'.$roomnum.'" class="roomText">'.$roomnum.' er ledig i etasje '.$etasje.' med plass til '.$size.' personer.</div></div>';
}

$chart .= '<div class="clear">';

?>