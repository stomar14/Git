<?php
// Database connection script
include("connect.php");

// Clean out expired reservations
$sql = "DELETE FROM confirms
        WHERE end_date < NOW()";
$freequery = mysqli_query($connect, $sql) or die (mysqli_error($connect));

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
    <div id="fadeIn">
        <a href="index.php">
            <img src="../images/favicon.png" alt="WesterdalsCK32" id="logoWesterdals">
        </a>

        <h1>Booking av grupperom - Christian Krohgs gate 32</h1>

        <div id="containerLeft">
            <form name="søk" action="search_page.php" method="POST">
                <p>Booking detaljer: </p>
                <label for="date">Når skal du booke?: </label><input id="date" type="date" name="date">
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
                                                                                              name="date_end">
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
                <label for="numberOfPeople">Hvor mange skal bruke rommet?: </label><input id="numberOfPeople"
                                                                                          type="number"
                                                                                          name="numberOfPeople" min="2"
                                                                                          max="4" value="2">
                <br/>
                <label for="Prosjektor">Trenger dere Prosjektor? <br/>Ja: </label><input id="Prosjektor" type="radio"
                                                                                         name="prosjektor" value="P">
                <label for="ikkeProsjektor">Nei: </label><input id="ikkeProsjektor" type="radio" name="prosjektor"
                                                                value="iP">
                <br/>
                <input id="confirmBtn" type="submit" name="submit" value="Søk">
            </form>
        </div>
        <div id="asapButton">
            <form name="søk" action="search_page.php" method="POST">
                <input class="asapBtn" type="submit" name="asapBtn" value=""/>
            </form>
        </div>
        <div id="containerRight">
            <img src="../images/D2_westerdals_01_v2 utentittel.jpg" alt="westerdalsIllustrasjon" height="420" width="800"/>
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