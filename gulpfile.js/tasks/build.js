module.exports = function (gulp, plugins, config, paths) {
    return function (cb) {
    	plugins.sequence('img', 'svg', 'favicon', 'css', 'js', 'version', cb);
    };
};
