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

    setFilter: function(filter) {
        this.props.setFilter(filter);
    },

    displayInput: function() {
        if(!this.props.userReview) {
            return (
                <form action="" method="post">
                    <input name="_token" type="hidden" value={this.props._token}/>
                    <h2>What did you think about {this.props.nodeName}?</h2>
                    <textarea ref="userReview" onClick={this.expandInput} id="user-review" maxLength="250" name="review" placeholder="Enter your micro review here..." onChange={this.updateReview}></textarea>
                    <span className="character-count">{this.state.reviewLength} characters remaining</span>
                    <div className='spoilers'>
                        <label>My review contains spoilers</label><input name="spoilers" type="checkbox"/>
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
            );
        } else {
            return (
                <div>
                    <h2>You said...</h2>
                    <span className='user-review-content'><blockquote><span className='quote'>&ldquo;</span><span dangerouslySetInnerHTML={{__html: this.props.userReview }}></span><span className='quote'>&rdquo;</span></blockquote></span>
                </div>
            );
        }
    },

    render: function() {
        var displayInput;

        displayInput = this.displayInput();

        return (
            <div className="user-review">
                {displayInput}
                <NodeReviewFilter setFilter={ this.setFilter }/>
            </div>
        );
    }

});
