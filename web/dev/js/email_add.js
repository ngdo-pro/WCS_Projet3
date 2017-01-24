var $collectionHolder;

var $addEmailLink = $('<a href="#" class="add_email_link">Add a email</a>');
var $newLinkLi = $('<li></li>').append($addEmailLink);

function addEmailForm($collectionHolder, $newLinkLi) {
    var prototype = $collectionHolder.data('prototype');

    var index = $collectionHolder.data('index');

    var newForm = prototype.replace(/__name__/g, index);

    $collectionHolder.data('index', index + 1);

    var $newFormLi = $('<li></li>').append(newForm);
    $newLinkLi.before($newFormLi);
}

jQuery(document).ready(function() {
    $collectionHolder = $('ul.emails');

    $collectionHolder.append($newLinkLi);

    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addEmailLink.on('click', function(e) {
        e.preventDefault();

        addEmailForm($collectionHolder, $newLinkLi);
    });
});