Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

var path = window.location.pathname;

/*
 * Vue: User review component
 */

new Vue({

    el: '#review-content',
    data: {
        reviews: [],
        reviewsEmpty: false
    },

    ready: function() {
        this.$http.get('/api/v1' + path + '/reviews', function(response) {
            this.reviews = response;
        });

        var that = this;
        setInterval(function() {
            that.$http.get('/api/v1' + path + '/reviews', function(response) {
                that.reviews = response;
            });
        }, 15000);
    },

    computed: {
        noReviews: function() {
            if(this.reviews.length == 0) {
                return true;
            }
        }
    }

});
