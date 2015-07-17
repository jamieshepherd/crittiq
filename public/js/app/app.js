// Vue debugging (true/false)
Vue.config.debug = true;

// Loading overlay
$(window).load(function(){
    $('#loading').fadeOut(500);
})

// Convert any sliders to HTML
$('input[type="range"]').rangeslider({
    polyfill: true
});

$('#modal').click(function () {
    $('#modal').fadeOut(300);
    $('#account').fadeOut(300);
});
