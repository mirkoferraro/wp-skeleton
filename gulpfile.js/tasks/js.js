module.exports = function (gulp, plugins, config, events, paths) {
    return function() {
        return gulp.src(paths.js.src + '/*.js')
		    .pipe(plugins.plumber({
		        errorHandler: events.onError
		    }))
            .pipe(plugins.sourcemaps.init())
            .pipe(plugins.include())
            .pipe(plugins.uglify())
            .pipe(plugins.rename(function(path) {
                path.basename += ".min";
            }))
            .pipe(plugins.sourcemaps.write('.'))
            .pipe(gulp.dest(paths.js.dest))
            .pipe(plugins.browserSync.stream());
    }
};
