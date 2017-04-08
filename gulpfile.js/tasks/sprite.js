var merge = require('merge-stream');

module.exports = function ($, config) {
    return function () {
        var spriteData = $.gulp.src(config.paths.sprite.src + '/*.png')
            .pipe($.plumber({
                errorHandler: function(err) {
                    $.util.log($.util.colors.red(err))
                }
            }))
            .pipe($.spritesmith({
                imgName: 'sprite.png',
                cssName: 'sprite.css'
            }));

        var imgData = spriteData.img
                // .pipe($.imagemin({
                //     optimizationLevel: 3,
                //     progressive: true,
                //     interlaced: true,
                //     svgo$: [{removeViewBox: false}],
                //     use: [$.imageminPngquant({quality: '65-80', speed: 4})]
                // }))
                .pipe($.gulp.dest(config.paths.sprite.dest));
            

        var cssData = spriteData.css
                .pipe($.cleanCss())
                .pipe($.rename(function(path) {
                    path.basename += ".min";
                }))
                .pipe($.gulp.dest(config.paths.styles.dest));
        
        return merge(imgData, cssData);
    };
};