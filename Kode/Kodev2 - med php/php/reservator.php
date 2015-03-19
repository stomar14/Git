<?php

include ("connect.php");


$velgRom = $_POST['velgRom'];
$name = $_POST['name'];
$dateAlone = $_POST['date'];
$timeAlone = $_POST['time'];
$date_endAlone = $_POST['date_end'];
$time_endAlone = $_POST['time_end'];
$date = date('Y-m-d H:i', strtotime("$dateAlone $timeAlone"));
$date_end = date('Y-m-d H:i', strtotime("$date_endAlone $time_endAlone"));


$tbl_insert = "INSERT INTO confirms (roomnum, start_date, end_date, navn)
	VALUES ('$velgRom', '$date', '$date_end', '$name')";
		$query = mysqli_query($connect, $tbl_insert);
	if ($query === TRUE) {
	        echo "<h3>Hei, $name! Du har booket rom $velgRom fra $date til $date_end. Hvis dette ikke er riktig, vennligst kontakt systemansvarlig!</h3>";
	    } else {
	        echo "<h3>Booking ikke fullført, prøv igjen. Hvis det fortsatt ikke funker, vennligst kontakt systemansvarlig!</h3>";
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
        h3 {
            text-align: center;
        }

        footer {
            bottom: -80px;
        }
    </style>
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
    <br/><br/>
    <h3>Rom oversikt:</h3>
        <div id="containerLast">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="100%">
                        <form name="mygallery">
                            <p>
                                <select name="picture" size="1" onChange="showimage()">
                                    <option selected value="../images/etgEn.jpg">1. Etasje</option>
                                    <option value="../images/etgTo.jpg">2. Etasje</option>
                                </select>
                            </p>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td width="100%"><p align="center"><img src="../images/etgEn.jpg" name="pictures"
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
