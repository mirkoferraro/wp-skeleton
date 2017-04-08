module.exports = function ($, config) {
    return function () {
        return $.gulp.src(config.paths.images.src + '/*')
		    .pipe($.plumber({
		        errorHandler: function(err) {
                    $.util.log($.util.colors.red(err))
                }
		    }))
            .pipe($.imagemin({
                optimizationLevel: 3,
                progressive: true,
                interlaced: true,
                svgoPlugins: [{removeViewBox: false}],
                use: [$.imageminPngquant({quality: '65-80', speed: 4})]
            }))
            .pipe($.gulp.dest(config.paths.images.dest));
    };
};
