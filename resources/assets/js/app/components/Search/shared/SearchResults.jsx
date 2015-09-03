/*
 *--------------------------------------------------------------------------
 * SearchResults (Shared)
 |--------------------------------------------------------------------------
 */
var SearchResults = React.createClass({

    render: function() {
        var results = [];
        this.props.nodes.forEach(function(node) {
            results.push(
                <a href={ "/" + node.category + "/" + node.slug }>
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
        if(this.props.query.length > 0) {
            var createIt = (
                <div className="create-it" v-show='minResults'>
                    <i className="fa fa-cog fa-spin loading"></i>
                    <span> Can't find what you're looking for? <a href={ "/films/create/" + encodeURIComponent(this.props.query) }>Click to create it!</a></span>
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
