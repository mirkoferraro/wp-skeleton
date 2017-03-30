var conditionizr = require('conditionizr/dist/conditionizr')

/* Browsers */ 
// conditionizr.add('chrome', function () {
//     return !!window.chrome && /google/i.test(navigator.vendor)
// })

// conditionizr.add('chromium', function () {
//     return /cros i686/i.test(navigator.platform)
// })

// conditionizr.add('firefox', function () {
//     return 'InstallTrigger' in window
// })

// conditionizr.add('ie6', function () {
//     return (Function('/*@cc_on return (@_jscript_version == 5.6 || (@_jscript_version == 5.7 && /MSIE 6\.0/i.test(navigator.userAgent))); @*/')())
// })

// conditionizr.add('ie7', function () {
//     return (Function('/*@cc_on return (@_jscript_version == 5.7 && /MSIE 7\.0(?!.*IEMobile)/i.test(navigator.userAgent)); @*/')())
// })

// conditionizr.add('ie8', function () {
//     return (Function('/*@cc_on return (@_jscript_version > 5.7 && !/^(9|10)/.test(@_jscript_version)); @*/')())
// })

// conditionizr.add('ie9', function () {
//     return (Function('/*@cc_on return (/^9/.test(@_jscript_version) && /MSIE 9\.0(?!.*IEMobile)/i.test(navigator.userAgent)); @*/')())
// })

// conditionizr.add('ie10', function () {
//     return (Function('/*@cc_on return (/^10/.test(@_jscript_version) && /MSIE 10\.0(?!.*IEMobile)/i.test(navigator.userAgent)); @*/')())
// })

// conditionizr.add('ie10touch', function () {
//     return /MSIE 10\.0.*Touch(?!.*IEMobile)/i.test(navigator.userAgent)
// })

// conditionizr.add('ie11', function () {
//     return /(?:\sTrident\/7\.0;.*\srv:11\.0)/i.test(navigator.userAgent)
// })

// conditionizr.add('opera', function () {
//     return !!window.opera || /opera/i.test(navigator.vendor)
// })

// conditionizr.add('safari', function () {
//     return /Constructor/.test(window.HTMLElement)
// })

/* OS */ 
// conditionizr.add('ios', function () {
//     return /iP(ad|hone|od)/i.test(navigator.userAgent)
// })

// conditionizr.add('linux', function () {
//     return /linux/i.test(navigator.platform) && !/android|cros/i.test(navigator.userAgent)
// })

// conditionizr.add('mac', function () {
//     return /mac/i.test(navigator.platform)
// })

// conditionizr.add('windows', function () {
//     return /win/i.test(navigator.platform)
// })

// conditionizr.add('winPhone7', function () {
//     return /Windows Phone 7.0/i.test(navigator.userAgent)
// })

// conditionizr.add('winPhone8', function () {
//     return /Windows Phone 8.0/i.test(navigator.userAgent)
// })

// conditionizr.add('winPhone75', function () {
//     return /Windows Phone 7.5/i.test(navigator.userAgent)
// })

/* Features */ 
// conditionizr.add('retina', function () {
//     return window.devicePixelRatio >= 1.5
// })

// conditionizr.add('touch', function () {
//     return 'ontouchstart' in window || !!navigator.msMaxTouchPoints
// })

/* Dev/test */ 
// conditionizr.add('localhost', function () {
//     return /(?:127\.0\.0\.1|localhost)/.test(location.host)
// })

// conditionizr.add('phantomjs', function () {
//     return /\sPhantomJS\/[[0-9]+\]/.test(navigator.userAgent)
// })

/* Use */ 
// conditionizr.on('safari', function () {
//     console.log('You are on Safari!!!')
// });

// conditionizr.config({
// 	tests: {
// 		// 'safari': ['class'],
// 		// 'ie11':   ['class']
// 		'chrome':   ['class']
// 	}
// })