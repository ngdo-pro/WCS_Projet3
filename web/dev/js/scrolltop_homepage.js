$(document).ready(function(){
    $('#homeHeader-knowMore').on('click', function(){
        $('html, body').animate({scrollTop: $('#conceptPresentation').offset().top - 120}, 1000);
    });
});