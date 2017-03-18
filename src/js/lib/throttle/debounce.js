function debounce(fn, delay) {
	delay || (delay = 250)
	var timer = null
	return function() {
		var
		context = this,
		args = arguments
		clearTimeout(timer)
		timer = setTimeout(function() {
			fn.apply(context, args)
		}, delay)
	}
}

module.exports = debounce