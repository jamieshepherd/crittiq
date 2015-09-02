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
var SideSearch = React.createClass({

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
            <div>
                <span className="category">FILM <i className="fa fa-caret-down"></i></span>
                <SearchBox query={this.state.query} doSearch={this.doSearch} />
                <SearchResults nodes={this.state.nodes} />
            </div>
        );
    }
});
