module.exports = function(gulp, plugins, config, paths) {
    return function() {
        return gulp.src([paths.css.src + '/*.scss'])
            .pipe(plugins.sourcemaps.init())
            .pipe(plugins.sass({
                    outputStyle: 'nested'
                })
                .on('error', plugins.sass.logError))
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
