var Throttler = require('../lib/throttle/Throttler')

var ScrollThrottler = new Throttler(300, function() {
	var
	doc = document.documentElement,
	body = document.getElementsByTagName('body')[0],
	width = window.innerWidth || doc.clientWidth || body.clientWidth,
	height = window.innerHeight|| doc.clientHeight|| body.clientHeight,
	left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0),
	top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0)
	return [ top, left, height, width ]
})

window.addEventListener('scroll', ScrollThrottler.run)

module.exports = ScrollThrottler