<?php

include("connect.php");
//put info from form into variables
$prosjektor = $_POST['prosjektor'];
$nop = $_POST['numberOfPeople'];
$dateAlone = $_POST['date'];
$timeAlone = $_POST['time'];
$date_endAlone = $_POST['date_end'];
$time_endAlone = $_POST['time_end'];
$date = date('Y-m-d H:i', strtotime("$dateAlone $timeAlone"));
$date_end = date('Y-m-d H:i', strtotime("$date_endAlone $time_endAlone"));
$asapButton = $_POST['asapBtn'];

// Get initial state of available rooms
$chart = "";
if(isset($asapButton)) {
    $sql = "UPDATE available AS a JOIN confirms AS c ON a.id=c.roomnum SET a.avail=0
WHERE c.start_date < NOW() < c.end_date";
    $query = mysqli_query($connect, $sql);
    $sql2 = "SELECT * FROM available";
    $query2 = mysqli_query($connect, $sql2) or die (mysqli_error($connect));
    while ($row = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
        // Assign table data to variables
        $id = $row['id'];
        $roomnum = $row['roomnum'];
        $avail = $row['avail'];
        $prosj = $row['prosjektor'];
        $size = $row['storrelse'];
        // Build display output
        // Display for available rooms
        if ($avail == 1) {
            if($prosj == 1) {
                $chart .= '<div class="available"><div id="tbl_' . $id . '" class="numSeats">' . $roomnum . ' er ledig! med plass til ' . $size . ' Prosjektor : Ja!</div></div>';
            } else{
                $chart .= '<div class="available"><div id="tbl_' . $id . '" class="numSeats">' . $roomnum . ' er ledig! med plass til ' . $size . ' Prosjektor: Nei!</div></div>';}
        } else {
        }

    }
} else {
    $sql = "UPDATE available AS a JOIN confirms AS c ON a.id=c.roomnum SET a.avail=0
WHERE c.start_date < '$date_end' < c.end_date
OR c.start_date > '$date'> c.end_date
OR '$date' < c.start_date < '$date_end'
OR '$date' < c.end_date < '$date_end'";
    $query = mysqli_query($connect, $sql);
    if ($prosjektor == 'P') {
        $sql = "SELECT * FROM available WHERE prosjektor = '1' AND storrelse >= '$nop'";
    } else {
        $sql = "SELECT * FROM available
		  WHERE prosjektor = '0' AND storrelse >='$nop'";
    };
    $query = mysqli_query($connect, $sql) or die (mysqli_error($connect));
// Loop and get all the data
    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        // Assign table data to variables
        $id = $row['id'];
        $roomnum = $row['roomnum'];
        $avail = $row['avail'];
        $prosj = $row['prosjektor'];
        $size = $row['storrelse'];
        // Build display output
        // Display for available rooms
        if ($avail == 0) {
            $chart .= '<div class="full"><div class="numSeats">' . $roomnum . ' er opptatt</div></div>';
        } else {
            // Display for available rooms - clickable inner div
            $chart .= '<div class="available"><div id="tbl_' . $id . '" class="numSeats">' . $roomnum . ' er ledig! med plass til ' . $size . '</div></div>';
        }
    }
}
$chart .= '<div class="clear">';


$sql = "UPDATE available SET avail = 1";
$query = mysqli_query($connect, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/bookingSystem.css">
    <link rel="icon" href="../images/favicon.png" type="image/png"/>
    <title>Westerdals CK32</title>
    <script type="text/javascript">
        var datefield = document.createElement("input");
        datefield.setAttribute("type", "date");
        if (datefield.type != "date") { //if browser doesn't support input type="date", load files for jQuery UI Date Picker
            document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n');
            document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n');
            document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n')
        }
    </script>

    <script>
        if (datefield.type != "date") { //if browser doesn't support input type="date", initialize date picker widget:
            jQuery(function ($) { //on document.ready
                $('#date').datepicker();
            })
        }
    </script>
    <script type="text/javascript">
        var datefield = document.createElement("input");
        datefield.setAttribute("type", "date");
        if (datefield.type != "date") { //if browser doesn't support input type="date", load files for jQuery UI Date Picker
            document.write('<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />\n');
            document.write('<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"><\/script>\n');
            document.write('<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"><\/script>\n')
        }
    </script>

    <script>
        if (datefield.type != "date") { //if browser doesn't support input type="date", initialize date picker widget:
            jQuery(function ($) { //on document.ready
                $('#date_end').datepicker();
            })
        }
    </script>
</head>

<body>
<div class="pageWrap">
    <a href="index.php">
        <img src="../images/favicon.png" alt="WesterdalsCK32" id="logoWesterdals">
    </a>

    <h1>Booking av grupperom - Christian Krohgs gate 32</h1>

    <div id="containerLeft">
        <form name="søk" action="reservator.php" method="POST">
            <p>Booking detaljer: </p>
            <label for="date">Når skal du booke?: </label><input id="date" type="date" name="date"
                                                                 pattern="[YYYY-mm-dd]"
                                                                 value="<?php echo $dateAlone ?>">
            <select id="time" name="time">
                <option value="01:00">01:00</option>
                <option value="02:00">02:00</option>
                <option value="03:00">03:00</option>
                <option value="04:00">04:00</option>
                <option value="05;00">05:00</option>
                <option value="06:00">06:00</option>
                <option value="07:00">07:00</option>
                <option value="08:00">08:00</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:00">19:00</option>
                <option value="20:00">20:00</option>
                <option value="21:00">21:00</option>
                <option value="22:00">22:00</option>
                <option value="23:00">23:00</option>
                <option value="24:00">24:00</option>
            </select>
            <br/>
            <label for="date_end">Hvor lenge skal dere bruke rommet?: </label><br/><input id="date_end" type="date"
                                                                                          name="date_end"
                                                                                          pattern="[YYYY-mm-dd]"
                                                                                          value="<?php echo $date_endAlone ?>">
            <select id="time_end" name="time_end">
                <option value="01:00">01:00</option>
                <option value="02:00">02:00</option>
                <option value="03:00">03:00</option>
                <option value="04:00">04:00</option>
                <option value="05;00">05:00</option>
                <option value="06:00">06:00</option>
                <option value="07:00">07:00</option>
                <option value="08:00">08:00</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:00">19:00</option>
                <option value="20:00">20:00</option>
                <option value="21:00">21:00</option>
                <option value="22:00">22:00</option>
                <option value="23:00">23:00</option>
                <option value="24:00">24:00</option>
            </select>
            <br/>
            <label for="velgRom">Hvilket rom vil du booke?: </label><input id="velgRom" type="int" name="velgRom"
                                                                           pattern="[0-9]{1,2}" min="1" max="20">
            <br/>
            <label for="name">Hvem booker?: </label><input id="name" type="text" name="name">
            <br/>
            <input id="confirmBtn" type="submit" name="submit" value="Book">
        </form>
    </div>
    <div id="containerRight">
        <?php echo $chart; ?>
    </div>
</div>
<footer>
    <img src="../images/footerLogo.png" alt="footerLogo">
    <br/>
    <pre><a href="tel:22057550">Telefon 22 05 75 50</a>   <a
            href="mailto:post@westerdals.no">post@westerdals.no</a></pre>
    <br/>

    <p>Løsning laget av Gruppe 9</p>
</footer>
</body>
</html>