<!DOCTYPE html>
<head>
	<title>Skilaverkefni 2</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
	<?php
		include "dbcon.php";
		$nafn = $_POST['nafn'];
		$heimilisfang = $_POST['heimilisfang'];
		$netfang = $_POST['netfang'];
		$simi = $_POST['simi'];

		if (isset($_POST['staerd'])) {
			$staerd = $_POST['staerd'];
		}
		else{
			$staerd = "";
		}
		

		$aleggstrengur = "";
		if (isset($_POST['alegg'])) {
			foreach ($_POST['alegg'] as $álegg) {
				$aleggstrengur = $aleggstrengur . $álegg . " ";
			}
		}

		try {
			$sql = "INSERT INTO medlimur (`nafn`, `heimilisfang`, `netfang`, `simi`, `staerd`, `alegg`)
			VALUES ('$nafn', '$heimilisfang', '$netfang', '$simi', '$staerd', '$aleggstrengur')";
			$conn->exec($sql);
		} catch (Exception $e) {
			echo "Bilaði + $e";
		}
		include "display.php";
	?>
</body>