/*
 *--------------------------------------------------------------------------
 * SearchBox (Shared)
 |--------------------------------------------------------------------------
 */
var SearchBox = React.createClass({
    search: function() {
        this.props.doSearch(this.refs.searchBox.getDOMNode().value);
    },

    render: function() {
        return (
            <input type="text" ref="searchBox" placeholder="Search..." value={this.props.query} onChange={this.search} autofocus />
        );
    }
});
