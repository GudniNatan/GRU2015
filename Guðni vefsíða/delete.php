<!DOCTYPE html>
<head>
	<title>Skilaverkefni 2</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
	<?php
		include "dbcon.php";
		$id =  $_POST['id'];
		try {
			$sql="DELETE FROM medlimur WHERE id='$id'";
			$conn->exec($sql);
		} catch (Exception $e) {
			echo "Bilaði + $e";
		}
		include "display.php";
	?>
</body>