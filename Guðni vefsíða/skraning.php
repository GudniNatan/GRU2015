<!DOCTYPE html>
<head>
	<title>Skilaverkefni 2</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<nav>
		<p>Dub16</p> <!-- Skipta út fyrir mynd -->
		<p><a href="#">Myndir</a></p>
		<p><a href="#">Viðburðir</a></p>
		<p><a href="#">Um Dub 16</a></p>

		<p><a href="#">Innskrá</a></p>
</nav>
<p class="notification">
<?php
	include "dbcon.php";

	function login($kennitala){
		include "dbcon.php";
		$adgangurID = array();

		$fyrirspurn = "SELECT * FROM Medlimur WHERE kennitala = '" . $kennitala . "'";
		try {
			$result = $conn -> query($fyrirspurn);

			while ($row = $result -> fetch()) {
				$adgangurID[] = array($row['ID']);
			}
		} catch (Exception $e) {
			echo "Bilun + $e + $fyrirspurn";
		}
		

		if (count($adgangurID) <= 0) {	//Er kennitala til í gagnagrunninum
			echo "Kennitala Röng<br>";
		}
	}

	if (isset($_POST['login'])) {	//LOGIN
		$kennitala =  $_POST['kennitala'];
		login($kennitala);
	}

	if (isset($_POST['register'])) {	//REGISTER

		$kennitala = $_POST['kennitala'];
		$nafn = $_POST['nafn'];
		$simi = $_POST['simi'];

		$fyrirspurn = "INSERT INTO Medlimur(nafn, kennitala, simi) VALUES ('" . $nafn . "', '" . $kennitala . "', '" . $simi ."')";
		try {
			$conn->exec($fyrirspurn);

		} catch (Exception $e) {
			echo "Bilun + $e + $fyrirspurn";
		}

		login($kennitala);	//Loggar inn eftir að registera
	}
	if (isset($_POST['addevent'])) {	//ADDEVENT
		echo "Gat ekki bætt við nýjum viðburði";
	}
	if (isset($_POST['delevent'])) {	//DELEVENT
		$id =  $_POST['id'];
		try {
			$sql="DELETE FROM Skraning WHERE id='$id'";
			$conn->exec($sql);
		} catch (Exception $e) {
			echo "Bilaði + $e";
		}
	}
	try {		
		$skradirVidburdir = array();

		if (isset($_POST['kennitala'])) {
			$kennitala = $_POST['kennitala'];

			$fyrirspurn = "SELECT Skraning.ID AS ID, Skraning.vidburdur_id AS vidburdur_id, Skraning.medlimur_id AS medlimur_id, Vidburdur.heiti as heiti, Vidburdur.dagsetning AS dagsetning FROM Skraning INNER JOIN Vidburdur ON Vidburdur.id = Skraning.vidburdur_id  INNER JOIN Medlimur ON Medlimur.id =  Skraning.medlimur_id WHERE Medlimur.kennitala = '" . $kennitala . "'";

			$result = $conn -> query($fyrirspurn);
			while ($row = $result -> fetch()) {
				$skradirVidburdir[] = array($row['ID'], $row['vidburdur_id'], $row['heiti'], $row['dagsetning']);	//Breyta þessu ef við bætum við fleiri skráningarhlutum
			}
			if (count($skradirVidburdir) < 1) {
				$skradirVidburdir[0][0] = "";
				$skradirVidburdir[0][1] = "";
				$skradirVidburdir[0][2] = "";
				$skradirVidburdir[0][3] = "";
				echo "Engir skráðir viðburðir.";
			}

			$fyrirspurn = "SELECT id , heiti FROM Vidburdur WHERE dagsetning > CURDATE()";

			$result = $conn -> query($fyrirspurn);
			while ($row = $result -> fetch()) {
				$allirVidburdir[] = array($row['id'], $row['heiti']);	//Breyta þessu ef við bætum við fleiri skráningarhlutum
			}

		}
		else{
			echo "Fann ekki kennnitölu. Ertu skráður inn?";
		}
		
	} catch (Exception $e) {
		echo 'Bilaði';
	}
?>
</p>
 <form  method="post" action="skraning.php" id="medlimur">
	<input type="hidden" name="delevent">
	<input type="hidden" name="login">
	<table border="1">
		<tr>
			<th>Skráning nr.</th>
			<th>Viðburður ID</th>
			<th>Nafn á viðburði</th>
			<th>Dagsetning</th>
		</tr>
		<?php
			if (isset($_POST['kennitala'])) {
				$kennitala = $_POST['kennitala'];
				echo '<input type="hidden" name="kennitala" ' . 'value="' . $kennitala . '">
';
			}
			
			foreach ($skradirVidburdir as $entry) {
			 	echo "<tr><td>" . $entry[0] . "</td><td>" . $entry[1] . "</td><td>" . $entry[2] . "</td><td>" . $entry[3] . "</td>" . '<td><button type="submit" name="id" value="' . $entry[0] . '">Eyða</button></td><tr>
';			 	
			 }
		 ?>
	</table>
</form>
<form method="post" action="skraning.php" id="skravidburd">
	<input type="hidden" name="addevent">
	<input type="hidden" name="login">
	<?php
		if (isset($_POST['kennitala'])) {
				$kennitala = $_POST['kennitala'];
				echo '<input type="hidden" name="kennitala" ' . 'value="' . $kennitala . '">
';
		}
	?>
	<select name="id" form="skravidburd">
	<?php
		foreach ($allirVidburdir as $entry) {
		echo '<option value="' . $entry[0] . '">' . $entry[1] . '</option>
';			 	
		}
	?>
	</select>
	<input type="submit" value="Skrá viðburð">
</form>
<script src="js/javascript.js"></script>
</body>