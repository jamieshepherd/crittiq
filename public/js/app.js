// Vue debugging (true/false)
'use strict';

Vue.config.debug = true;
Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

// Get modal element
var $modal = $('#modal');

// Master Vue instance
var app = new Vue({

    el: '#page',

    created: function created() {
        console.log("app created");
    },

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
    $('#loading').fadeOut(500);
});

// When modal is clicked, hide account
$modal.click(function () {
    $(this).fadeOut(300);
    $('#account').fadeOut(300);
});
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

    created: function created() {
        console.log("review created");
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

"use strict";

var HelloMessage = React.createClass({
  displayName: "HelloMessage",

  render: function render() {
    return React.createElement(
      "h1",
      null,
      "Hello world"
    );
  }
});

React.render(React.createElement(HelloMessage, { name: "John" }), document.getElementById('search'));

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