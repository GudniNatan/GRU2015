<?php //Always
	include "dbcon.php";
	session_start();

	$skradirVidburdir = array();
	if (isset($_POST['register']) != true) {
		if (isset($_POST['kennitala'])) {
			$kennitala = $_POST['kennitala'];
			if (isset($_POST['lykilord'])) {
				$lykilord =  $_POST['lykilord'];
				$sth = $conn->prepare('
				SELECT lykilord as hash
				FROM medlimur
				WHERE kennitala = :username
				LIMIT 1
				');
				$sth->bindParam(':username', $kennitala);
				$sth->execute();
				$user = $sth->fetch(PDO::FETCH_OBJ);
				if(!function_exists('hash_equals'))
				{
				    function hash_equals($str1, $str2)
				    {
				        if(strlen($str1) != strlen($str2))
				        {
				            return false;
				        }
				        else
				        {
				            $res = $str1 ^ $str2;
				            $ret = 0;
				            for($i = strlen($res) - 1; $i >= 0; $i--)
				            {
				                $ret |= ord($res[$i]);
				            }
				            return !$ret;
				        }
				    }
				}
				// Hashing the password with its hash as the salt returns the same hash
				if ( hash_equals($user->hash, crypt($lykilord, $user->hash)) ) {
					$GLOBALS['valid'] = "true";
			  		
				}
				else{
					echo "Rangt lykilorð eða kennitala. <a href='index.php'>Reyna aftur?</a>";
					$_SESSION["wronglogin"] = "true";
					header("Location: login.php");
					die();
				}
			}
			else{
				echo "Fann ekkert lykilorð. ";
				$_SESSION["wronglogin"] = "true";
				header("Location: login.php");
				die();
			}
		}
		else{
			echo "Fann ekki kennnitölu. Ertu skráð/ur inn? ";
			$_SESSION["wronglogin"] = "true";
			header("Location: login.php");
			die();
		}
	}
	if (isset($_POST['register'])) {
		if (isset($_POST['kennitala'])) {
			$kennitala = $_POST['kennitala'];

			if (checksumCheck($kennitala) != true) {
					$_SESSION["wronglogin"] = "true";
					$_SESSION["customerror"] = "Kennitala ekki rétt. Þarf að vera raunveruleg kennitala.";
					header("Location: login.php");
					die();
			}
		}
	}
	function checksumCheck($kt) {
	    $checksum = substr($kt,0,1)*3;
	    $checksum += substr($kt,1,1)*2;
	    $checksum += substr($kt,2,1)*7;
	    $checksum += substr($kt,3,1)*6;
	    $checksum += substr($kt,4,1)*5;
	    $checksum += substr($kt,5,1)*4;
	    $checksum += substr($kt,6,1)*3;
	    $checksum += substr($kt,7,1)*2;
	 
	    $moduloRem = 11-fmod($checksum,11);
	    if (($moduloRem == '11') && (substr($kt,8,1) === '0')) {
	        return true;
	    }
	    elseif ($moduloRem == 10) {
	        return false;
	    }
	    elseif ($moduloRem == substr($kt,8,1)) {
	        return true;
	    }
	    else {
	        return false;
	    }
	}
?>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="easybox/distrib.min.js"></script>
    <link rel="stylesheet" href="easybox/styles/default/easybox.min.css" type="text/css" media="screen" />
</head>
<body>
    <nav class="custom-wrapper pure-g" id="menu">
        <div class="pure-u-1 pure-u-md-1-3">
            <div class="pure-menu">
                <a href="index.php" class="pure-menu-heading custom-brand"><img src="img/dub16-logo-bw.png"></a>
                <a href="#" class="custom-toggle" id="toggle"><s class="bar"></s><s class="bar"></s></a>
            </div>
        </div>
        <div class="pure-u-1 pure-u-md-1-3">
            <div class="pure-menu pure-menu-horizontal custom-can-transform">
                <ul class="pure-menu-list">
                    <li class="pure-menu-item"><a href="index.php" class="pure-menu-link">Forsíða</a></li>
                    <li class="pure-menu-item"><a href="dagskra.php" class="pure-menu-link">Dagskrá</a></li>
                    <li class="pure-menu-item"><a href="myndir.html" class="pure-menu-link">Myndir</a></li>
                    <li class="pure-menu-item"><a href="umokkur.html" class="pure-menu-link">Um okkur</a></li>
                </ul>
            </div>
        </div>
        <div class="pure-u-1 pure-u-md-1-3">
            <div class="pure-menu pure-menu-horizontal custom-menu-3 custom-can-transform">
            </div>
        </div>
    </nav>
<main>
<p class="notification">
<?php
	function login($kennitala){
		include "dbcon.php";
		$adgangurID = array();

		$fyrirspurn = "SELECT ID, nafn, kennitala, simi FROM Medlimur WHERE kennitala = '" . $kennitala . "'";
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
		$GLOBALS['kennitala1'] = $adgangurID[0][2];
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

		$isunique = true;
		$kennitala2 = $_POST['kennitala'];
		$kennitala = $_POST['kennitala'];
		$nafn = $_POST['nafn'];
		$simi = $_POST['simi'];
		$lykilord = $_POST['lykilord'];

		$cost = 10;
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		$hash = crypt($lykilord, $salt);

		$fyrirspurn = "SELECT ID FROM Medlimur";
			$result = $conn -> query($fyrirspurn);

			while ($row = $result -> fetch()) {
				$medlimur_id[] = array($row['ID']);
		}
		foreach ($medlimur_id as $entry) {
			if ($kennitala == $entry[0]) {
				$isunique = false;
			}
		}
		if ($isunique == true) {	//Ef kennitala er ekki til
			$fyrirspurn = "INSERT INTO Medlimur(nafn, kennitala, simi, lykilord) VALUES ('" . $nafn . "', '" . $kennitala . "', '" . $simi ."', '" . $hash . "')";
			try {
				$conn->exec($fyrirspurn);

			} catch (Exception $e) {
				echo "Bilun + $e + $fyrirspurn";
			}

			login($kennitala);	//Loggar inn eftir að registera
		}
		else{
			$GLOBALS['invalidID'] = "true";
			$GLOBALS['kennitala1']  = "n/a";
			$GLOBALS['nafn'] = "n/a";
			$GLOBALS['simi'] = "n/a";

			echo "Þessi kennitala er núþegar skráð. <a href='login.php'>Reyna aftur?</a>";
		};
	}
	if (isset($_POST['addevent']) && $GLOBALS['invalidID'] != "true") {	//ADDEVENT
		$kennitala = $_POST['kennitala'];
		login($kennitala);

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
		$kennitala = $_POST['kennitala'];
		login($kennitala);
		$id =  $_POST['id'];
		try {
			$sql="DELETE FROM Skraning WHERE id='$id'";
			$conn->exec($sql);
		} catch (Exception $e) {
			echo "Bilaði + $e";
		}
	}
	try {	//Always

		$fyrirspurn = "SELECT Skraning.ID AS ID, Skraning.vidburdur_id AS vidburdur_id, Skraning.medlimur_id AS medlimur_id, Vidburdur.heiti as heiti, Vidburdur.dagsetning AS dagsetning FROM Skraning INNER JOIN Vidburdur ON Vidburdur.id = Skraning.vidburdur_id  INNER JOIN Medlimur ON Medlimur.id =  Skraning.medlimur_id WHERE Medlimur.kennitala = '" . $kennitala . "'";
		$result = $conn -> query($fyrirspurn);
		while ($row = $result -> fetch()) {
			$skradirVidburdir[] = array($row['ID'], $row['vidburdur_id'], $row['heiti'], $row['dagsetning']);	//Breyta þessu ef við bætum við fleiri skráningarhlutum
		}
		$fyrirspurn = "SELECT id , heiti FROM Vidburdur WHERE dagsetning > CURDATE()";
		$result = $conn -> query($fyrirspurn);
		while ($row = $result -> fetch()) {
			$allirVidburdir[] = array($row['id'], $row['heiti']);	//Breyta þessu ef við bætum við fleiri skráningarhlutum
		}
		if (count($skradirVidburdir) < 1) {
			$skradirVidburdir[0][0] = "n/a";
			$skradirVidburdir[0][1] = "n/a";
			$skradirVidburdir[0][2] = "n/a";
			$skradirVidburdir[0][3] = "n/a";
			if ($GLOBALS['invalidID'] != "true") {
				echo "Engir viðburðir skráðir.";
			}
		}
		foreach ($skradirVidburdir as $key) {
			$eventtime = strtotime($key[3]);
			$tomorrow = strtotime("tomorrow");
			$today = strtotime("today");
			if ($eventtime <= $tomorrow && $eventtime >= $today){
				echo "Athugið, " . $key[2] . " er á næsta leyti.";
			}
		}
	} catch (Exception $e) {
		echo 'Bilaði';
	}
?>
</p>
	<div>
	<h2>Viðburðir sem þú ert skráð/ur á:</h2>
	 <form  class="pure-form" method="post" action="skraning.php" id="medlimur">
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
		<?php
				if (isset($_POST['lykilord'])) {
						$kennitala = $_POST['lykilord'];
						echo '<input type="hidden" name="lykilord" ' . 'value="' . $lykilord . '">
		';
				}
		?>
		<input type="hidden" name="delevent">
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
			<?php
				if (isset($_POST['lykilord'])) {
						$kennitala = $_POST['lykilord'];
						echo '<input type="hidden" name="lykilord" ' . 'value="' . $lykilord . '">
		';
				}
			?>
			<select name="id" form="skravidburd">
			<?php
				$ekkert = true;
				foreach ($allirVidburdir as $entry) {
					$erskrad = false;
					foreach ($skradirVidburdir as $skrad) {
						if ($skrad[1] == $entry[0]){
							$erskrad = true;
						}
					}
					if ($erskrad == false) {
						echo '<option value="' . $entry[0] . '">' . $entry[1] . '</option>
			';
						$ekkert = false;
					}			 	
				}
				if ($ekkert) {
					echo "<option>Allir viðburðir skráðir.</option>";
				}
			?>
			</select>
			<input type="submit" <?php if ($ekkert) {echo "disabled style='color: gray'";} ?> value="Skrá viðburð">
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
				<?php echo $GLOBALS['kennitala1'];  ?>
			</p>
			<h2>Sími</h2>
			<p>
				<?php echo $GLOBALS['simi'];  ?>
			</p>
		</div>
	</div>
	<footer>
	        <p>2015, Allur réttur áskilinn</p>
	        <p>Guðni Natan Gunnarsson, Óli Pétur Olsen & Jóhann Rúnarsson</p>
	</footer>
</main>
<script src="js/javascript.js"></script>
</body>