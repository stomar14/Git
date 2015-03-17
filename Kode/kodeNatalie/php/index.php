<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/bookingSystem.css">
		<!--<link rel="shortcut icon" href="../images/favicon.png" type="image/png"/>-->
		<link rel="icon" href="../images/favicon.png" type="image/png"/>
		<title>Westerdals CK32</title>
	</head>

	<body>
		<div class="pageWrap">
			<div id="blurOff">
				<a href="../php/index.php">
					<img src="../images/favicon.png" id="logo1">
				</a>
				<h1>Booking av grupperom - Christian Krohgs gate 32</h1>
				<div id="sokeBoks">
				        <form name="sok">
							<!--Velg dag-->
						    <label for="dato">Hvilken dag?</label>
							<input type="datetime-local" name="dato" pattern="[YYYY-mm-dd HH:MM]">
						    <br><br>
							
							<!--Antall studenter-->
						    <label for="antall">Studenter </label>
							<input type="number" name="antall" min="2" max="4">
						    <br><br>
							
							<!--Prosjektor-kryss-->
							
						    <input type="radio" name="prosjektor">Prosjektor
							<!--</label><input id="Prosjektor" type="radio" name="prosjektor" value="Prosjektor">-->
						    <br><br>
							
							<!--Søkeknapp-->
						    <input type="submit" value="SØK">
				        </form>
				</div>
				<div id="planWrap">
					<!--<img src="../images/plan1.jpg" id="1etg">-->
				</div>
			</div>
		</div>
                <footer>
                    <img src="../images/logoBw.png" id="footerLogo">
                    <br>
                    <pre><a href="tel:22057550">Tlf: 22 05 75 50</a>   <a href="mailto:post@westerdals.no">post@westerdals.no</a></pre>
                    <p>CopyRight Gruppe 9</p>
                </footer>
	</body>
</html>