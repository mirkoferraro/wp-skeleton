var
fs      = require('fs'),
gulp    = require('gulp'),
plugins = require('gulp-load-plugins')({pattern: [ 'gulp-*', 'gulp.*', 'browser-sync', 'imagemin-pngquant' ], lazy: false}),
paths   = require('./paths'),
local   = {};

if (fs.existsSync('config/gulp.js')) {
    local = require('../config/gulp')(plugins, paths);
}

var
config  = require('./config')(plugins, paths, local),
events  = require('./events')(plugins, paths);

for (var i in config.tasks) {
    var taskname = config.tasks[i];
    gulp.task(taskname, require('./tasks/' + taskname)(gulp, plugins, config, events, paths));
}

gulp.task('default', ['browserSync', 'img', 'svg', 'css', 'js', 'critical', 'watch'], function() {
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
