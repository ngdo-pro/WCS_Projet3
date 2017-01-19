/**
 * Created by damien on 17/01/17.
 */

var $city = $('#app_baptism_search_city');
// When sport gets selected ...
$(document).ready(function() {
    // ... retrieve the corresponding form.
    var $form = $(this).closest('form');
    var data = {};
    data[$city.attr('name')] = $city.val();
    // Submit data via AJAX to the form's action path.
    $.ajax({
        url : $form.attr('action'),
        type: 'post',//$form.attr('method'),
        data : data,
        success: function(html) {
            // Replace current position field ...
            $('#app_baptism_search_restaurant').replaceWith(
                // ... with the returned one from the AJAX response.
                $(html).find('#app_baptism_search_restaurant')
            );
            // Position field now displays the appropriate positions.
        }
    });
});

$city.change(function() {
    // ... retrieve the corresponding form.
    var $form = $(this).closest('form');
    // Simulate form data, but only include the selected sport value.
    var data = {};
    data[$city.attr('name')] = $city.val();
    // Submit data via AJAX to the form's action path.
    $.ajax({
        url : $form.attr('action'),
        type: $form.attr('method'),
        data : data,
        success: function(html) {
            // Replace current position field ...
            $('#app_baptism_search_restaurant').replaceWith(
                // ... with the returned one from the AJAX response.
                $(html).find('#app_baptism_search_restaurant')
            );
            // Position field now displays the appropriate positions.
        }
    });
});


