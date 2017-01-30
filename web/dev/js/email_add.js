var $collectionHolder;

var $addEmailLink = $('<button class="add_email_link glyphicon glyphicon-plus"></button>');
var $delEmailLink = $('<button class="del_email_link glyphicon glyphicon-minus"></button>');
var $newLinkLi = $('<div id="emailButton"></div>').append($addEmailLink).append($delEmailLink);

function addEmailForm($collectionHolder, $newLinkLi) {
    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = "";
    if (prototype !== undefined) {
        prototype.replace(/__name__/g, index);
    }
    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
}

jQuery(document).ready(function() {
    $collectionHolder = $('ul.emails');

    $collectionHolder.append($newLinkLi);

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    addEmailForm($collectionHolder, $newLinkLi);

    $('#form_validate').appendTo($('#emailButton'));

    $($delEmailLink).on('click',function (e) {
        e.preventDefault();
        $('ul li').last().remove();
    });

    $addEmailLink.on('click', function(e) {
        e.preventDefault();

        addEmailForm($collectionHolder, $newLinkLi);
    });
});