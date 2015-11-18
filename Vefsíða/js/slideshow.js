var img = document.getElementsByClassName('slideshowimage');
var imglength = img.length;
var imgnumber = 0;
var speed = 3000;

createbuttons();
changeimage();  //Til að stetja rétt properties á allt

document.getElementById("nextBtn").addEventListener("click", nextimage);
document.getElementById("prevBtn").addEventListener("click", lastimage);

var autoNextImage = setInterval(nextimage, speed);

function createbuttons() {  //Create buttons
    for (var i = 0; i < img.length; i++) {
        var link = document.createElement("a"); //Bý til link elementið
        link.className = "selectimage";
        link.textContent = (i+1).toString();
        var position = document.getElementsByClassName("imgselect")[0];  //Fynn staðsetningu link, set það efst í body-ið
        position.insertBefore(link, position.childNodes[i]); //Set link með inn í kóða
        link.addEventListener("click", setimage);
    };
};

function setimage (){
    imgnumber = Number(this.textContent)-1;

    changeimage();
    clearInterval(autoNextImage);
} 

function nextimage () {
    if (imgnumber == imglength - 1) {
        imgnumber = 0;
    }
    else{
        imgnumber++;
    };
    changeimage();
}
function lastimage () {
    if (imgnumber == 0) {
        imgnumber = imglength - 1;
    }
    else{
        imgnumber--;
    };
    changeimage();
    clearInterval(autoNextImage);
}

function changeimage(){
    for (var i = 0; i < img.length; i++) {
        if (i == imgnumber) {
            img[i].style.maxHeight = "40em";
            img[i].id = "visible";
        }
        else{
            img[i].id = "hidden";
        };

        var selectimage = document.getElementsByClassName('selectimage');

        if (imgnumber == Number(selectimage[i].textContent)-1) {
            selectimage[i].id = "current";
        }
        else{
            selectimage[i].id = "";
        };
    };
}