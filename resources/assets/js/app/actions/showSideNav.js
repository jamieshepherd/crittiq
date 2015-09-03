function showSideNav() {
    $('#search').slideToggle(300, function() {
        $(this).find(":input").focus();
    });
}
