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
 | -- NodeReviewFilter
 | -- NodeReviewList
 | -- NodeReviewMore
 */

/*
 *--------------------------------------------------------------------------
 * NodeReview
 |--------------------------------------------------------------------------
 */
var NodeReview = React.createClass({

    getInitialState:function() {
        return {
            filter: '',
            userReview: '',
            reviews: []
        }
    },

    render: function() {
        return (
            <div id="review-content">
                <ReviewInput review={this.state.userReview}/>
                <ReviewFilter/>
            </div>
        );
    }

});
