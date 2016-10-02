module.exports = function (gulp, plugins, config, events, paths) {
    return function (cb) {
    	plugins.sequence('img', 'svg', 'favicon', 'css', 'js', 'version', cb);
    };
};
