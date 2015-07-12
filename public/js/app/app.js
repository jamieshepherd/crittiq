// Vue debugging (true/false)
Vue.config.debug = true;

// Loading overlay
$(window).load(function(){ $('#loading').fadeOut(500); })

// Convert any sliders to HTML
$('input[type="range"]').rangeslider();

// Show modal login
$('.login').click(function() {
    $('#page').css({
        'filter'         : 'blur(5px)',
        '-webkit-filter' : 'blur(5px)',
        '-moz-filter'    : 'blur(5px)',
        '-o-filter'      : 'blur(5px)',
        '-ms-filter'     : 'blur(5px)'
    });
    $('#modal').css({
        'opacity': 1
    });
});

$('#page').click(function() {
    $('#page').css({
        'filter'         : 'blur(0)',
        '-webkit-filter' : 'blur(0)',
        '-moz-filter'    : 'blur(0)',
        '-o-filter'      : 'blur(0)',
        '-ms-filter'     : 'blur(0)'
    });
    $('#modal').css({
        'opacity': 0
    });
});
