Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

/*
 * Vue: User review component
 */

new Vue({

    el: '#search',
    data: {
        query: '',
        nodes: []
    },

    methods: {
        search: function(e) {
            event.preventDefault();

            if(this.query.length < 2) {
                this.nodes = [];
                return false;
            }

            var that = this;
            this.$http.get('/api/v1/films/search', { query: this.query }, function(response) {

                this.nodes = [];

                response.forEach(function(node) {
                    that.nodes.push(node);
                });

            })
        }
    }

});


$('.search-button').click(function() {
    $('#search').slideToggle(300, function() {
        //$('body').css({'overflow': 'hidden'});
        $('#search-input').focus();
    });
    //$('#review-content').slideToggle(300);
});
