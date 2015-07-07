$('.search-button').click(function() {
    $('#search').fadeToggle(500, function() {
        $('#search-input').focus();
    });
});
