<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Grindakerfi Pure CSS">
        <meta name="author" content="Tækniskólinn - GJG">

        <title>Dub16</title>

<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
<!--[if lte IE 8]>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-old-ie-min.css">
<![endif]-->
<!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/grids-responsive-min.css">
<!--<![endif]-->
<link rel="shortcut icon" href="favicon.png" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="stilsida.css">
</head>

<body>


<div class="custom-wrapper pure-g" id="menu">
    <div class="pure-u-1 pure-u-md-1-3">
        <div class="pure-menu">
            <a href="index.html" class="pure-menu-heading custom-brand">Dub16</a>
            <a href="#" class="custom-toggle" id="toggle"><s class="bar"></s><s class="bar"></s></a>
        </div>
    </div>
    <div class="pure-u-1 pure-u-md-1-3">
        <div class="pure-menu pure-menu-horizontal custom-can-transform">
            <ul class="pure-menu-list">
                <li class="pure-menu-item"><a href="index.html" class="pure-menu-link">Dub16</a></li>
                <li class="pure-menu-item"><a href="dagskra.php" class="pure-menu-link">Dagskrá</a></li>
                <li class="pure-menu-item"><a href="#" class="pure-menu-link">Um okkur</a></li>
            </ul>
        </div>
    </div>
    <div class="pure-u-1 pure-u-md-1-3">
        <div class="pure-menu pure-menu-horizontal custom-menu-3 custom-can-transform">
           
        </div>
    </div>
</div>


<script>
(function (window, document) {
var menu = document.getElementById('menu'),
    WINDOW_CHANGE_EVENT = ('onorientationchange' in window) ? 'orientationchange':'resize';

function toggleHorizontal() {
    [].forEach.call(
        document.getElementById('menu').querySelectorAll('.custom-can-transform'),
        function(el){
            el.classList.toggle('pure-menu-horizontal');
        }
    );
};

function toggleMenu() {
    // set timeout so that the panel has a chance to roll up
    // before the menu switches states
    if (menu.classList.contains('open')) {
        setTimeout(toggleHorizontal, 500);
    }
    else {
        toggleHorizontal();
    }
    menu.classList.toggle('open');
    document.getElementById('toggle').classList.toggle('x');
};

function closeMenu() {
    if (menu.classList.contains('open')) {
        toggleMenu();
    }
}

document.getElementById('toggle').addEventListener('click', function (e) {
    toggleMenu();
});

window.addEventListener(WINDOW_CHANGE_EVENT, closeMenu);
})(this, this.document);

</script>

<div class="main">

        <section class="pure-g">
            <article class="pure-u-1 pure-u-md-1 pure-u-lg-16-24">
                <!-- nested row 1-->

                <section class="pure-g">
                    <div class="pure-u-1 pure-sm-17-24 pure-u-md-15-24 pure-u-lg-15-24">
                        <h1>Dagskrá</h1>
                    </div>

                    <div class="pure-u-1 pure-sm-7-24 pure-u-md-9-24 pure-u-lg-9-24">
                        
                    </div>
                </section>
                <!-- nested row 2-->
              <section class="pure-g">
                    <div class="pure-u-0-24 pure-sm-6-24 pure-u-md-6-24 pure-u-lg-6-24">

                    </div>
                    <div class="pure-u-1 pure-sm-18-24 pure-u-md-18-24 pure-u-lg-18-24">

                        <table class="pure-table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Dagur</th>
                                    <th>Klukkan</th>
                                    <th>Viðburður</th>
                                    <th>Staðsetning</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="pure-table-odd">
                                    <th>Dagur</th>
                                    <th>Klukkan</th>
                                    <th>Viðburður</th>
                                    <th>Staðsetning</th>
                                </tr>

                                <tr>
                                    <th>Dagur</th>
                                    <th>Klukkan</th>
                                    <th>Viðburður</th>
                                    <th>Staðsetning</th>
                                </tr>

                                <tr class="pure-table-odd">
                                    <th>Dagur</th>
                                    <th>Klukkan</th>
                                    <th>Viðburður</th>
                                    <th>Staðsetning</th>
                                </tr>

                                <tr>
                                    <th>Dagur</th>
                                    <th>Klukkan</th>
                                    <th>Viðburður</th>
                                    <th>Staðsetning</th>
                                </tr>

                                <tr class="pure-table-odd">
                                    <th>Dagur</th>
                                    <th>Klukkan</th>
                                    <th>Viðburður</th>
                                    <th>Staðsetning</th>
                                </tr>

                                <tr>
                                    <th>Dagur</th>
                                    <th>Klukkan</th>
                                    <th>Viðburður</th>
                                    <th>Staðsetning</th>
                                </tr>

                                <tr class="pure-table-odd">
                                    <th>Dagur</th>
                                    <th>Klukkan</th>
                                    <th>Viðburður</th>
                                    <th>Staðsetning</th>
                                </tr>

                                <tr>
                                    <th>Dagur</th>
                                    <th>Klukkan</th>
                                    <th>Viðburður</th>
                                    <th>Staðsetning</th>   
                                </tr>

                                <tr>
                                    <th>Dagur</th>
                                    <th>Klukkan</th>
                                    <th>Viðburður</th>
                                    <th>Staðsetning</th>
                                </tr>

                                 <tr>
                                    <th>Dagur</th>
                                    <th>Klukkan</th>
                                    <th>Viðburður</th>
                                    <th>Staðsetning</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </article>    
            <aside class="pure-u-1 pure-u-md-1 pure-u-lg-8-24">
            <img src="">

              
  
            </aside>
        </section><!-- end row 2 -->
        <!-- row 3 -->
        <footer class="pure-u-1">
            <p></p>
        </footer>
        <!-- javascript -->
        <script src=""></script>
</div>



</body>
</html>