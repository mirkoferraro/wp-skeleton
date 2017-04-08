var
// Modules
config    = require('./config'),
$         = require('gulp-load-plugins')({pattern: config.load_plugins, lazy: false}),
filelist  = require('./lib/filelist'),
taskfiles = filelist("./gulpfile.js/tasks/**/*.js")

for (var i in taskfiles) {
    var
    taskfile = taskfiles[i],
    taskname = taskfile.basename,
    taskpath = taskfile.path.replace('gulpfile.js/', '');

    $.gulp.task(taskname, require(taskpath)($, config));
}

$.gulp.task('default', ['images', 'sprite', 'svg', 'styles', 'scripts', 'watch'], function() {
    if (typeof config.show_logo === 'undefined' || config.show_logo) {
        console.log("     __          __    _____ _        _      _                  ");
        console.log("     \\ \\        / /   / ____| |      | |    | |                 ");
        console.log("      \\ \\  /\\  / / __| (___ | | _____| | ___| |_ ___  _ __      ");
        console.log("       \\ \\/  \\/ / '_ \\___  \\| |/ / _ \\ |/ _ \\ __/ _ \\| '_ \\     ");
        console.log("        \\  /\\  /| |_) |___) |   <  __/ |  __/ || (_) | | | |    ");
        console.log("         \\/  \\/ | .__/_____/|_|\\_\\___|_|\\___|\\__\\___/|_| |_|    ");
        console.log("                | |                                             ");
        console.log("                |_|    Starter Kit for WordPress                ");
        console.log("                                                                ");
    }
});