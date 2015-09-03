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
 | ---- NodeReviewFilter
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
            reviews: [],
            _token: this.props._token,
            nodeName: ''
        }
    },

    updateReview: function(review) {
        this.setState({
            review: review
        })
    },

    render: function() {
        return (
            <NodeReviewInput userReview={this.state.userReview} updateReview={this.updateReview}/>
        );
    }

});


//<span class="noReviews" v-if="!reviews.length"><i class="fa fa-frown-o"></i> There are currently no reviews! Be the first to write one and earn <strong>1000</strong> points!</span>
