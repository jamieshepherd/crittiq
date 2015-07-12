/*
 * Vue: User review component
 */

var characterLimit = 250;

new Vue({

    el: '.user-review',
    data: {
        review: "",
        count: characterLimit,
        rangeCount: 5
    },

    methods: {
        update: function(e) {
            this.count = characterLimit - this.review.length;
            $('.character-count').css('color', '');
            if(this.count < 50) {
                // Make orange
                $('.character-count').css('color', '#f60');
                if(this.count < 10) {
                    // Make red
                    $('.character-count').css('color', '#f00');
                }
            }
        },
        open: function(e) {
            $('#user-review').animate({ 'min-height': "220px" }, 300);
            $('.user-review-actions').fadeIn(300);
            $('.character-count').css({ 'opacity': 1 }, 300);
        }
    },

    ready: function() {
        this.update();
    }

});
