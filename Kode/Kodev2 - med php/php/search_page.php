<?php

include("connect.php");
//put info from form into variables
$prosjektor = $_POST['prosjektor'];
$nop = $_POST['numberOfPeople'];
$date = $_POST['date'];
$date_end = $_POST['date_end'];
// Get initial state of available rooms
$chart = "";
if ($prosjektor == 'P') {
    $sql = "SELECT * FROM available WHERE prosjektor = '1' AND storrelse >= '$nop'";
} else {
    $sql = "SELECT * FROM available
		  WHERE prosjektor = '0' AND storrelse >='$nop'";
};
$query = mysqli_query($connect, $sql) or die (mysqli_error($connect));
// Loop and get all the data
while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    // Assign room data to variables
    $id = $row['id'];
    $roomnum = $row['roomnum'];
    $avail = $row['avail'];
    $prosjektor = $row['prosjektor'];
    $etasje = $row['etasje'];
    $size = $row['storrelse'];
    //filter out booked rooms
    $sql = "SELECT * FROM confirms AS c JOIN available AS a ON c.roomnum=a.id WHERE a.id ='$roomnum' LIMIT 1";
    $query = mysqli_query($connect, $sql) or die (mysqli_error($connect));
    $start_date = $row['start_date'];
    $end_date = $row['end_date'];
    // Build display output
    // Display for rooms
    if ($start_date < $date & $date < $end_date) ;

    else if ($start_date < $date_end & $date_end < $end_date)
        $chart .= '<div class="full"><div class="roomText">' . $roomnum . ' is booked from ' . $start_date . ' to ' . $end_date . '.</div></div>';

    else if ($date < $start_date & $start_date < $date_end)
        $chart .= '<div class="full"><div class="roomText">' . $roomnum . ' is booked from ' . $start_date . ' to ' . $end_date . '.</div></div>';

    else if ($date < $start_date & $date_end > $end_date)
        $chart .= '<div class="full"><div class="roomText">' . $roomnum . ' is booked from ' . $start_date . ' to ' . $end_date . '.</div></div>';

    else if ($date < $start_date & $date_end < $end_date)
        $chart .= '<div class="full"><div class="roomText">' . $roomnum . ' is booked from ' . $start_date . ' to ' . $end_date . '.</div></div>';

    else if ($start_date < $date & $end_date < $date_end)
        $chart .= '<div class="full"><div class="roomText">' . $roomnum . ' is booked from ' . $start_date . ' to ' . $end_date . '.</div></div>';

    else
        $chart .= '<div class="available"><div id="tbl_' . $roomnum . '" class="roomText">' . $roomnum . ' er ledig i etasje ' . $etasje . ' med plass til ' . $size . ' personer.</div></div>';

}

$chart .= '<div class="clear">';

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
</head>

<body>
<div class="pageWrap">
    <a href="index.php">
        <img src="../images/favicon.png" alt="WesterdalsCK32" id="logoWesterdals">
    </a>

    <h1>Booking av grupperom - Christian Krohgs gate 32</h1>

    <div id="containerLeft">
        <form name="søk" action="reservator.php" method="GET">
            <p>Booking detaljer: </p>
            <label for="date">Når skal du booke?: </label><input id="date" type="date" name="date"
                                                                 pattern="[YYYY-mm-dd]" value="<?php echo $date ?>">
            <select id='time'>
                <option value="1">01:00</option>
                <option value="2">02:00</option>
                <option value="3">03:00</option>
                <option value="4">04:00</option>
                <option value="5">05:00</option>
                <option value="6">06:00</option>
                <option value="7">07:00</option>
                <option value="8">08:00</option>
                <option value="9">09:00</option>
                <option value="10">10:00</option>
                <option value="11">11:00</option>
                <option value="12">12:00</option>
                <option value="13">13:00</option>
                <option value="14">14:00</option>
                <option value="15">15:00</option>
                <option value="16">16:00</option>
                <option value="17">17:00</option>
                <option value="18">18:00</option>
                <option value="19">19:00</option>
                <option value="20">20:00</option>
                <option value="21">21:00</option>
                <option value="22">22:00</option>
                <option value="23">23:00</option>
                <option value="24">24:00</option>
            </select>
            <br/>
            <label for="date_end">Hvor lenge skal dere bruke rommet?: </label><br/><input id="date_end" type="date"
                                                                                     name="date_end"
                                                                                     pattern="[YYYY-mm-dd]"
                                                                                     value="<?php echo $date_end ?>">
            <select id='time_end'>
                <option value="1">01:00</option>
                <option value="2">02:00</option>
                <option value="3">03:00</option>
                <option value="4">04:00</option>
                <option value="5">05:00</option>
                <option value="6">06:00</option>
                <option value="7">07:00</option>
                <option value="8">08:00</option>
                <option value="9">09:00</option>
                <option value="10">10:00</option>
                <option value="11">11:00</option>
                <option value="12">12:00</option>
                <option value="13">13:00</option>
                <option value="14">14:00</option>
                <option value="15">15:00</option>
                <option value="16">16:00</option>
                <option value="17">17:00</option>
                <option value="18">18:00</option>
                <option value="19">19:00</option>
                <option value="20">20:00</option>
                <option value="21">21:00</option>
                <option value="22">22:00</option>
                <option value="23">23:00</option>
                <option value="24">24:00</option>
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