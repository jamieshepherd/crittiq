// Vue debugging (true/false)
Vue.config.debug = true;
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

// Get modal element
var $modal = $('#modal');

// Master Vue instance
var app = new Vue({

    el: '#page',

    created: function() {
        console.log("app created");
    },

    methods: {
        showLogin: function() {
            $modal.fadeIn(300);
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
});

// When modal is clicked, hide account
$modal.click(function () {
    $(this).fadeOut(300);
    $('#account').fadeOut(300);
});
