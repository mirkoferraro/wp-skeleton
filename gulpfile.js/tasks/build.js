module.exports = function ($, config) {
    return function (cb) {
    	$.sequence('images', 'sprite', 'svg', 'favicon', 'styles', 'scripts', 'version', cb);
    };
};
