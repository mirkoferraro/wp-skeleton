module.exports = function(gulp, plugins, config, events, paths) {
    return function() {
        return gulp.src([
                paths.css.src + '/*.scss',
                paths.src + '/../../../src/modules/**/*.scss'
            ])
		    .pipe(plugins.plumber({
		        errorHandler: events.onError
		    }))
            .pipe(plugins.sourcemaps.init())
            .pipe(plugins.sassGlob())
            .pipe(plugins.sass({
                    outputStyle: 'nested'
                })
                .on('error', plugins.sass.logError))
			.pipe(plugins.combineMq({
				beautify: false
			}))
            .pipe(plugins.autoprefixer({
                browsers: ['last 2 versions'],
                cascade: false
            }))
            .pipe(plugins.cleanCss())
            .pipe(plugins.sourcemaps.write('maps', {
                includeContent: false,
                sourceRoot: paths.css.src
            }))
            .pipe(plugins.rename(function(path) {
                path.basename += ".min";
            }))
            .pipe(gulp.dest(paths.css.dest))
            .pipe(plugins.browserSync.stream());
    };
};
