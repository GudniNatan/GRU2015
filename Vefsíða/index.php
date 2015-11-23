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
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
        
        try {
            $fyrirspurn = "SELECT heiti, dagsetning, ummaeli, myndURL, id FROM Vidburdur WHERE dagsetning > CURDATE() ORDER BY dagsetning LIMIT 4";

            $result = $conn -> query($fyrirspurn);
            while ($row = $result -> fetch()) {
                $allirVidburdir[] = array($row['heiti'], $row['dagsetning'], $row['ummaeli'], $row['myndURL'], $row['id']);   //Breyta þessu ef við bætum við fleiri skráningarhlutum
            }

        }
        catch (Exception $e) {
            echo 'Bilaði';
        }
    ?></p>
    <div class="logoDiv">
        <img src="img/dub16-logo-bw.png">
    </div>
    <article class="mainContent">
        <h1>Fréttir</h1>
        <div class="textGradient">
            <p >Tómstundamiðstöðin sem þú vilt vera í. Við bjóðum upp á ýmsa viðburði af öllum gerðum í annari hverri viku og erum með opið hús alla þriðjudaga og fimmtudaga. <b>Dub16</b> er fyrir alla á aldrinum 16-20 ára.</p>
            <p>Hér sérðu bara brot af þeim fjölmörgu viðburðum sem við bjóðum upp á: </p>
            <p>Sagði einhver ís? það er allavega íspartý hjá <b>Dub16</b> í tilefni 20 ára afmæli Kjörísar. láttu sjá þig.</p>
            <p>Hver er ekki til í bíó hvar og hvenær sem er? Bara að látta þig vita að það styttist í Star Wars 7 og er <b>Dub16</b> með sér sýningu í Eigilshöll. Ef þú ert Star Wars aðdáandi þá er þetta eitthvað fyrir þig.</p>
            <p>Það verður jólalann í desember þegar skólinn hjá öllum er búinn og ég veit ekki hvað dagksráin var að fá sér í morgunmat en það er allavega ekki 22 maí það get ég sagt þér. Það verður 19 til 22 desember. ekki láta þig vanta.</p>
            <p>Bingó!! Það verður bingó veitingar og vinningar og bara allt.Stærsti vinningurinn er ný apple borðtölva frá epli.Það væri ekki leiðinlegt að fá eina þannig beint í vasann.</p>
            <p>Velkominn í <b>Dub16</b>.</p>
        </div>
        <a href="#" class="more pure-button pure-input-1 pure-button-primary">Sýna meira...</a>
    </article>
    <article class="events">
        <?php
            foreach ($allirVidburdir as $entry) {
                echo '<div class="contentDiv">
'; 
                echo '<p>' . $entry[0] . '</p>
'; 
                echo '<a href="dagskra.php#vidburdur1" class="pure-menu-heading custom-brand"><img src="' . $entry[3] . '"></a>
';
                echo '<p><a href="dagskra.php#vidburdur' . $entry[4] .'" class="pure-button pure-input-1 pure-button-primary">Lesa meira >></a></p>
';
                echo '</div>
'; 
            }
         ?>
    </article>
    <aside class="signInTabs">
        <div class="tabs">
            <div class="tab">
                <input type="radio" id="tab-1" name="tab-group-1" checked>
                <label for="tab-1">Innskrá</label>
                <div class="content">
                    <form id="login" action="skraning.php" method="post" class="pure-form" style="padding: 10px;">
                        <fieldset>
                            <input type="text" name="kennitala" placeholder="Kennitala" required pattern="\d{10}" title="Kennitala, engin bil eða bandstrik">
                        </fieldset>
                        <input type="hidden" name="login"> <!-- Segir PHP kóðanum hvað á að gera -->
                        <button type="submit" class="pure-button pure-input-1 pure-button-primary">Skrá inn</button>
                    </form>
                </div>
            </div>
            <div class="tab">
                <input type="radio" id="tab-2" name="tab-group-1">
                <label for="tab-2">Nýskrá</label>
                <div class="content">
                    <form id="register" action="skraning.php" method="post" class="pure-form" style="padding: 10px;">
                        <fieldset>
                            <input type="text" name="kennitala" placeholder="Kennitala" required pattern="\d{10}" title="Kennitala, engin bil eða bandstrik">
                            <input type="text" name="nafn" placeholder="Nafn" required>
                            <input type="text" name="simi" placeholder="Sími" required pattern="\d{7}" title="Sjö stafa símanúmer, engin bil eða bandstrik" >
                        </fieldset>
                        <input type="hidden" name="register"> 
                        <button type="submit" class="pure-button pure-input-1 pure-button-primary">Nýskrá</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </aside>
    <footer>
        <p>2015, Allur réttur áskilinn</p>
        <p>Guðni Natan Gunnarsson, Óli Pétur Olsen & Jóhann Rúnarsson</p>
    </footer>
</main>
    <script type="text/javascript" src="js/javascript.js"></script>
</body>
</html>