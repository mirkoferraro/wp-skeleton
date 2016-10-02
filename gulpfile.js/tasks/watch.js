module.exports = function (gulp, plugins, config, events, paths) {
    return function () {
        var watchTasks = config.watch;
        for (var i in watchTasks) {
            gulp.watch(watchTasks[i].files, watchTasks[i].tasks);
        }
    };
};
