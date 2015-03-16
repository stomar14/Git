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
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/bookingSystem.css">
		<link rel="shortcut icon" href="../images/favicon.png" type="image/png"/>
		<link rel="icon" href="../images/favicon.png" type="image/png"/>
		<title>Westerdals CK32</title>
	</head>

	<body>
		<div id="pageWrap">
			<div id="blurOff">
				<a href="../html/index.php">
					<img src="../images/logowesterdals-01.png" alt="WesterdalsCK32" id="logoWesterdals">
				</a>
				<div id="containerLeft">
				        <form name="søk" action="search_page.php" method="GET">
                            <p>Booking detaljer: </p>
						    <label for="date">Når skal du booke?: </label><input id="date" type="datetime-local" name="date" pattern="[YYYY-mm-dd HH:MM]">
						    <br>
						    <label for="date_end">Hvor lenge skal dere bruke rommet?: </label><input id="date_end" type="datetime-local" name="date_end" pattern="[YYYY-mm-dd HH:MM]">
						    <br>
						    <label for="numberOfPeople">Hvor mange skal bruke rommet?: </label><input id="numberOfPeople" type="number" name="numberOfPeople" min="2" max="4">
						    <br>
						    <label for="Prosjektor">Trenger dere Prosjektor? <br>Ja: </label><input id="Prosjektor" type="radio" name="prosjektor" value="Prosjektor">
						    <label for="notProsjektor">Nei: </label><input id="notProsjektor" type="radio" name="prosjektor" value="ikkeProsjektor">
						    <br>
						    <input id="confirmBtn" type="submit" name="submit">
				        </form>
				</div>
                <div id="asapButton">
                    <input type="image" src="../images/asapButton.JPG" />
                </div>
                <div id="footer">
                    <br>
                    <img src="../images/footerLogo.png" alt="footerLogo">
                    <br>
                    <pre><a href="tel:22057550">Telefon 22 05 75 50</a>   <a href="mailto:post@westerdals.no">post@westerdals.no</a></pre>
                    <p>Løsning laget av Gruppe 9</p>
                </div>
			</div>
		</div>
	</body>
</html>