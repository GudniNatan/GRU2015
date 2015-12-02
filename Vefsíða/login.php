<?php
session_start();
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
        if (isset($_SESSION["wronglogin"])) {
            echo "Röng kennitala eða lykilord. Reyndu aftur.";
        }
        session_destroy();
    ?></p>
    <div class="logoDiv">
        <img src="img/dub16-logo-bw.png">
    </div>
    <aside class="signInTabs">
        <div class="tabs">
            <div class="tab">
                <input type="radio" id="tab-1" name="tab-group-1" checked>
                <label for="tab-1">Innskrá</label>
                <div class="content">
                    <form id="login" action="skraning.php" method="post" class="pure-form">
                        <fieldset>
                            <input type="text" name="kennitala" placeholder="Kennitala" required pattern="\d{10}" title="Kennitala, engin bil eða bandstrik">
                            <input type="password" name="lykilord" placeholder="Lykilorð" required title="Lykilorð">
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
                    <form id="register" action="skraning.php" method="post" class="pure-form">
                        <fieldset>
                            <input type="text" name="kennitala" placeholder="Kennitala" required pattern="\d{10}" title="Kennitala, engin bil eða bandstrik">
                            <input type="password" name="lykilord" placeholder="Lykilorð" required title="Lykilorð">
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