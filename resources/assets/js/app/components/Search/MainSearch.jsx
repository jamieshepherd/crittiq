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
                $("#modal").fadeOut();
                $('#search').css('z-index', 1);
                return false;
            }
            $("#modal").fadeIn();
            $('#search').css('z-index', 3000);

            this.getResults();
        });


    },

    getResults: function() {
        var that = this;

        $('#search').find('.loading').delay(1000).show(0);
        reqwest({
            url: '/api/v1/films/search',
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
                    <SearchResults query={this.state.query} nodes={this.state.nodes}/>
                </div>
            </div>
        );
    }

});
