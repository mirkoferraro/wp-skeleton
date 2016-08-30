module.exports = function (gulp, plugins, config, paths) {
    return function () {
        return gulp.src(paths.svg.src + '/*.svg')
            .pipe(plugins.svgmin())
            .pipe(plugins.svgSymbols({
                templates: ['default-svg']
            }))
            .pipe(plugins.rename('svg-sprite.svg'))
            .pipe(gulp.dest(paths.svg.dest));
    };
};
