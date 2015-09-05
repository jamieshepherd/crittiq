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

    getInitialState: function() {
        return {
            userReview: '',
            reviews: [],
            filter: 'latest',
            skip: 0,
            path: window.location.pathname
        }
    },

    updateReview: function(review) {
        this.setState({
            userReview: review
        })
    },

    getReviews: function() {
        $.ajax({
            url: "/api/v1"  + this.state.path + "/reviews",
            //url: "/api/v1/films/inception/reviews",
            type: "get",
            data: {
                filter: this.state.filter,
                skip: this.state.skip
            },
            context: this,
            success: function(response){
                this.setState({
                    reviews: response
                });
            }
        });
        this.state.skip = 0;
    },

    render: function() {
        return (
            <div>
                <NodeReviewInput userReview={this.state.userReview} nodeName={this.props.nodeName} updateReview={this.updateReview} _token={this.props._token}/>
                <NodeReviewList reviews={this.state.reviews} getReviews={this.getReviews}/>
            </div>
        );
    }

});


//<span class="noReviews" v-if="!reviews.length"><i class="fa fa-frown-o"></i> There are currently no reviews! Be the first to write one and earn <strong>1000</strong> points!</span>
