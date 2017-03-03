var
fs       = require('fs'),
gulp     = require('gulp'),
plugins  = require('gulp-load-plugins')({pattern: [ 'gulp-*', 'gulp.*', 'browser-sync', 'imagemin-pngquant' ], lazy: false}),
paths    = require('./paths'),
filelist = require('./lib/filelist'),
local    = {};

if (fs.existsSync('config/gulp.js')) {
    local = require('../config/gulp')(plugins, paths);
}

var
config    = require('./config')(plugins, paths, local),
events    = require('./events')(plugins, paths),
taskfiles = filelist("./gulpfile.js/tasks/**/*.js");

for (var i in taskfiles) {
    var
    taskfile = taskfiles[i],
    taskname = taskfile.basename,
    taskpath = taskfile.path.replace('gulpfile.js/', '');

    gulp.task(taskname, require(taskpath)(gulp, plugins, config, events, paths));
}

gulp.task('default', ['browserSync', 'img', 'sprite', 'svg', 'css', 'js', 'critical', 'watch'], function() {
    if (typeof local.show_logo === 'undefined' || local.show_logo) {
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