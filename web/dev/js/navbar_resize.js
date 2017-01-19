$(function(){
    $(window).scroll(function(){
        if ($(document).scrollTop() > 125) {
            $('.navbar').css('background', 'rgba(0, 0, 0, 0.7');
            $('.navbar img').height('80px');
        } else {
            $('.navbar').css('background', 'transparent');
            $('.navbar img').height('117px');
        }
    });
});