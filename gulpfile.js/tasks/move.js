module.exports = function ($, config) {
    return function() {
        return $.gulp.src(config.paths.move.src + '/**/*.*')
            .pipe($.gulp.dest(config.paths.move.dest))
    }
};
