var
fs = require('fs'),
paths = require('./paths'),

data = {
	show_logo: true,
	localhost: 'http://localhost',
	load_plugins: [ 'gulp', 'gulp-*', 'gulp.*', 'browser-sync', 'imagemin-pngquant' ],
	paths: paths,
	version: {
		clean: [
			paths.styles.dest + '/*.min.*.css',
			paths.scripts.dest + '/*.min.*.js'
		],
		src: {
			'MAIN_CSS': paths.styles.dest + '/main.min.css',
			'MAIN_JS': paths.scripts.dest + '/main.min.js'
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
	watch: {
		css: {
			files: [ paths.styles.src + '/**/*.scss' ],
			tasks: ['styles', 'browserSyncStream']
		},
		js: {
			files: [ paths.scripts.src + '/**/*.js' ],
			tasks: ['scripts', 'browserSyncStream']
		},
		img: {
			files: paths.images.src + '/*',
			tasks: ['images', 'browserSyncReload']
		},
		svg: {
			files: paths.svg.src + '/*.svg',
			tasks: ['svg', 'browserSyncReload']
		},
		sprite: {
			files: paths.sprite.src + '/*',
			tasks: ['sprite', 'browserSyncReload']
		},
		php: {
			files: paths.src + '/**/*.php',
			tasks: ['browserSyncReload']
		},
		move: {
			files: paths.move.src + '/**/*.*',
			tasks: ['move', 'browserSyncReload']
		}
	}
}

if (fs.existsSync('config/gulp.js')) {
	data = require('../config/gulp')(data)
}

module.exports = data