    Vue.config.debug = true;

    var characterLimit = 250;

    new Vue({

        el: '.user-review',
        data: {
            review: "",
            count: characterLimit
        },

        methods: {
            update: function(e) {
                this.count = characterLimit - this.review.length;
            }
        }

    });

