module.exports = function (gulp, plugins, config, paths) {
    return function () {
        plugins.browserSync.init(config.browserSync);
        gulp.task('browserSyncReload', plugins.browserSync.reload);
    };
};
