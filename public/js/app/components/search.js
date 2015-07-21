//Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

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
                return false;
            }

            this.$http.get('/api/v1/films/search', { query: this.query }, function(response) {
                this.nodes = response;
            });

        }
    },

    computed: {
        noResults: function() {
            if(this.query.length > 2) {
                if(this.nodes.length === 0) {
                    return true;
                }
            }
        }
    }

});


$('.search-button').click(function() {
    $('#search').slideToggle(300, function() {
        $('#search-input').focus();
    });
});
