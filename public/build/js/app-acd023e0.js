// Preloader
'use strict';

(function () {
    setTimeout(function () {
        $('#loading > #preloader').fadeIn();
    }, 1000);
    setTimeout(function () {
        $('#loading > #preloader').animate({ 'height': '80px' });
        $('#loading > #preloader > span').fadeIn();
    }, 5000);
})();

// Window load complete
$(window).load(function () {
    $('#loading').fadeOut(500);
    $('.showLogin').click(function () {
        showLogin();
    });
});
'use strict';

function hideModal() {
    $('#modal').fadeOut();
    $('#login').fadeOut();
}
'use strict';

function showLogin() {
    showModal();
    $('#login').fadeIn(300);
    $('#modal').click(function () {
        hideModal();
    });
}
'use strict';

function showModal() {
    $('#modal').fadeIn(300);
}
'use strict';

Vue.filter('getYear', function (value) {
    return value.split('').reverse().join('');
});
/*
|--------------------------------------------------------------------------
| Instant search component
|--------------------------------------------------------------------------
|
| Component that handles instant search for nodes.
|
| - MainSearch
| -- MainSearchBox (Shared)
| -- SearchResults (Shared)
*/

/*
 *--------------------------------------------------------------------------
 * MainSearch
 |--------------------------------------------------------------------------
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

    doSearch: function doSearch(query) {

        this.setState({
            query: query
        }, function () {
            if (this.state.query.length === 0) {
                this.setState({
                    nodes: []
                });
                $modal.fadeOut();
                $('#search').css('z-index', 1);
                return false;
            }
            $modal.fadeIn();
            $('#search').css('z-index', 3000);

            this.getResults();
        });
    },

    getResults: function getResults() {
        var that = this;

        $('#search').find('.loading').delay(1000).show(0);
        reqwest({
            url: 'api/v1/films/search',
            method: 'get',
            data: {
                query: this.state.query,
                take: 5
            },
            success: function success(response) {
                $('#search').find('.loading').dequeue().hide(0);
                that.setState({
                    nodes: response
                });
            }
        });
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
                React.createElement(SearchBox, { query: this.state.query, doSearch: this.doSearch }),
                React.createElement(SearchResults, { nodes: this.state.nodes })
            )
        );
    }
});
/*
|--------------------------------------------------------------------------
| Instant search component for mini-nav
|--------------------------------------------------------------------------
|
| Component that on click reveals a drop-down search, handles instant
| search for nodes, from the side of a node page.
|
| - SideSearch
| -- SearchBox (Shared)
| -- SearchResults (Shared)
*/

/*
 *--------------------------------------------------------------------------
 * SideSearch
 |--------------------------------------------------------------------------
 */
'use strict';

var SideSearch = React.createClass({
    displayName: 'SideSearch',

    getInitialState: function getInitialState() {
        return {
            query: '',
            nodes: []
        };
    },

    doSearch: function doSearch(query) {

        this.setState({
            query: query
        }, function () {
            if (this.state.query.length === 0) {
                this.setState({
                    nodes: []
                });
                $modal.fadeOut();
                $('#search').css('z-index', 1);
                return false;
            }
            $modal.fadeIn();
            $('#search').css('z-index', 3000);

            this.getResults();
        });
    },

    getResults: function getResults() {
        var that = this;

        $('#search').find('.loading').delay(1000).show(0);
        reqwest({
            url: 'api/v1/films/search',
            method: 'get',
            data: {
                query: this.state.query,
                take: 5
            },
            success: function success(response) {
                $('#search').find('.loading').dequeue().hide(0);
                that.setState({
                    nodes: response
                });
            }
        });
    },

    render: function render() {
        return React.createElement(
            'div',
            null,
            React.createElement(
                'span',
                { className: 'category' },
                'FILM ',
                React.createElement('i', { className: 'fa fa-caret-down' })
            ),
            React.createElement(SearchBox, { query: this.state.query, doSearch: this.doSearch }),
            React.createElement(SearchResults, { nodes: this.state.nodes })
        );
    }
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
 *--------------------------------------------------------------------------
 * SearchBox (Shared)
 |--------------------------------------------------------------------------
 */
"use strict";

var SearchBox = React.createClass({
    displayName: "SearchBox",

    search: function search() {
        this.props.doSearch(this.refs.searchBox.getDOMNode().value);
    },

    render: function render() {
        return React.createElement("input", { type: "text", ref: "searchBox", placeholder: "Search...", value: this.props.query, onChange: this.search, autofocus: true });
    }
});
/*
 *--------------------------------------------------------------------------
 * SearchResults (Shared)
 |--------------------------------------------------------------------------
 */
"use strict";

var SearchResults = React.createClass({
    displayName: "SearchResults",

    render: function render() {
        var results = [];
        this.props.nodes.forEach(function (node) {
            results.push(React.createElement(
                "a",
                { href: node.category + "/" + node.slug },
                React.createElement(
                    "li",
                    null,
                    React.createElement("img", { src: "/images/uploads/" + node.category + "/poster/" + node.poster, className: "thumbnail" }),
                    React.createElement(
                        "h3",
                        null,
                        node.title
                    ),
                    React.createElement(
                        "p",
                        null,
                        node.release_date,
                        " directed by ",
                        node.director
                    ),
                    React.createElement(
                        "span",
                        { className: "tag" },
                        React.createElement("i", { className: "fa fa-line-chart" }),
                        " ",
                        node.avg
                    ),
                    React.createElement(
                        "span",
                        { className: "tag" },
                        React.createElement("i", { className: "fa fa-comments-o" }),
                        " ",
                        node.reviewCount
                    )
                )
            ));
        });
        // Show the "click to create" text
        if (this.props.nodes.length > 0) {
            var createIt = React.createElement(
                "div",
                { className: "create-it", "v-show": "minResults" },
                React.createElement("i", { className: "fa fa-cog fa-spin loading" }),
                React.createElement(
                    "span",
                    null,
                    " Can't find what you're looking for? ",
                    React.createElement(
                        "a",
                        { href: "/films/create/:QUERY:" },
                        "Click to create it!"
                    )
                )
            );
        }
        return React.createElement(
            "div",
            { id: "search-results" },
            React.createElement(
                "ul",
                { className: "list-group" },
                results,
                createIt
            )
        );
    }

});