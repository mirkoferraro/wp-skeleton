module.exports = function( plugins, paths, local ) {
    var data = {
    	localhost: local.localhost,
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
        browserSync: false,
        critical: false,
		webpack: {
			output: {
				filename: '[name].js',
			},
			module: {
				loaders: [{
					test: /\.vue$/,
					loader: 'vue-loader',
					options: {
						loaders: {
							'js': 'babel-loader',
							'scss': 'vue-style-loader!css-loader!sass-loader',
							'sass': 'vue-style-loader!css-loader!sass-loader?indentedSyntax'
						}
					}
				}],
			},
		},
        performanceBudget: {
			medianLatency: 2000,
			medianResponse: 2000,
			biggestLatency: 4000,
			smallestLatency: 500,
			slowestResponse: 4000,
			fastestResponse: 600,
			biggestResponse: 36000,
			smallestResponse: 50,
			iframesCount: 0,
			bodyHTMLSize: 20000,
			windowPrompts: 0,
			windowConfirms: 0,
			windowAlerts: 0,
			statusCodesTrail: 200,
			timeFrontend: 100,
			timeBackend: 50,
			domComplete: 4000,
			domContentLoadedEnd: 2000,
			domContentLoaded: 2500,
			domInteractive: 2000,
			timeToFirstImage: 2500,
			timeToFirstJs: 2500,
			timeToFirstCss: 1500,
			multipleRequests: 0,
			smallJsFiles: 1,
			smallCssFiles: 1,
			smallImages: 3,
			assetsWithCookies: 0,
			assetsWithQueryString: 1,
			assetsNotGzipped: 1,
			requestsToDomComplete: 30,
			requestsToDomContentLoaded: 5,
			firstPaint: 0,
			repaints: 0,
			redirectsTime: 150,
			redirects: 1,
			localStorageEntries: 0,
			closedConnections: 0,
			jsErrors: 0,
			evalCalls: 0,
			documentWriteCalls: 1,
			jQueryDOMWriteReadSwitches: 5,
			jQueryDOMWrites: 40,
			jQueryDOMReads: 20,
			jQueryEventTriggers: 1,
			jQuerySizzleCalls: 50,
			jQueryWindowOnLoadFunctions: 0,
			jQueryOnDOMReadyFunctions: 0,
			jQueryVersionsLoaded: 1,
			headersBiggerThanContent: 2,
			headersRecvSize: 12000,
			headersSentSize: 3000,
			headersSize: 15000,
			headersRecvCount: 300,
			headersSentCount: 50,
			headersCount: 300,
			globalVariablesFalsy: 0,
			globalVariables: 15,
			eventsDispatched: 0,
			eventsBound: 15,
			DOMqueriesAvoidable: 5,
			DOMqueriesDuplicated: 5,
			DOMinserts: 10,
			DOMqueriesByQuerySelectorAll: 1,
			DOMqueriesByTagName: 40,
			DOMqueriesByClassName: 1,
			DOMqueriesById: 1,
			DOMqueriesWithoutResults: 1,
			DOMqueries: 20,
			DOMmutationsAttributes: 40,
			DOMmutationsRemoves: 0,
			hiddenContentSize: 500,
			DOMidDuplicated: 0,
			imagesWithoutDimensions: 0,
			imagesScaledDown: 0,
			nodesWithInlineCSS: 10,
			DOMelementMaxDepth: 8,
			DOMelementsCount: 150,
			whiteSpacesSize: 2000,
			commentsSize: 2500,
			documentHeight: 1500,
			documentCookiesCount: 3,
			documentCookiesLength: 50,
			domainsWithCookies: 0,
			cookiesRecv: 0,
			cookiesSent: 0,
			consoleMessages: 0,
			oldCachingHeaders: 5,
			cachingDisabled: 1,
			cachingTooShort: 1,
			cachingNotSpecified: 0,
			cachePasses: 0,
			cacheMisses: 4,
			cacheHits: 21,
			otherSize: 1,
			otherCount: 1,
			base64Size: 0,
			base64Count: 0,
			webfontSize: 120000,
			webfontCount: 4,
			videoSize: 0,
			videoCount: 0,
			imageSize: 150000,
			imageCount: 18,
			jsonSize: 0,
			jsonCount: 0,
			jsSize: 30000,
			jsCount: 2,
			cssSize: 12000,
			cssCount: 2,
			htmlSize: 15000,
			htmlCount: 2,
			ajaxRequests: 0,
			timeToLastByte: 600,
			timeToFirstByte: 600,
			httpTrafficCompleted: 4000,
			contentLength: 300000,
			bodySize: 200000,
			notFound: 0,
			httpsRequests: 30,
			gzipRequests: 20,
			requests: 30
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
            'version',
            'watch',
            'performance'
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
    };

	if (typeof local.localhost !== 'undefined') {
		data.browserSync = {
			proxy: local.localhost,
			open: false,
			socket: {
				domain: 'localhost:3000'
			}
		};

		local.critical = {
			base_url: local.localhost,
			main_css: local.localhost + paths.css.dest.substr(8) + '/main.min.css',
		};
	}

	return data;
};
