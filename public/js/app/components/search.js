$('.search-button').click(function() {
    $('#search').slideToggle(300, function() {
        $('#search-input').focus();
    });
});
