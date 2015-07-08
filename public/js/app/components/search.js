$('.search-button').click(function() {
    $('#search').slideToggle(300, function() {
        //$('body').css({'overflow': 'hidden'});
        $('#search-input').focus();
    });
    $('#review-content').fadeToggle(300);
});
