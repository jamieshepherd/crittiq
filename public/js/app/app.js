// Vue debugging (true/false)
Vue.config.debug = true;

// Loading overlay
$(window).load(function(){ $('#loading').fadeOut(500); })

var mnavHeight = $('.mini-nav').height();

$('#search').css( {
    'height': $(window).height() - mnavHeight,
    'margin-top': mnavHeight
});
$('.content').css( {
    'height': $(window).height() - mnavHeight,
    'margin-top': mnavHeight
});
