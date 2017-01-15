$(document).ready(function(){
    $('#guestConfirm').click(function(){
        $('#guestNumberToValidate').text($('#appbundle_baptismhasuser_guestCount').val());
    });
});