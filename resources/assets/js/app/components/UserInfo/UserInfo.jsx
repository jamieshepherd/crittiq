/*
 |--------------------------------------------------------------------------
 | User info dropdown component
 |--------------------------------------------------------------------------
 |
 | Component that shows user info and on click reveals options available.
 |
 | - UserInfo
 | -- UserInfoPanel
 */

/*
 *--------------------------------------------------------------------------
 * UserInfo
 |--------------------------------------------------------------------------
 */

var UserInfo = React.createClass({

    showPanel: function() {
        $('.account-menu').slideToggle(150);
    },

    render: function() {
        return (
            <div className="user-info">
                <span className="user-name" onClick={this.showPanel}>
                    <img className="avatar" src="http://www.gravatar.com/avatar/072bce9a71fc97034cf16c99e821f93d?d=http%3A%2F%2Fjamie.sh%2Fimages%2Fuploads%2Fdefault.png?s=44"/>
                    Jamie Shepherd <i className="fa fa-caret-down"></i>
                </span>
                <UserInfoPanel name="Jamie Shepherd" email="itsjamieshepherd@gmail.com"/>
                <span className="level"><i className="fa fa-trophy"></i> { this.props.rank }</span>
                <span className="points"><i className="fa fa-diamond"></i> { this.props.points} </span>
            </div>
        );
    }

});
