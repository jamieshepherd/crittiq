/*
 * Main search component
 */

var MainSearch = React.createClass({

    getInitialState:function() {
        return {
            query:'',
            nodes: []
        }
    },

    getResults: function() {
        var that = this;
        reqwest({
            url: 'api/v1/films/search',
            method: 'get',
            data: {
                query: this.state.query,
                take: 5
            },
            success: function (response) {
                that.setState({
                    nodes: response
                });
            }
        });
    },

    nodeSearch: function(queryText) {

        this.setState({
            query: queryText
        });

        if(event.keyCode === 27) this.state.query = '';
        if(this.state.query.length === 0) {
            this.state.nodes = [];
            $modal.fadeOut();
            $('#search').css('z-index', 1);
            return false;
        }
        $modal.fadeIn();
        $('#search').css('z-index', 3000);

        this.getResults();
    },

    render: function() {
        return (
            <div className="main-search">
                <h1>Find or create micro reviews</h1>
                <div className="search-box">
                    <div className="selector">Film <i className="fa fa-caret-down"></i></div>
                    <SearchBox query={this.state.query} nodeSearch={this.nodeSearch}/>
                    <SearchResults nodes={this.state.nodes}/>
                </div>
            </div>
        );
    }
});

var SearchBox = React.createClass({
    search: function() {
        this.props.nodeSearch(this.refs.searchInput.getDOMNode().value);
    },

    render: function() {
        return (
            <input type="text" ref="searchInput" placeholder="Search..." autofocus value={this.props.query} onChange={this.search}/>
        );
    }
});

var SearchResults = React.createClass({
    render: function() {
        var results = [];
        this.props.nodes.forEach(function(node) {
            results.push(<a><li>{node.title}</li></a>)
        });
        return (
            <div id="search-results">
                <ul className="list-group">
                    {results}
                    <div className="create-it" v-show='minResults'>
                        <i className="fa fa-cog fa-spin loading"></i>
                        <span>Can't find what you're looking for? <a href='/films/create/:QUERY:' >Click to create it!</a></span>
                    </div>
                </ul>
            </div>
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
