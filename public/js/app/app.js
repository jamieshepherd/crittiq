// Vue debugging (true/false)
Vue.config.debug = true;
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

// Master Vue instance
new Vue({

    el: '#page',

    methods: {
        showLogin: function() {
            $('#modal').fadeIn(300);
            $('#account').fadeIn(300);
        },
        showAccountPanel: function() {
            $('.account-menu').slideToggle(150);
        }
    }

});

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

