function showLogin() {
    showModal();
    $('#login').fadeIn(300);
    $('#modal').click(function() {
        hideModal();
    });
}
