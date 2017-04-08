module.exports = function ($, config) {
    return function () {
        return $.gulp.src(config.paths.svg.src + '/*.svg')
		    .pipe($.plumber({
		        errorHandler: function(err) {
                    $.util.log( $.util.colors.red( err ) );
                }
		    }))
            .pipe($.svgmin())
            .pipe($.svgSymbols({
                templates: ['default-svg']
            }))
            .pipe($.rename('svg-sprite.svg'))
            .pipe($.gulp.dest(config.paths.svg.dest));
    };
};
