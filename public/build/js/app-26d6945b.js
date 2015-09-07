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

$('.spoilers').click(function () {
    $(this).hide();
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
"use strict";

//var path = window.location.pathname;
//var characterLimit = 250;
//
///*
// * Vue: User review component
// */
//
//new Vue({
//
//    el: '#review-content',
//    data: {
//        reviews: [],
//        review: "",
//        count: characterLimit,
//        rangeCount: 5,
//        filter: 'latest',
//        skip: 0
//    },
//
//    ready: function() {
//        this.updateCounter();
//        this.getReviews();
//    },
//
//    methods: {
//        updateCounter: function() {
//            this.count = characterLimit - this.review.length;
//            $('.character-count').css('color', '');
//            if(this.count < 50) {
//                // Make orange
//                $('.character-count').css('color', '#f60');
//                if(this.count < 10) {
//                    // Make red
//                    $('.character-count').css('color', '#f00');
//                }
//            }
//        },
//        showActions: function() {
//            $('#user-review').animate({ 'min-height': "220px" }, 300);
//            $('.user-review-actions').fadeIn(300);
//            $('.character-count').css({ 'opacity': 1 }, 300);
//        },
//        getReviews: function() {
//            this.skip = 0;
//            this.$http.get('/api/v1' + path + '/reviews', { filter: this.filter, skip: this.skip }, function(response) {
//                this.reviews = response;
//            });
//        },
//        getMoreReviews: function() {
//            this.skip += 10;
//            this.$http.get('/api/v1' + path + '/reviews', { filter: this.filter, skip: this.skip }, function(response) {
//                this.reviews.push.apply(this.reviews, response);
//            });
//        },
//        sortBy: function(sortKey) {
//            this.filter = sortKey;
//            this.reviews = this.getReviews();
//        },
//        thumbsUp: function(id) {
//            console.log("hey");
//            console.log(id);
//        }
//    }
//
//});
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
"use strict";

var NodeReview = React.createClass({
    displayName: "NodeReview",

    getInitialState: function getInitialState() {
        return {
            reviews: [],
            filter: 'latest',
            skip: 0,
            take: 10,
            path: window.location.pathname
        };
    },

    updateReview: function updateReview(review) {
        this.setState({
            userReview: review
        });
    },

    setFilter: function setFilter(filter) {
        this.setState({
            filter: filter,
            skip: 0
        }, function () {
            this.getReviews();
        });
    },

    getReviews: function getReviews() {
        $.ajax({
            url: "/api/v1" + this.state.path + "/reviews",
            type: "get",
            data: {
                filter: this.state.filter,
                skip: 0,
                take: this.state.take
            },
            context: this,
            success: function success(response) {
                this.setState({
                    reviews: response
                });
            }
        });
        this.state.skip += 10;
    },

    getMoreReviews: function getMoreReviews() {
        $.ajax({
            url: "/api/v1" + this.state.path + "/reviews",
            type: "get",
            data: {
                filter: this.state.filter,
                skip: this.state.skip,
                take: this.state.take
            },
            context: this,
            success: function success(response) {
                this.setState({
                    reviews: this.state.reviews.concat(response)
                });
            }
        });
        this.state.skip += 10;
    },

    render: function render() {
        return React.createElement(
            "div",
            null,
            React.createElement(NodeReviewInput, { userReview: this.props.userReview, nodeName: this.props.nodeName, updateReview: this.updateReview, _token: this.props._token, setFilter: this.setFilter }),
            React.createElement(NodeReviewList, { totalReviews: this.props.totalReviews, reviews: this.state.reviews, getReviews: this.getReviews, getMoreReviews: this.getMoreReviews })
        );
    }

});

//<span class="noReviews" v-if="!reviews.length"><i class="fa fa-frown-o"></i> There are currently no reviews! Be the first to write one and earn <strong>1000</strong> points!</span>
/*
 *--------------------------------------------------------------------------
 * NodeReviewFilter
 |--------------------------------------------------------------------------
 */
'use strict';

var NodeReviewFilter = React.createClass({
    displayName: 'NodeReviewFilter',

    setFilter: function setFilter(filter) {
        this.props.setFilter(filter);
    },

    render: function render() {
        return React.createElement(
            'div',
            { className: 'sort' },
            React.createElement(
                'ul',
                null,
                React.createElement(
                    'li',
                    null,
                    React.createElement(
                        'a',
                        { onClick: this.setFilter.bind(this, 'latest') },
                        'Latest'
                    )
                ),
                React.createElement(
                    'li',
                    null,
                    React.createElement(
                        'a',
                        { onClick: this.setFilter.bind(this, 'oldest') },
                        'Oldest'
                    )
                ),
                React.createElement(
                    'li',
                    null,
                    React.createElement(
                        'a',
                        { onClick: this.setFilter.bind(this, 'highest') },
                        'Highest rated'
                    )
                ),
                React.createElement(
                    'li',
                    null,
                    React.createElement(
                        'a',
                        { onClick: this.setFilter.bind(this, 'lowest') },
                        'Lowest rated'
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

    setFilter: function setFilter(filter) {
        this.props.setFilter(filter);
    },

    displayInput: function displayInput() {
        if (!this.props.userReview) {
            return React.createElement(
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
                    React.createElement('input', { name: 'spoilers', type: 'checkbox' })
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
            );
        } else {
            return React.createElement(
                'div',
                null,
                React.createElement(
                    'h2',
                    null,
                    'You said...'
                ),
                React.createElement(
                    'span',
                    { className: 'user-review-content' },
                    React.createElement(
                        'blockquote',
                        null,
                        React.createElement(
                            'span',
                            { className: 'quote' },
                            '“'
                        ),
                        React.createElement('span', { dangerouslySetInnerHTML: { __html: this.props.userReview } }),
                        React.createElement(
                            'span',
                            { className: 'quote' },
                            '”'
                        )
                    )
                )
            );
        }
    },

    render: function render() {
        var displayInput;

        displayInput = this.displayInput();

        return React.createElement(
            'div',
            { className: 'user-review' },
            displayInput,
            React.createElement(NodeReviewFilter, { setFilter: this.setFilter })
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
        this.props.getReviews();
    },

    render: function render() {
        if (this.props.reviews.length > 0) {
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
                            { className: "info score" },
                            React.createElement(
                                "strong",
                                null,
                                review.score
                            ),
                            " / 10"
                        ),
                        React.createElement(
                            "span",
                            { className: "info date" },
                            React.createElement(TimeAgo, { date: review.created_at })
                        ),
                        React.createElement(
                            "span",
                            { className: "info hearts" },
                            React.createElement("i", { className: "fa fa-heart" }),
                            " 0"
                        ),
                        React.createElement(
                            "span",
                            { className: "info more" },
                            React.createElement("i", { className: "fa fa-ellipsis-h" })
                        )
                    )
                ));
            });
        } else {
            var reviews = React.createElement(
                "span",
                { className: "noReviews", "v-if": "!reviews.length" },
                React.createElement("i", { className: "fa fa-frown-o" }),
                " There are currently no reviews! Be the first to write one and earn ",
                React.createElement(
                    "strong",
                    null,
                    "1000"
                ),
                " points!"
            );
        }
        if (this.props.reviews.length > this.props.totalReviews) {
            var showMoreReviews = React.createElement(
                "a",
                { className: "more-reviews", onClick: this.props.getMoreReviews, "v-on": "click: getMoreReviews" },
                React.createElement("i", { className: "fa fa-arrow-circle-o-down" }),
                " Show more reviews"
            );
        }
        return React.createElement(
            "div",
            { id: "review-feed" },
            reviews,
            showMoreReviews
        );
    }

});
/*<span className="comments"><i className="fa fa-comment"></i> 1</span>*/
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
                React.createElement(SearchBox, { query: this.state.query, doSearch: this.doSearch }),
                React.createElement(SearchResults, { query: this.state.query, nodes: this.state.nodes })
            )
        );
    }

});
/*<div className="selector">Film <i className="fa fa-caret-down"></i></div>*/
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
 | Time ago component
 |--------------------------------------------------------------------------
 |
 | Component that converts date passed in as "X time ago".
 |
 | - TimeAgo
 */

/*
 *--------------------------------------------------------------------------
 * TimeAgo
 |--------------------------------------------------------------------------
 */

"use strict";

var TimeAgo = React.createClass({
    displayName: "TimeAgo",

    getInitialState: function getInitialState() {
        return {
            timeAgo: this.getTimeAgo()
        };
    },

    getTimeAgo: function getTimeAgo() {

        var date = new Date(this.props.date.sec * 1000),
            seconds = Math.floor((new Date() - date) / 1000),
            years = Math.floor(seconds / 31536000),
            months = Math.floor(seconds / 2592000),
            days = Math.floor(seconds / 86400),
            hours = Math.floor(seconds / 3600),
            minutes = Math.floor(seconds / 60);

        if (years >= 1) {
            return years + " years ago";
        } else if (months >= 1) {
            return months + " months ago";
        } else if (days >= 1) {
            return days + " days ago";
        } else if (hours >= 1) {
            return hours + " hours ago";
        } else if (minutes >= 1) {
            return minutes + " minutes ago";
        } else if (seconds >= 1) {
            return "Just now";
        } else {
            return "Some time ago";
        }
    },

    render: function render() {
        return React.createElement(
            "span",
            null,
            this.state.timeAgo
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
                React.createElement("img", { className: "avatar", src: "http://www.gravatar.com/avatar/" + this.props.gravatar + "?d=http%3A%2F%2Fjamie.sh%2Fimages%2Fuploads%2Fdefault.png?s=44" }),
                this.props.name,
                " ",
                React.createElement("i", { className: "fa fa-caret-down" })
            ),
            React.createElement(UserInfoPanel, { name: this.props.name, email: this.props.email }),
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
                    React.createElement("img", { className: "avatar", src: "http://www.gravatar.com/avatar/" + this.props.gravatar + "?d=http%3A%2F%2Fjamie.sh%2Fimages%2Fuploads%2Fdefault.png?s=120" }),
                    React.createElement(
                        "span",
                        { className: "account-menu-name" },
                        this.props.name
                    ),
                    React.createElement(
                        "span",
                        { className: "account-menu-email" },
                        this.props.email
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
                        node.avg || 'N/A'
                    ),
                    React.createElement(
                        "span",
                        { className: "tag" },
                        React.createElement("i", { className: "fa fa-comments-o" }),
                        " ",
                        node.reviewCount || '0',
                        " reviews"
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