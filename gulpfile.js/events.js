module.exports = function( plugins, paths ) {
    return {
		onError: function(err) {
		    plugins.util.log( plugins.util.colors.red( err ) );
		}
    }
};
