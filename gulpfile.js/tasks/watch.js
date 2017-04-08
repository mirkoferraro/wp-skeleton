module.exports = function ($, config) {
    return function () {

        var watchTasks = config.watch;

        for (var i in watchTasks) {
            $.gulp.watch(watchTasks[i].files, watchTasks[i].tasks);
        }

        if ( config.browserSync ) {
            $.browserSync.init(config.browserSync);
            $.gulp.task('browserSyncReload', $.browserSync.reload);
            $.gulp.task('browserSyncStream', $.browserSync.stream);
        }
    };
};
