/*
 |--------------------------------------------------------------------------
 | Time ago component
 |--------------------------------------------------------------------------
 |
 | Component that converts date passed in as "X time ago".
 |
 | - TimeAgo
 */

/*
 *--------------------------------------------------------------------------
 * TimeAgo
 |--------------------------------------------------------------------------
 */

var TimeAgo = React.createClass({

    getInitialState: function() {
        return ({
            timeAgo: this.getTimeAgo()
        });
    },

    getTimeAgo: function() {

        var date = new Date(this.props.date.sec * 1000),
            seconds = Math.floor((new Date() - date) / 1000),
            years   = Math.floor(seconds / 31536000),
            months  = Math.floor(seconds / 2592000),
            days    = Math.floor(seconds / 86400),
            hours   = Math.floor(seconds / 3600),
            minutes = Math.floor(seconds / 60);

        if (years >= 1) {
            return years + " years ago";
        } else if (months >= 1) {
            return months + " months ago";
        } else if (days >= 1) {
            return days + " days ago";
        } else if (hours >= 1) {
            return hours + " hours ago";
        } else if (minutes >= 1) {
            return minutes + " minutes ago";
        } else if (seconds >= 1) {
            return "Just now";
        }
    },

    render: function() {
        return (
            <span>{this.state.timeAgo}</span>
        )
    }

});
