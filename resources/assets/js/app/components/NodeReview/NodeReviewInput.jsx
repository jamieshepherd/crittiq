/*
 *--------------------------------------------------------------------------
 * NodeReviewInput
 |--------------------------------------------------------------------------
 */
var NodeReviewInput = React.createClass({

    getInitialState: function() {
        return {
            reviewLength: 0
        }
    },

    updateReview: function() {
        this.setState({ reviewLength: this.refs.userReview.getDOMNode().value.length });
        this.props.updateReview(this.refs.userReview.getDOMNode().value);
    },

    expandInput: function() {
        $('#user-review').animate({ 'min-height': "220px" }, 300);
        $('.user-review-actions').fadeIn(300);
        $('.character-count').css({ 'opacity': 1 }, 300);
    },

    render: function() {
        return (
            <div className="user-review">
                <form action="" method="post">
                    <input name="_token" type="hidden" value={this.props._token}/>
                    <h2>What did you think about {this.props.nodeName}?</h2>
                    <textarea ref="userReview" onClick={this.expandInput} id="user-review" maxLength="250" name="review" placeholder="Enter your micro review here..." onChange={this.updateReview}></textarea>
                    <span className="character-count">{this.state.reviewLength} characters remaining</span>
                    <div className='spoilers'>
                        <label>My review contains spoilers</label><input type="checkbox"/>
                    </div>

                    <div className="user-review-actions">
                        <span className="ratingLabel">Rating</span>
                        <span className="rangeCount">{1+1}/10</span>

                        <div className="slider">
                            {/*<input max="10" min="0" name="score" step="0.5" type="range" value="5"/>*/}
                        </div>
                        {/*<script>$('input[type="range"]').rangeslider({ polyfill: false });</script>*/}
                        <input ref="slider" className="btn green" type="submit" value="Post crittiq"/>
                    </div>
                </form>

                <NodeReviewFilter/>

            </div>
        );
    }

});
