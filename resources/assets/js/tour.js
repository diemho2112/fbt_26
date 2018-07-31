$(document).ready( function () {
    window.openBlock = function (event, blockName) {
        for (var i = 0; i < 3; i++) {
            $('.tabcontent')[i].style.display = "none";
        }
        var tablinks = $('.tablinks');
        for (var i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace("active", "");
        }
        document.getElementById(blockName).style.display = "block";
    };

    $('.defaultOpen').click();
});
