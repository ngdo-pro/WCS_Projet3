$(document).ready(function(){
    $('#guestConfirm').click(function(){ //when "reservation" button is clicked
        $('#guestNumberToValidate').text($('#appbundle_baptismhasuser_guestCount').val()); //pass the selected value to modal
    });
});