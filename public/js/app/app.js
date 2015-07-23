// Vue debugging (true/false)
Vue.config.debug = true;

// Show the preloader if it's been loading for more than 1 second
setTimeout(function(){
  $('#loading > #preloader').fadeIn();
}, 1000);
setTimeout(function(){
  $('#loading > #preloader').animate({ 'height': '80px'});
  $('#loading > #preloader > span').fadeIn();
}, 5000);

// Loading overlay
$(window).load(function(){
    $('#loading').fadeOut(500);
})

// Convert any sliders to HTML
$('input[type="range"]').rangeslider({ polyfill: false });

// When modal is clicked, hide account
$('#modal').click(function () {
    $('#modal').fadeOut(300);
    $('#account').fadeOut(300);
});

// Logo on black or white
BackgroundCheck.init({
  targets: '.logo',
  images: '.cover',
  threshold: 70
});
