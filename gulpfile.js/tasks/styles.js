module.exports = function($, config) {
    return function() {
        return $.gulp.src([
                config.paths.styles.src + '/*.scss',
                config.paths.src + '/../../../src/modules/**/*.scss'
            ])
		    .pipe($.plumber({
		        errorHandler: function(err) {
                    $.util.log($.util.colors.red(err))
                }
		    }))
            .pipe($.sourcemaps.init())
            .pipe($.sassGlob())
            .pipe($.sass({
                    outputStyle: 'nested',
                    includePaths: [
                        'node_modules/swiper/dist/css/',
                        'node_modules/foundation-sites/scss/',
                        'node_modules/motion-ui/src/',
                        'node_modules/normalize.css/'
                    ]
                })
                .on('error', $.sass.logError))
			.pipe($.combineMq({
				beautify: false
			}))
            .pipe($.autoprefixer({
                browsers: ['last 2 versions'],
                cascade: false
            }))
            .pipe($.cleanCss())
            .pipe($.rename(function(path) {
                path.basename += ".min";
            }))
            .pipe($.sourcemaps.write('maps', {
                includeContent: false,
                sourceRoot: config.paths.styles.src
            }))
            .pipe($.gulp.dest(config.paths.styles.dest))
            .pipe($.browserSync.stream());
    };
};
