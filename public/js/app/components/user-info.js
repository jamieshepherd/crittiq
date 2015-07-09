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
        }
    }

});
