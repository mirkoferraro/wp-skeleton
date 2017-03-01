var merge = require('merge-stream');

module.exports = function (gulp, plugins, config, events, paths) {
    return function () {
        var spriteData = gulp.src(paths.sprite.src + '/*.png')
            .pipe(plugins.plumber({
                errorHandler: events.onError
            }))
            .pipe(plugins.spritesmith({
                imgName: 'sprite.png',
                cssName: 'sprite.css'
            }));

        var imgData = spriteData.img
                // .pipe(plugins.imagemin({
                //     optimizationLevel: 3,
                //     progressive: true,
                //     interlaced: true,
                //     svgoPlugins: [{removeViewBox: false}],
                //     use: [plugins.imageminPngquant({quality: '65-80', speed: 4})]
                // }))
                .pipe(gulp.dest(paths.sprite.dest));
            

        var cssData = spriteData.css
                .pipe(plugins.cleanCss())
                .pipe(plugins.rename(function(path) {
                    path.basename += ".min";
                }))
                .pipe(gulp.dest(paths.css.dest));
        
        return merge(imgData, cssData);
    };
};