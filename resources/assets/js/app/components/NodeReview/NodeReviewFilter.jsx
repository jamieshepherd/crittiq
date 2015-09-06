/*
 *--------------------------------------------------------------------------
 * NodeReviewFilter
 |--------------------------------------------------------------------------
 */
var NodeReviewFilter = React.createClass({

    setFilter: function(filter) {
        this.props.setFilter(filter);
    },

    render: function() {
        return (
            <div className="sort">
                <ul>
                    <li><a onClick={this.setFilter.bind(this, 'latest')}>Latest</a></li>
                    <li><a onClick={this.setFilter.bind(this, 'oldest')}>Oldest</a></li>
                    <li><a onClick={this.setFilter.bind(this, 'highest')}>Highest rated</a></li>
                    <li><a onClick={this.setFilter.bind(this, 'lowest')}>Lowest rated</a></li>
                </ul>
            </div>
        );
    }

});
