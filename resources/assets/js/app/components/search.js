/*
 * Main search component
 */

var HelloMessage = React.createClass({
    render: function() {
        return
            <div class="main-search">
                <h1>Find or create micro reviews</h1>
                <div class="search-box">
                    <div class="selector">Film <i class="fa fa-caret-down"></i></div>
                    <input type="text"
                           v-model="query"
                           v-on="keyup: search($event)"
                           placeholder="Search..."
                           autofocus>
                    <div id="search-results">
                        <ul class="list-group">
                            <a href='/@{{ category }}/@{{ slug }}'>
                                <li>
                                    <img src="/images/uploads/@{{ category }}/poster/@{{ poster }}" class='thumbnail'>
                                        <h3>@{{ title }}</h3>
                                    <p>@{{ release_date }} directed by @{{ director }}</p>
                                    <span class='tag'><i class="fa fa-line-chart"></i> @{{ avg }}</span>
                                    <span class='tag'><i class="fa fa-comments-o"></i> @{{ reviewCount }}</span>
                                </li>
                            </a>

                            <div class="create-it" v-show='minResults'>
                                <i class="fa fa-cog fa-spin loading"></i>
                                <span>Can't find what you're looking for? <a href='/films/create/@{{ query }}    ' >Click to create it!</a></span>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
    }
});

React.render(<HelloMessage name="John" />, document.getElementById('search'));












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
