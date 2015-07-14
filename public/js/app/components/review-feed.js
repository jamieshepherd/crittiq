Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

var path = window.location.pathname;

/*
 * Vue: User review component
 */

new Vue({

    el: '#review-feed',
    data: {
        reviews: []
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
    }

});
