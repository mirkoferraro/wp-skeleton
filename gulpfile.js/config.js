module.exports = function( plugins, paths ) {
    return {
        version: {
            clean: [
                paths.css.dest + '/*.min.*.css',
                paths.js.dest + '/*.min.*.js'
            ],
            src: {
                'LOGIN_CSS': paths.css.dest + '/login.min.css',
                'MAIN_CSS': paths.css.dest + '/main.min.css',
                'MAIN_JS': paths.js.dest + '/main.min.js'
            }
        },
        favicon: {
            ios: {
                pictureAspect: 'backgroundAndMargin',
                backgroundColor: '#ffffff',
                margin: '14%'
            },
            desktopBrowser: {},
            windows: {
                pictureAspect: 'noChange',
                backgroundColor: '#da532c',
                onConflict: 'override'
            },
            androidChrome: {
                pictureAspect: 'backgroundAndMargin',
                margin: '17%',
                backgroundColor: '#ffffff',
                themeColor: '#ffffff',
                manifest: {
                  	name: 'mywebsitename',
                    display: 'browser',
                    orientation: 'notSet',
                    onConflict: 'override',
                    declared: true
                }
            },
            safariPinnedTab: {
                pictureAspect: 'silhouette',
                themeColor: '#5bbad5'
            }
        },
        browserSync: {
            proxy: 'skeleton.vagrant.test',
            open: false,
            socket: {
                domain: 'localhost:3000'
            }
        },
        critical: {
        	base_url: 'http://172.28.128.3/',
        	main_css: 'http://172.28.128.3//assets/css/main.min.css',
        },
        tasks: [
            'browserSync',
            'js',
            'critical',
            'css',
            'svg',
            'img',
            'build',
            'favicon',
            'help',
            'version',
            'watch'
        ],
        watch: {
            css: {
                files: paths.css.src + '/**/*.scss',
                tasks: ['css', 'browserSyncStream']
            },
            js: {
                files: paths.js.src + '/**/*.js',
                tasks: ['js', 'critical', 'browserSyncStream']
            },
            img: {
                files: paths.img.src + '/*',
                tasks: ['img']
            },
            svg: {
                files: paths.svg.src + '/*.svg',
                tasks: ['svg']
            },
            php: {
                files: paths.theme + '/**/*.php',
                tasks: ['browserSyncReload']
            }
        }
    }
};
