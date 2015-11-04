<!DOCTYPE html>
<head>
    <title>Dub16</title>
    <link rel="stylesheet" type="text/css" href="css/stilsida.css">
    <link rel="stylesheet" type="text/css" href="css/stylesheet.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="GRU2L4U Vefsíða">
    <meta name="author" content="Guðni Natan Gunnarsson, Jóhann Rúnarsson, Óli Pétur Olsen">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-min.css">
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
<?php
    include 'dbcon.php';
    $fyrirspurn = "SELECT * FROM Vidburdur WHERE dagsetning > CURDATE()";

    $result = $conn -> query($fyrirspurn);
    while ($row = $result -> fetch()) {
        $Vidburdir[] = array($row['ID'], $row['heiti'], $row['dagsetning']);   //Breyta þessu ef við bætum við fleiri skráningarhlutum
    }
?>
<nav class="custom-wrapper pure-g" id="menu">
      <div class="pure-u-1 pure-u-md-1-3">
        <div class="pure-menu">
          <a href="#" class="pure-menu-heading custom-brand">Dub16</a>
          <a href="#" class="custom-toggle" id="toggle"><s class="bar"></s><s class="bar"></s></a>
        </div>
      </div>
      <div class="pure-u-1 pure-u-md-1-3">
        <div class="pure-menu pure-menu-horizontal custom-can-transform">
          <ul class="pure-menu-list">
            <li class="pure-menu-item"><a href="index.html" class="pure-menu-link">Forsíða</a></li>
            <li class="pure-menu-item"><a href="dagskra.php" class="pure-menu-link">Dagskrá</a></li>
            <li class="pure-menu-item"><a href="login.html" class="pure-menu-link">Innskrá</a></li>
            <li class="pure-menu-item"><a href="#" class="pure-menu-link">Myndir</a></li>
            <li class="pure-menu-item"><a href="#" class="pure-menu-link">Um okkur</a></li>
          </ul>
        </div>
      </div>
      <div class="pure-u-1 pure-u-md-1-3">
        <div class="pure-menu pure-menu-horizontal custom-menu-3 custom-can-transform">
        </div>
    </div>
</nav>
<div class="main">
    <form id="dagaval" class="pure-form" action="dagskra.php">
        <h2>Skoða dagskrá á völdu sviði</h2>
        <p>Frá:   <input type="date" name="fyrstiDagur"></p>
        <p>Til:   <input type="date" name="seinastiDagur"></p>
        <input type="submit" value="Velja Dagsetningar">
    </form>
    <h1>Dagskrá á döfinni</h1>
    <table class="pure-table" style="width: 100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Viðburður</th>
                <th>Dagur</th>
            </tr>
        </thead>
        <tbody>
        <?php           
            foreach ($Vidburdir as $entry) {
                echo "<tr><td>" . $entry[0] . "</td><td>" . $entry[1] . "</td><td>" . $entry[2] . "</td></tr>
";              
             }
         ?>
         </tbody>
    </table>
</div>


    <script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>