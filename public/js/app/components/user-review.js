/*
 * Vue: User review component
 */

var characterLimit = 250;

new Vue({

    el: '.user-review',
    data: {
        review: "",
        count: characterLimit
    },

    methods: {
        update: function(e) {
            var remaining = characterLimit - this.review.length;
            this.count = characterLimit - this.review.length + " characters";
            $('.character-count').css('color', '');
            if(remaining < 30) {
                // Make orange
                $('.character-count').css('color', '#f60');
                if(remaining < 0) {
                    // Make red
                    $('.character-count').css('color', '#f00');
                }
            }
        }
    },

    ready: function() {
        this.update();
    }

});

$('#user-review').click(function() {
    $(this).animate({ 'height': "150px" }, 300);
    $('.character-count').animate({ 'opacity': 1 }, 300);
});
