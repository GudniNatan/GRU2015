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
<main>
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
<p class="notification"><!-- Birtist ef ekki næst tenging við gagnagrunn -->
<?php
        include 'dbcon.php';
        
        if (isset($_POST['fyrstiDagur']) && isset($_POST['seinastiDagur'])) {
            $fyrstiDagur = $_POST['fyrstiDagur'];
            $seinastiDagur = $_POST['seinastiDagur'];
            $Vidburdir = array();

            $fyrirspurn = "SELECT * FROM Vidburdur WHERE dagsetning BETWEEN '" . $fyrstiDagur . "' AND '" . $seinastiDagur . "'";
    
            $result = $conn -> query($fyrirspurn);
            while ($row = $result -> fetch()) {
                $Vidburdir[] = array($row['ID'], $row['heiti'], $row['dagsetning'], $row['ummaeli'], $row['myndURL']);   //Breyta þessu ef við bætum við fleiri skráningarhlutum
            }

            if (count($Vidburdir) < 1) {
                $Vidburdir[] = array("n/a", "n/a", "n/a", "n/a");
                echo "Engir viðburðir skráðir á þessu tímabili.";
            }
        }
        else{
            $fyrirspurn = "SELECT * FROM Vidburdur WHERE dagsetning > CURDATE()";
    
            $result = $conn -> query($fyrirspurn);
            while ($row = $result -> fetch()) {
                $Vidburdir[] = array($row['ID'], $row['heiti'], $row['dagsetning'], $row['ummaeli'], $row['myndURL']);   //Breyta þessu ef við bætum við fleiri skráningarhlutum
            }
        }
    ?>
</p>
    <form id="dagaval" class="pure-form" action="dagskra.php" method="post">
        <h2>Skoða dagskrá á völdu sviði</h2>
        <p>Frá:   <input type="date" name="fyrstiDagur" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"></p>
        <p>Til:   <input type="date" name="seinastiDagur" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"></p>
        <input type="submit" class="pure-button" value="Velja Dagsetningar">
    </form>
    <article>
        <h1>Dagskrá á döfinni</h1>
        <table class="pure-table" style="width: 100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Viðburður</th>
                    <th>Dagur</th>
                    <th>...</th>
                </tr>
            </thead>
            <tbody>
            <?php           
                foreach ($Vidburdir as $entry) {
                    echo "<tr id='dagskra'><td>" . $entry[0] . "</td><td>" . $entry[1] . "</td><td>" . $entry[2] . "</td><td><a href='#vidburdur" . $entry[0] . "' class='lightbox'>Meira...</a></td></tr>
";              
                 }
             ?>
             </tbody>
        </table>
    </article>
    <footer>
        <p>2015, Allur réttur áskilinn</p>
        <p>Guðni Natan Gunnarsson, Óli Pétur Olsen & Jóhann Rúnarsson</p>
    </footer>
</main>
    <script type="text/javascript" src="js/javascript.js"></script>
    <?php
        foreach ($Vidburdir as $entry) {
        echo '<div id="vidburdur' . $entry[0] .'" class="lightboxcontainer"><img class="lightboximg" src="' . $entry[4] . '"><p>' . $entry[3] . '</p></div>';
        }
    ?>
</body>
</html>