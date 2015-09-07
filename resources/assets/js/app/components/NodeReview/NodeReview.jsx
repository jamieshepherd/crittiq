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
            reviews: [],
            filter: 'latest',
            skip: 0,
            take: 10,
            path: window.location.pathname
        }
    },

    updateReview: function(review) {
        this.setState({
            userReview: review
        });
    },

    setFilter: function(filter) {
        this.setState({
            filter: filter,
            skip: 0
        }, function() {
            this.getReviews();
        });
    },

    getReviews: function() {
        $.ajax({
            url: "/api/v1"  + this.state.path + "/reviews",
            type: "get",
            data: {
                filter: this.state.filter,
                skip: 0,
                take: this.state.take
            },
            context: this,
            success: function(response){
                this.setState({
                    reviews: response
                });
            }
        });
        this.state.skip += 10;
    },

    getMoreReviews: function() {
        $.ajax({
            url: "/api/v1"  + this.state.path + "/reviews",
            type: "get",
            data: {
                filter: this.state.filter,
                skip: this.state.skip,
                take: this.state.take
            },
            context: this,
            success: function(response){
                this.setState({
                    reviews: this.state.reviews.concat(response)
                });
            }
        });
        this.state.skip += 10;
    },

    render: function() {
        return (
            <div>
                <NodeReviewInput userReview={this.props.userReview} nodeName={this.props.nodeName} updateReview={this.updateReview} _token={this.props._token} setFilter={this.setFilter}/>
                <NodeReviewList totalReviews={this.props.totalReviews} reviews={this.state.reviews} getReviews={this.getReviews} getMoreReviews={this.getMoreReviews}/>
            </div>
        );
    }

});


//<span class="noReviews" v-if="!reviews.length"><i class="fa fa-frown-o"></i> There are currently no reviews! Be the first to write one and earn <strong>1000</strong> points!</span>
