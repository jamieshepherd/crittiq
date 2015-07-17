/*
 * Vue: User review component
 */

new Vue({

    el: '.user-info',
    data: {

    },

    methods: {
        dropdown: function(e) {
            $('.account-menu').slideToggle(150);
        },
        openModal: function(e) {
            $('#modal').fadeIn(300);
            $('#account').fadeIn(300);
        }
    }

});
