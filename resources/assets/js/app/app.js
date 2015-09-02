// Preloader
(function(){
    setTimeout(function(){
      $('#loading > #preloader').fadeIn();
    }, 1000);
    setTimeout(function(){
      $('#loading > #preloader').animate({ 'height': '80px'});
      $('#loading > #preloader > span').fadeIn();
    }, 5000);
})();

// Window load complete
$(window).load(function(){
    $('#loading').fadeOut(500);
    $('.showLogin').click(function(){
        showLogin();
    });
});
