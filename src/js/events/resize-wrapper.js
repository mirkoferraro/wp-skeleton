var Debouncer = require('../lib/throttle/Debouncer')

var ResizeWrapper = new Debouncer(300, function() {
	var
	doc = document.documentElement,
	body = document.getElementsByTagName('body')[0],
	width = window.innerWidth || doc.clientWidth || body.clientWidth,
	height = window.innerHeight|| doc.clientHeight|| body.clientHeight,
	is_landscape = width > height
	return [ width, height, is_landscape ]
})

window.addEventListener('resize', ResizeWrapper.run)

module.exports = ResizeWrapper