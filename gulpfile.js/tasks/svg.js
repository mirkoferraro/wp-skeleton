module.exports = function (gulp, plugins, config, events, paths) {
    return function () {
        return gulp.src(paths.svg.src + '/*.svg')
		    .pipe(plugins.plumber({
		        errorHandler: events.onError
		    }))
            .pipe(plugins.svgmin())
            .pipe(plugins.svgSymbols({
                templates: ['default-svg']
            }))
            .pipe(plugins.rename('svg-sprite.svg'))
            .pipe(gulp.dest(paths.svg.dest));
    };
};
