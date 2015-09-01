// Vue debugging (true/false)
'use strict';

Vue.config.debug = true;
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

// Get modal element
var $modal = $('#modal');

// Master Vue instance
var app = new Vue({

    el: '#page',

    methods: {
        showLogin: function showLogin() {
            $modal.fadeIn(300);
            $('#account').fadeIn(300);
        },
        showAccountPanel: function showAccountPanel() {
            $('.account-menu').slideToggle(150);
        }
    }

});

// Show the preloader if it's been loading for more than 1 second
setTimeout(function () {
    $('#loading > #preloader').fadeIn();
}, 1000);
setTimeout(function () {
    $('#loading > #preloader').animate({ 'height': '80px' });
    $('#loading > #preloader > span').fadeIn();
}, 5000);

// Loading overlay
$(window).load(function () {
    $('#loading').fadeOut(500, function () {
        $(this).remove();
    });
});

// When modal is clicked, hide account
$modal.click(function () {
    $(this).fadeOut(300);
    $('#account').fadeOut(300);
});
"use strict";
'use strict';

var path = window.location.pathname;
var characterLimit = 250;

/*
 * Vue: User review component
 */

new Vue({

    el: '#review-content',
    data: {
        reviews: [],
        review: "",
        count: characterLimit,
        rangeCount: 5,
        filter: 'latest',
        skip: 0
    },

    ready: function ready() {
        this.updateCounter();
        this.getReviews();
    },

    methods: {
        updateCounter: function updateCounter() {
            this.count = characterLimit - this.review.length;
            $('.character-count').css('color', '');
            if (this.count < 50) {
                // Make orange
                $('.character-count').css('color', '#f60');
                if (this.count < 10) {
                    // Make red
                    $('.character-count').css('color', '#f00');
                }
            }
        },
        showActions: function showActions() {
            $('#user-review').animate({ 'min-height': "220px" }, 300);
            $('.user-review-actions').fadeIn(300);
            $('.character-count').css({ 'opacity': 1 }, 300);
        },
        getReviews: function getReviews() {
            this.skip = 0;
            this.$http.get('/api/v1' + path + '/reviews', { filter: this.filter, skip: this.skip }, function (response) {
                this.reviews = response;
            });
        },
        getMoreReviews: function getMoreReviews() {
            this.skip += 10;
            this.$http.get('/api/v1' + path + '/reviews', { filter: this.filter, skip: this.skip }, function (response) {
                this.reviews.push.apply(this.reviews, response);
            });
        },
        sortBy: function sortBy(sortKey) {
            this.filter = sortKey;
            this.reviews = this.getReviews();
        },
        thumbsUp: function thumbsUp(id) {
            console.log("hey");
            console.log(id);
        }
    }

});
/*
 * Main search component
 */

'use strict';

var MainSearch = React.createClass({
    displayName: 'MainSearch',

    getInitialState: function getInitialState() {
        return {
            query: '',
            nodes: []
        };
    },

    getResults: function getResults() {
        var that = this;
        reqwest({
            url: 'api/v1/films/search',
            method: 'get',
            data: {
                query: this.state.query,
                take: 5
            },
            success: function success(response) {
                that.setState({
                    nodes: response
                });
            }
        });
    },

    nodeSearch: function nodeSearch(queryText) {

        this.setState({
            query: queryText
        });

        if (event.keyCode === 27) this.state.query = '';
        if (this.state.query.length === 0) {
            this.state.nodes = [];
            $modal.fadeOut();
            $('#search').css('z-index', 1);
            return false;
        }
        $modal.fadeIn();
        $('#search').css('z-index', 3000);

        this.getResults();
    },

    render: function render() {
        return React.createElement(
            'div',
            { className: 'main-search' },
            React.createElement(
                'h1',
                null,
                'Find or create micro reviews'
            ),
            React.createElement(
                'div',
                { className: 'search-box' },
                React.createElement(
                    'div',
                    { className: 'selector' },
                    'Film ',
                    React.createElement('i', { className: 'fa fa-caret-down' })
                ),
                React.createElement(SearchBox, { query: this.state.query, nodeSearch: this.nodeSearch }),
                React.createElement(SearchResults, { nodes: this.state.nodes })
            )
        );
    }
});

var SearchBox = React.createClass({
    displayName: 'SearchBox',

    search: function search() {
        this.props.nodeSearch(this.refs.searchInput.getDOMNode().value);
    },

    render: function render() {
        return React.createElement('input', { type: 'text', ref: 'searchInput', placeholder: 'Search...', autofocus: true, value: this.props.query, onChange: this.search });
    }
});

var SearchResults = React.createClass({
    displayName: 'SearchResults',

    render: function render() {
        var results = [];
        this.props.nodes.forEach(function (node) {
            results.push(React.createElement(
                'a',
                null,
                React.createElement(
                    'li',
                    null,
                    node.title
                )
            ));
        });
        return React.createElement(
            'div',
            { id: 'search-results' },
            React.createElement(
                'ul',
                { className: 'list-group' },
                results,
                React.createElement(
                    'div',
                    { className: 'create-it', 'v-show': 'minResults' },
                    React.createElement('i', { className: 'fa fa-cog fa-spin loading' }),
                    React.createElement(
                        'span',
                        null,
                        'Can\'t find what you\'re looking for? ',
                        React.createElement(
                            'a',
                            { href: '/films/create/:QUERY:' },
                            'Click to create it!'
                        )
                    )
                )
            )
        );
    }

});

/*
 * Vue: Reusable search component
 */

// new Vue({

//     el: '#search',
//     data: {
//         query: '',
//         nodes: []
//     },

//     created: function() {
//         console.log("search created");
//     },

//     methods: {
//         search: function(event) {
//             if(event.keyCode === 27) this.query = '';
//             if(this.query.length === 0) {
//                 this.nodes = [];
//                 $modal.fadeOut();
//                 $('#search').css('z-index', 1);
//                 return false;
//             }
//             $modal.fadeIn();
//             $('#search').css('z-index', 3000);

//             this.getResults();
//         },
//         getResults: function() {
//             $('#search').find('.loading').delay(1000).show(0);
//             this.$http.get('/api/v1/films/search', { query: this.query, take: 5 }, function(response) {
//                 this.nodes = response;
//                 $('#search').find('.loading').dequeue().hide(0);
//             });
//         }

//     },

//     computed: {
//         minResults: function() {
//             if(this.query.length != 0) {
//                 return true;
//             }
//         }
//     }

// });

// $('.search-button').click(function() {
//     $('#search').slideToggle(300, function() {
//         $('#search-input').focus();
//     });
// });
'use strict';

Vue.filter('getYear', function (value) {
    return value.split('').reverse().join('');
});