var localhost ='http://skeleton.vagrant.test';

module.exports = function( plugins, paths ) {
    return {
    	localhost: localhost,
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
            proxy: localhost,
            open: false,
            socket: {
                domain: 'localhost:3000'
            }
        },
        critical: {
        	base_url: localhost,
        	main_css: localhost + paths.css.dest.substr(8) + '/main.min.css',
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
                tasks: ['css', 'critical', 'browserSyncStream']
            },
            js: {
                files: paths.js.src + '/**/*.js',
                tasks: ['js', 'browserSyncStream']
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
