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
        function showimage() {
            if (!document.images)
                return
            document.images.pictures.src =
                document.mygallery.picture.options[document.mygallery.picture.selectedIndex].value
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
            <form name="søk" action="search_page.php" method="GET">
                <p>Booking detaljer: </p>
                <label for="date">Når skal du booke?: </label><input id="date" type="date" name="date"
                                                                     pattern="[YYYY-mm-dd]" value="YYYY-mm-dd">
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
                <br/><br/>
                <label for="numberOfPeople">Hvor mange skal bruke rommet?: </label><input id="numberOfPeople"
                                                                                          type="number"
                                                                                          name="numberOfPeople" min="2"
                                                                                          max="4" value="2">
                <br/><br/>
                <label for="Projektor">Trenger dere Projektor? <br/>Ja: </label><input id="Projektor" type="radio"
                                                                                       name="projektor"
                                                                                       value="P">
                <label for="notProjektor">Nei: </label><input id="notProjektor" type="radio" name="projektor"
                                                              value="iP">
                <br/><br/>
                <input id="confirmBtn" type="submit" name="submit" value="Søk">
            </form>
        </div>
        <form name="søk" action="search_page.php" method="GET">
        <div id="asapButton">
            <input type="image" src="../images/asapButton.JPG"/>
        </div>
        </form>
        <div id="containerRight">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100%">
                        <form name="mygallery">
                            <p>
                                <select name="picture" size="1" onChange="showimage()">
                                    <option selected value="../images/etgTo.jpg">2. Etasje</option>
                                    <option value="../images/etgTre.jpg">3. Etasje</option>
                                </select>
                            </p>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td width="100%"><p align="center"><img src="../images/etgTo.jpg" name="pictures"
                                                            width="690" height="400"></td>
                </tr>
            </table>
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