var scrollSpeed = 70;
var step = 1;
var current = 0;
var imageWidth = 2247;
var headerWidth = 800;		

var restartPosition = -(imageWidth - headerWidth);

function scrollBg(){
        current -= step;
        if (current == restartPosition){
                current = 0;
        }

        jQuery('div .clouds').css("background-position",current+"px 0");
}

var init = setInterval("scrollBg()", scrollSpeed);