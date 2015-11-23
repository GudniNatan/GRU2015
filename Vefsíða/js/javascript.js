//Jquery
$(document).ready(function(){

    //Notification ef villa kemur upp
	$(".notification").click(function(){
        $(".notification").fadeOut("fast");
    });
    if ($(".notification").text().length > 1) {
    	$(".notification").css("padding", "1em");
    }
    else{
        $(".notification").css("display", "none");
    };

    //Önnur hver lína í töflum með dekkri bakgrunn
    $( "tr#dagskra:odd, tr#skraning:odd" ).addClass("pure-table-odd");
    $( "tr:even" ).css("border", "1px solid rgb(203, 203, 203)");


    //Sýna meira takki á forsíðu
    var hidden = true;
    var initheight = $('.mainContent div').css('height');

    $('.more').click(function(e) {
        var h = $('.mainContent div')[0].scrollHeight;
        e.stopPropagation();
        if (hidden == true) {
            $('.mainContent div').animate({
                'height': h
            },{complete:function(){
                if (navigator.appVersion.indexOf("Chrome/") != -1) {
                    $('.mainContent div').animate({
                    'height': '100%'
                    })
                }
                if (navigator.appVersion.indexOf("Safari/") != -1) {
                    $('.mainContent div').animate({
                    'height': '100%'
                    })
                }
            }});
            hidden = false;
            $('.more').text("Sýna minna...");
        }
        else{
            $('.mainContent div').animate({
               'height': initheight
            })
            hidden = true;
            $('.more').text("Sýna meira...");
        };
        $('.mainContent div').toggleClass("textSolid").toggleClass("textGradient");
    });
});

//Kóði fyrir mobile nav
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