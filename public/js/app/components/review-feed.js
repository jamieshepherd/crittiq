Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

/*
 * Vue: User review component
 */

new Vue({

    el: '#review-feed',
    data: {
        reviews: []
    },

    ready: function() {
        this.$http.get('/api/v1/films/interstellar/reviews', function(response) {
            this.reviews = response;
            console.log(this.reviews);
        });

        var that = this;
        setInterval(function() {
            that.$http.get('/api/v1/films/interstellar/reviews', function(response) {
                that.reviews = response;
            });
        }, 10000);
    }

});
