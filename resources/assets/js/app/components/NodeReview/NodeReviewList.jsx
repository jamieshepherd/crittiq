/*
 *--------------------------------------------------------------------------
 * NodeReviewList
 |--------------------------------------------------------------------------
 */
var NodeReviewList = React.createClass({

    componentDidMount: function() {
        this.props.getReviews();
    },

    render: function() {
        if(this.props.reviews.length > 0) {
            var reviews = [];
            this.props.reviews.forEach(function(review) {
                reviews.push(
                    <div className="review">
                        <div className="avatar">
                            <img src={"http://www.gravatar.com/avatar/" + review.author.gravatar + "?d=http%3A%2F%2Fjamie.sh%2Fimages%2Fuploads%2Fdefault.png?s=150"}/>
                            <span className="username"><a>{review.author.name}</a></span>
                        </div>

                        <div className="review-content">
                            <p>{review.review}</p>
                        </div>
                        <div className="details">
                            <span className="info score"><strong>{review.score}</strong> / 10</span>
                            <span className="info date"><TimeAgo date={review.created_at}/></span>
                            <span className="info hearts"><i className="fa fa-heart"></i> 0</span>
                            {/*<span className="comments"><i className="fa fa-comment"></i> 1</span>*/}
                            <span className="info more"><i className="fa fa-ellipsis-h"></i></span>
                        </div>
                    </div>
                )
            });
        } else {
            var reviews = (
                <span className="noReviews" v-if="!reviews.length"><i className="fa fa-frown-o"></i> There are currently no reviews! Be the first to write one and earn <strong>1000</strong> points!</span>
            );
        }
        return (
            <div id="review-feed">
                {reviews}
                <a className="more-reviews" onClick={this.props.getMoreReviews} v-on="click: getMoreReviews"><i className="fa fa-arrow-circle-o-down"></i> Show more reviews</a>
            </div>
        );
    }

});
