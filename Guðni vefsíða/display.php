<?php
	/*Sameiginleg skrá sem sínir allar línur úr medlimur með takka til að eyða röðinni (delelte.php) og 
	er með texatabox til að breyta línum (edit.php) */   
	try {
		$sql = "SELECT COUNT(id) AS count_id FROM medlimur";
		$result = $conn -> query($sql);
		while ($row = $result -> fetch()) {
			$checkcount[] = array($row['count_id']);
		}

		$select = "SELECT * FROM medlimur";
		$result = $conn -> query($select);
		while ($row = $result -> fetch()) {
			$pontun[] = array($row['id'], $row['nafn'] , $row['heimilisfang'], $row['netfang'], $row['simi'], $row['staerd'], $row['alegg']);
			}
	} catch (Exception $e) {
		echo "Bilaði + $e";
	}
 ?>
 <form  method="post" action="delete.php" id="medlimur">
	<table border="1">
		<tr>
			<th>ID</th>
			<th>Nafn</th>
			<th>Heimilisfang</th>
			<th>Netfang</th>
			<th>Sími</th>
			<th>Stærð</th>
			<th>Álegg</th>
		</tr>
		<?php
			foreach ($pontun as $entry) {
			 	echo "<tr><td>" . $entry[0] . "</td><td>" . $entry[1] . "</td><td>" . $entry[2] . "</td><td>" . $entry[3] . "</td><td>" . $entry[4] . "</td><td>" . $entry[5] . "</td><td>" . $entry[6] . "</td>";
				if ($checkcount[0][0] < 2) {
					echo '<td><button type="submit" disabled name="id" value="' . $entry[0] . '" formaction="delete.php">Eyða</button></td><tr>
				';
				}
				else{
					echo '<td><button type="submit" name="id" value="' . $entry[0] . '" formaction="delete.php">Eyða</button></td><tr>
				';
				}
			 	
			 } 
		 ?>
	</table>
</form>
<form action="edit.php" method="post" id="breytapontun">
<p>Breyta Pöntun (eftir ID)</p>
	<p><pre>
ID:		<input type="text" name="id">
Nafn:		<input type="text" name="nafn">
Heimilisfang:	<input type="text" name="heimilisfang">
Netfang:	<input type="text" name="netfang">
Símanúmer:	<input type="text" name="simi">
	</pre></p>
	<p>Stærð</p>
	<input type="radio" name="staerd" value="9"> 9 tommu - 1000kr <br>
	<input type="radio" name="staerd" value="12"> 12 tommu - 1500kr <br>
	<input type="radio" name="staerd" value="18"> 18 tommu - 2000kr <br>
  	<p>Álegg</p>
  	<p>
  	<input type="checkbox" name="alegg[]" value="skinka"> Skinka<br>
  	<input type="checkbox" name="alegg[]" value="ananas"> Ananas<br>
  	<input type="checkbox" name="alegg[]" value="pepperoni"> Pepperoni
  	</p>

	<input type="submit" value="Breyta Pöntun">
</form>