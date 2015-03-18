<?php
// Database connection script
include("connect.php");


// Clean out expired reservations
$clean = "SELECT c.*, a.avail
		  FROM confirms AS c
		  LEFT JOIN available AS a ON a.roomnum = c.roomnum
		  WHERE c.end_date < NOW()";
$freequery = mysqli_query($connect, $clean) or die (mysqli_error($connect));
$num_check = mysqli_num_rows($freequery);
if ($num_check != 0) {
    while ($row = mysqli_fetch_array($freequery, MYSQLI_ASSOC)) {
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/bookingSystem.css">
    <link rel="icon" href="../images/favicon.png" type="image/png"/>
    <title>Westerdals CK32</title>
    <style>
        footer {
            bottom: -200px;
        }
    </style>
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
    <div id="blurOff">
        <a href="index.php">
            <img src="../images/favicon.png" alt="WesterdalsCK32" id="logoWesterdals">
        </a>

        <h1>Booking av grupperom - Christian Krohgs gate 32</h1>

        <div id="containerLeft">
            <form name="søk" action="search_page.php" method="GET">
                <p>Booking detaljer: </p>
                <label for="date_start">Når skal du booke?: </label><input id="date_start" type="date" name="date_start"
                                                                           pattern="[dd-mm-YYYY]">
                <br/>
                <label for="date_end">Hvor lenge skal dere bruke rommet?: </label><br/><input id="date_end" type="date"
                                                                                              name="date_end"
                                                                                              pattern="[dd-mm-YYYY]">
                <br/>
                <label for="numberOfPeople">Hvor mange skal bruke rommet?: </label><input id="numberOfPeople"
                                                                                          type="number"
                                                                                          name="numberOfPeople" min="2"
                                                                                          max="4">
                <br/>
                <label for="Projektor">Trenger dere Projektor? <br/>Ja: </label><input id="Projektor" type="radio"
                                                                                       name="projektor"
                                                                                       value="Projektor">
                <label for="notProjektor">Nei: </label><input id="notProjektor" type="radio" name="projektor"
                                                              value="ikkeProjektor">
                <br/>
                <input id="confirmBtn" type="submit" name="submit" value="Søk">
            </form>
        </div>
        <div id="asapButton">
            <input type="image" src="../images/asapButton.JPG"/>
        </div>
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