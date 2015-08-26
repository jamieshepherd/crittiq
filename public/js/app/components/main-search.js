/*
 * Vue: Home search component
 */

new Vue({

    el: '#search',
    data: {
        query: '',
        nodes: []
    },

    methods: {
        search: function(event) {
            event.preventDefault();

            if(this.query.length < 1) {
                this.nodes = [];
                $("#modal").fadeOut();
                return false;
            }
            $("#modal").fadeIn();

            this.$http.get('/api/v1/films/search', { query: this.query }, function(response) {
                this.nodes = response;
            });

        }
    },

    computed: {
        minResults: function() {
            if(this.query.length > 1) {
                return true;
            }
        }
    }

});

$('.search-button').click(function() {
    $('#search').slideToggle(300, function() {
        $('#search-input').focus();
    });
});
