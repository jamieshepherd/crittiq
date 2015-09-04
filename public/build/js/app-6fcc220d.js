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
"use strict";

function showSideNav() {
    $('#search').slideToggle(300, function () {
        $(this).find(":input").focus();
    });
}
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
 |--------------------------------------------------------------------------
 | Node review component
 |--------------------------------------------------------------------------
 |
 | Component that handles lets users create reviews, and display a list of
 | current reviews which can be sorted.
 |
 | - NodeReview
 | -- NodeReviewInput
 | ---- NodeReviewFilter
 | -- NodeReviewList
 | -- NodeReviewMore
 */

/*
 *--------------------------------------------------------------------------
 * NodeReview
 |--------------------------------------------------------------------------
 */
'use strict';

var NodeReview = React.createClass({
    displayName: 'NodeReview',

    getInitialState: function getInitialState() {
        return {
            userReview: '',
            reviews: [],
            filter: 'latest',
            skip: 0,
            nodeName: this.props.nodeName,
            _token: this.props._token,
            path: window.location.pathname
        };
    },

    updateReview: function updateReview(review) {
        this.setState({
            userReview: review
        });
    },

    getReviews: function getReviews() {
        $.ajax({
            url: "/api/v1" + this.state.path + "/reviews",
            //url: "/api/v1/films/inception/reviews",
            type: "get",
            data: {
                filter: this.state.filter,
                skip: this.state.skip
            },
            context: this,
            success: function success(response) {
                this.setState({
                    reviews: response
                });
            }
        });
        this.state.skip = 0;
    },

    render: function render() {
        return React.createElement(
            'div',
            null,
            React.createElement(NodeReviewInput, { userReview: this.state.userReview, nodeName: this.state.nodeName, updateReview: this.updateReview }),
            React.createElement(NodeReviewList, { reviews: this.state.reviews, getReviews: this.getReviews })
        );
    }

});

//<span class="noReviews" v-if="!reviews.length"><i class="fa fa-frown-o"></i> There are currently no reviews! Be the first to write one and earn <strong>1000</strong> points!</span>
/*
 *--------------------------------------------------------------------------
 * NodeReviewFilter
 |--------------------------------------------------------------------------
 */
"use strict";

var NodeReviewFilter = React.createClass({
    displayName: "NodeReviewFilter",

    render: function render() {
        return React.createElement(
            "div",
            { className: "sort" },
            React.createElement(
                "ul",
                null,
                React.createElement(
                    "li",
                    null,
                    React.createElement(
                        "a",
                        null,
                        "Latest"
                    )
                ),
                React.createElement(
                    "li",
                    null,
                    React.createElement(
                        "a",
                        null,
                        "Oldest"
                    )
                ),
                React.createElement(
                    "li",
                    null,
                    React.createElement(
                        "a",
                        null,
                        "Highest rated"
                    )
                ),
                React.createElement(
                    "li",
                    null,
                    React.createElement(
                        "a",
                        null,
                        "Lowest rated"
                    )
                )
            )
        );
    }

});
/*
 *--------------------------------------------------------------------------
 * NodeReviewInput
 |--------------------------------------------------------------------------
 */
'use strict';

var NodeReviewInput = React.createClass({
    displayName: 'NodeReviewInput',

    getInitialState: function getInitialState() {
        return {
            reviewLength: 0
        };
    },

    updateReview: function updateReview() {
        this.setState({ reviewLength: this.refs.userReview.getDOMNode().value.length });
        this.props.updateReview(this.refs.userReview.getDOMNode().value);
    },

    expandInput: function expandInput() {
        $('#user-review').animate({ 'min-height': "220px" }, 300);
        $('.user-review-actions').fadeIn(300);
        $('.character-count').css({ 'opacity': 1 }, 300);
    },

    render: function render() {
        return React.createElement(
            'div',
            { className: 'user-review' },
            React.createElement(
                'form',
                { action: '', method: 'post' },
                React.createElement('input', { name: '_token', type: 'hidden', value: this.props._token }),
                React.createElement(
                    'h2',
                    null,
                    'What did you think about ',
                    this.props.nodeName,
                    '?'
                ),
                React.createElement('textarea', { ref: 'userReview', onClick: this.expandInput, id: 'user-review', maxLength: '250', name: 'review', placeholder: 'Enter your micro review here...', onChange: this.updateReview }),
                React.createElement(
                    'span',
                    { className: 'character-count' },
                    this.state.reviewLength,
                    ' characters remaining'
                ),
                React.createElement(
                    'div',
                    { className: 'spoilers' },
                    React.createElement(
                        'label',
                        null,
                        'My review contains spoilers'
                    ),
                    React.createElement('input', { type: 'checkbox' })
                ),
                React.createElement(
                    'div',
                    { className: 'user-review-actions' },
                    React.createElement(
                        'span',
                        { className: 'ratingLabel' },
                        'Rating'
                    ),
                    React.createElement(
                        'span',
                        { className: 'rangeCount' },
                        1 + 1,
                        '/10'
                    ),
                    React.createElement('div', { className: 'slider' }),
                    React.createElement('input', { ref: 'slider', className: 'btn green', type: 'submit', value: 'Post crittiq' })
                )
            ),
            React.createElement(NodeReviewFilter, null)
        );
    }

});
/*<input max="10" min="0" name="score" step="0.5" type="range" value="5"/>*/ /*<script>$('input[type="range"]').rangeslider({ polyfill: false });</script>*/
/*
 *--------------------------------------------------------------------------
 * NodeReviewList
 |--------------------------------------------------------------------------
 */
"use strict";

var NodeReviewList = React.createClass({
    displayName: "NodeReviewList",

    componentDidMount: function componentDidMount() {
        this.getReviews();
    },

    getReviews: function getReviews() {
        this.props.getReviews();
    },

    render: function render() {
        var reviews = [];
        this.props.reviews.forEach(function (review) {
            reviews.push(React.createElement(
                "div",
                { className: "review" },
                React.createElement(
                    "div",
                    { className: "avatar" },
                    React.createElement("img", { src: "http://www.gravatar.com/avatar/" + review.author.gravatar + "?d=http%3A%2F%2Fjamie.sh%2Fimages%2Fuploads%2Fdefault.png?s=150" }),
                    React.createElement(
                        "span",
                        { className: "username" },
                        React.createElement(
                            "a",
                            null,
                            review.author.name
                        )
                    )
                ),
                React.createElement(
                    "div",
                    { className: "review-content" },
                    React.createElement(
                        "p",
                        null,
                        review.review
                    )
                ),
                React.createElement(
                    "div",
                    { className: "details" },
                    React.createElement(
                        "span",
                        { className: "score" },
                        React.createElement(
                            "strong",
                            null,
                            review.score
                        ),
                        " / 10"
                    ),
                    React.createElement(
                        "span",
                        { className: "date" },
                        "3 days ago"
                    ),
                    React.createElement(
                        "span",
                        { className: "hearts" },
                        React.createElement("i", { className: "fa fa-heart" }),
                        " 0"
                    ),
                    React.createElement(
                        "span",
                        { className: "comments" },
                        React.createElement("i", { className: "fa fa-comment" }),
                        " 1"
                    ),
                    React.createElement(
                        "span",
                        { className: "more" },
                        React.createElement("i", { className: "fa fa-ellipsis-h" })
                    )
                )
            ));
        });
        return React.createElement(
            "div",
            { id: "review-feed" },
            reviews
        );
    }

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
                $("#modal").fadeOut();
                $('#search').css('z-index', 1);
                return false;
            }
            $("#modal").fadeIn();
            $('#search').css('z-index', 3000);

            this.getResults();
        });
    },

    getResults: function getResults() {
        var that = this;

        $('#search').find('.loading').delay(1000).show(0);
        $.ajax({
            url: "/api/v1/films/search",
            type: "get",
            data: {
                query: this.state.query,
                take: 5
            },
            context: this,
            success: function success(data) {
                $('#search').find('.loading').dequeue().hide(0);
                that.setState({
                    nodes: data
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
                React.createElement(SearchResults, { query: this.state.query, nodes: this.state.nodes })
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
                return false;
            }

            this.getResults();
        });
    },

    getResults: function getResults() {
        var that = this;

        $('#search').find('.loading').delay(1000).show(0);
        $.ajax({
            url: "/api/v1/films/search",
            type: "get",
            data: {
                query: this.state.query,
                take: 5
            },
            context: this,
            success: function success(data) {
                $('#search').find('.loading').dequeue().hide(0);
                that.setState({
                    nodes: data
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
            React.createElement(SearchBox, { id: 'search-input', query: this.state.query, doSearch: this.doSearch }),
            React.createElement(SearchResults, { query: this.state.query, nodes: this.state.nodes })
        );
    }

});
/*
 |--------------------------------------------------------------------------
 | User info dropdown component
 |--------------------------------------------------------------------------
 |
 | Component that shows user info and on click reveals options available.
 |
 | - UserInfo
 | -- UserInfoPanel
 */

/*
 *--------------------------------------------------------------------------
 * UserInfo
 |--------------------------------------------------------------------------
 */

"use strict";

var UserInfo = React.createClass({
    displayName: "UserInfo",

    showPanel: function showPanel() {
        $('.account-menu').slideToggle(150);
    },

    render: function render() {
        return React.createElement(
            "div",
            { className: "user-info" },
            React.createElement(
                "span",
                { className: "user-name", onClick: this.showPanel },
                React.createElement("img", { className: "avatar", src: "http://www.gravatar.com/avatar/072bce9a71fc97034cf16c99e821f93d?d=http%3A%2F%2Fjamie.sh%2Fimages%2Fuploads%2Fdefault.png?s=44" }),
                "Jamie Shepherd ",
                React.createElement("i", { className: "fa fa-caret-down" })
            ),
            React.createElement(UserInfoPanel, { name: "Jamie Shepherd", email: "itsjamieshepherd@gmail.com" }),
            React.createElement(
                "span",
                { className: "level" },
                React.createElement("i", { className: "fa fa-trophy" }),
                " ",
                this.props.rank
            ),
            React.createElement(
                "span",
                { className: "points" },
                React.createElement("i", { className: "fa fa-diamond" }),
                " ",
                this.props.points,
                " "
            )
        );
    }

});
/*
 *--------------------------------------------------------------------------
 * UserInfoPanel
 |--------------------------------------------------------------------------
 */

"use strict";

var UserInfoPanel = React.createClass({
    displayName: "UserInfoPanel",

    render: function render() {
        return React.createElement(
            "div",
            { className: "account-menu" },
            React.createElement(
                "div",
                { className: "padding" },
                React.createElement(
                    "div",
                    { className: "account-details" },
                    React.createElement("img", { className: "avatar", src: "http://www.gravatar.com/avatar/072bce9a71fc97034cf16c99e821f93d?d=http%3A%2F%2Fjamie.sh%2Fimages%2Fuploads%2Fdefault.png?s=120" }),
                    React.createElement(
                        "span",
                        { className: "account-menu-name" },
                        "Jamie Shepherd"
                    ),
                    React.createElement(
                        "span",
                        { className: "account-menu-email" },
                        "itsjamieshepherd@gmail.com"
                    )
                ),
                React.createElement(
                    "div",
                    { className: "progress-outer" },
                    React.createElement("div", { className: "progress-inner" }),
                    React.createElement(
                        "div",
                        { className: "progress-text" },
                        "75% to next level"
                    )
                ),
                React.createElement(
                    "ul",
                    null,
                    React.createElement(
                        "li",
                        null,
                        React.createElement(
                            "a",
                            { href: "/account/profile" },
                            "My profile"
                        )
                    ),
                    React.createElement(
                        "li",
                        null,
                        React.createElement(
                            "a",
                            { href: "/account/history" },
                            "History"
                        )
                    ),
                    React.createElement(
                        "li",
                        null,
                        React.createElement(
                            "a",
                            { href: "/account/settings" },
                            "Settings"
                        )
                    )
                )
            ),
            React.createElement(
                "a",
                { className: "sign-out", href: "/auth/logout" },
                "Sign out"
            )
        );
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
                { href: "/" + node.category + "/" + node.slug },
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
        if (this.props.query.length > 0) {
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
                        { href: "/films/create/" + encodeURIComponent(this.props.query) },
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