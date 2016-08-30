module.exports = function (gulp, plugins, config, paths) {
    return function () {
        return gulp.src(paths.img.src + '/*')
            .pipe(plugins.imagemin({
                optimizationLevel: 3,
                progressive: true,
                interlaced: true,
                svgoPlugins: [{removeViewBox: false}],
                use: [plugins.imageminPngquant({quality: '65-80', speed: 4})]
            }))
            .pipe(gulp.dest(paths.img.dest));
    };
};
