module.exports = function ($, config) {
    return function() {
        return $.gulp.src([config.paths.scripts.src + '/*.js'])
		    .pipe($.plumber({
		        errorHandler: function(err) {
                    $.util.log($.util.colors.red(err))
                }
		    }))
            .pipe($.sourcemaps.init())
            .pipe($.browserify({
                insertGlobals: true,
                transform: ['require-globify', 'babelify'],
                debug: true
            }))
            .pipe($.uglify())
            .pipe($.rename(function(path) {
                path.basename += ".min";
            }))
            .pipe($.sourcemaps.write('.'))
            .pipe($.gulp.dest(config.paths.scripts.dest))
            .pipe($.browserSync.stream());
    }
};
