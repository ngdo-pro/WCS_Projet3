$(document).ready(function(){
    $('#triggerExplanation').on('click', function(e){
        e.preventDefault();
        $('#baptismChefExplanation-toggle').toggleClass('hidden');
        console.log('ok');
    });
});