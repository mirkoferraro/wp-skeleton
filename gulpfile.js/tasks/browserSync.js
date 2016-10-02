module.exports = function (gulp, plugins, config, events, paths) {
    return function () {
        plugins.browserSync.init(config.browserSync);
        gulp.task('browserSyncReload', plugins.browserSync.reload);
        gulp.task('browserSyncStream', plugins.browserSync.stream);
    };
};
