/*
 *--------------------------------------------------------------------------
 * NodeReviewFilter
 |--------------------------------------------------------------------------
 */
var NodeReviewFilter = React.createClass({

    render: function() {
        return (
            <div className="sort">
                <ul>
                    <li><a>Latest</a></li>
                    <li><a>Oldest</a></li>
                    <li><a>Highest rated</a></li>
                    <li><a>Lowest rated</a></li>
                </ul>
            </div>
        );
    }

});
