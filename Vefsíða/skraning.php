<!DOCTYPE html>
<head>
    <title>Dub16</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GRU2L4U Vefsíða">
    <meta name="author" content="Guðni Natan Gunnarsson, Jóhann Rúnarsson, Óli Pétur Olsen">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-min.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/stilsida.css">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
    <nav class="custom-wrapper pure-g" id="menu">
        <div class="pure-u-1 pure-u-md-1-3">
            <div class="pure-menu">
                <a href="index.html" class="pure-menu-heading custom-brand"><img src="img/dub16-logo-bw.png"></a>
                <a href="#" class="custom-toggle" id="toggle"><s class="bar"></s><s class="bar"></s></a>
            </div>
        </div>
        <div class="pure-u-1 pure-u-md-1-3">
            <div class="pure-menu pure-menu-horizontal custom-can-transform">
                <ul class="pure-menu-list">
                    <li class="pure-menu-item"><a href="index.html" class="pure-menu-link">Forsíða</a></li>
                    <li class="pure-menu-item"><a href="dagskra.php" class="pure-menu-link">Dagskrá</a></li>
                    <li class="pure-menu-item"><a href="#" class="pure-menu-link">Myndir</a></li>
                    <li class="pure-menu-item"><a href="umokkur.html" class="pure-menu-link">Um okkur</a></li>
                </ul>
            </div>
        </div>
        <div class="pure-u-1 pure-u-md-1-3">
            <div class="pure-menu pure-menu-horizontal custom-menu-3 custom-can-transform">
            </div>
        </div>
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
				$adgangurID[] = array($row['ID'], $row['nafn'], $row['kennitala'], $row['simi']);
			}
		} catch (Exception $e) {
			echo "Bilun + $e + $fyrirspurn";
		}
		$GLOBALS['id'] = $adgangurID[0][0];
		$GLOBALS['nafn'] = $adgangurID[0][1];
		$GLOBALS['kennitala'] = $adgangurID[0][2];
		$GLOBALS['simi'] = $adgangurID[0][3];

		$GLOBALS['invalidID'] = "false";
		if (count($adgangurID) <= 0) {	//Er kennitala til í gagnagrunninum
			echo "Kennitala Röng<br>";
			$GLOBALS['invalidID'] = "true";
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
	if (isset($_POST['addevent']) && $GLOBALS['invalidID'] != "true") {	//ADDEVENT
		$kennitala = $_POST['kennitala'];

		try {

			$fyrirspurn = "SELECT ID FROM Medlimur WHERE kennitala ='" . $kennitala . "'";
			$result = $conn -> query($fyrirspurn);

			while ($row = $result -> fetch()) {
				$medlimur_id[] = array($row['ID']);	//Breyta þessu ef við bætum við fleiri skráningarhlutum
			}
			$vidburdur_id = $_POST['id'];

			$fyrirspurn = "INSERT INTO Skraning(vidburdur_id, medlimur_id) VALUES ('" . $vidburdur_id . "', '" . $medlimur_id[0][0] . "')";
			$conn->exec($fyrirspurn);
		} catch (Exception $e) {
			echo "Gat ekki bætt við nýjum viðburði";
		}
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
				$skradirVidburdir[0][0] = "n/a";
				$skradirVidburdir[0][1] = "n/a";
				$skradirVidburdir[0][2] = "n/a";
				$skradirVidburdir[0][3] = "n/a";
				if ($GLOBALS['invalidID'] != "true") {
					echo "Engir viðburðir skráðir á þessa kennitölu.";
				}
			}

			$fyrirspurn = "SELECT id , heiti FROM Vidburdur WHERE dagsetning > CURDATE()";

			$result = $conn -> query($fyrirspurn);
			while ($row = $result -> fetch()) {
				$allirVidburdir[] = array($row['id'], $row['heiti']);	//Breyta þessu ef við bætum við fleiri skráningarhlutum
			}

		}
		else{
			echo "Fann ekki kennnitölu. Ertu skráð/ur inn?";
		}
		
	} catch (Exception $e) {
		echo 'Bilaði';
	}
?>
</p>
<main>
	<div>
	<h2>Viðburðir sem þú ert skráð/ur á:</h2>
	 <form  class="pure-form" method="post" action="skraning.php" id="medlimur">
		<input type="hidden" name="delevent">
		<input type="hidden" name="login">
		<table class="pure-table">
			<thead>
				<tr>
					<th>Skráning nr.</th>
					<th>Viðburður ID</th>
					<th>Nafn á viðburði</th>
					<th>Dagsetning</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php			
				foreach ($skradirVidburdir as $entry) {
				 	echo "<tr id='skraning'><td>" . $entry[0] . "</td><td>" . $entry[1] . "</td><td>" . $entry[2] . "</td><td>" . $entry[3] . "</td>" . '<td><button type="submit" name="id" value="' . $entry[0] . '">Eyða</button></td></tr>
	';			 	
				 }
			 ?>
			 </tbody>
		</table>
		<?php
				if (isset($_POST['kennitala'])) {
					$kennitala = $_POST['kennitala'];
					echo '<input type="hidden" name="kennitala" ' . 'value="' . $kennitala . '">
	';
				}
		?>
	</form>
	</div>
	<div>
		<h2>Skráning á viðburði</h2>
		<form class="pure-form" method="post" action="skraning.php" id="skravidburd">
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
	</div>
	<div id="container">
		<div id="info">
			<h2>Nafn</h2>
			<p>
				<?php echo $GLOBALS['nafn'];  ?>
			</p>
			<h2>Kennitala</h2>
			<p>
				<?php echo $GLOBALS['kennitala'];  ?>
			</p>
			<h2>Sími</h2>
			<p>
				<?php echo $GLOBALS['simi'];  ?>
			</p>
		</div>
	</div>
</main>

<script src="js/javascript.js"></script>
</body>