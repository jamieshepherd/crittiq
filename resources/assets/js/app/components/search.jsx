 /*
|--------------------------------------------------------------------------
| Instant search component
|--------------------------------------------------------------------------
|
| Component that handles instant search for nodes.
|
| - MainSearch
| -- SearchBox
| -- SearchResults
*/

/*
 *--------------------------------------------------------------------------
 * MainSearch
 |--------------------------------------------------------------------------
 */
var MainSearch = React.createClass({

    getInitialState:function() {
        return {
            query:'',
            nodes: []
        }
    },

    doSearch: function(query) {

        this.setState({
            query: query
        }, function() {
            if(this.state.query.length === 0) {
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

    getResults: function() {
        var that = this;

        $('#search').find('.loading').delay(1000).show(0);
        reqwest({
            url: 'api/v1/films/search',
            method: 'get',
            data: {
                query: this.state.query,
                take: 5
            },
            success: function (response) {
                $('#search').find('.loading').dequeue().hide(0);
                that.setState({
                    nodes: response
                });
            }
        });
    },

    render: function() {
        return (
            <div className="main-search">
                <h1>Find or create micro reviews</h1>
                <div className="search-box">
                    <div className="selector">Film <i className="fa fa-caret-down"></i></div>
                    <SearchBox query={this.state.query} doSearch={this.doSearch}/>
                    <SearchResults nodes={this.state.nodes}/>
                </div>
            </div>
        );
    }
});

/*
 *--------------------------------------------------------------------------
 * SearchBox
 |--------------------------------------------------------------------------
 */
var SearchBox = React.createClass({
    search: function() {
        this.props.doSearch(this.refs.searchBox.getDOMNode().value);
    },

    render: function() {
        return (
            <input type="text" ref="searchBox" placeholder="Search..." value={this.props.query} onChange={this.search} autofocus />
        );
    }
});

/*
 *--------------------------------------------------------------------------
 * SearchBox
 |--------------------------------------------------------------------------
 */
var SearchResults = React.createClass({
    render: function() {
        var results = [];
        this.props.nodes.forEach(function(node) {
            results.push(
                <a>
                    <li>
                        <img src={ "/images/uploads/" + node.category + "/poster/" + node.poster } className="thumbnail"/>
                        <h3>{node.title}</h3>
                        <p>{node.release_date} directed by {node.director}</p>
                        <span className="tag"><i className="fa fa-line-chart"></i> {node.avg}</span>
                        <span className="tag"><i className="fa fa-comments-o"></i> {node.reviewCount}</span>
                    </li>
                </a>
            )
        });
        // Show the "click to create" text
        if(this.props.nodes.length > 0) {
            var createIt = (
                <div className="create-it" v-show='minResults'>
                    <i className="fa fa-cog fa-spin loading"></i>
                    <span> Can't find what you're looking for? <a href='/films/create/:QUERY:' >Click to create it!</a></span>
                </div>
            );
        }
        return (
            <div id="search-results">
                <ul className="list-group">
                    {results}
                    {createIt}
                </ul>
            </div>
        );
    }

});
