var debounce = require('./debounce')

function Debouncer(delay, args) {
	var
	fnlist = {}

	var put = function(name, fn) {
		if (typeof fn === 'function') {
			fnlist[name] = fn
		}
	}

	var remove = function(name) {
		if (typeof fnlist[name] !== 'undefined') {
			delete fnlist[name]
		}
	}

	var run = debounce(function() {
		var _args = typeof args === 'function' ? args() : args
		for (var i in fnlist) {
			fnlist[i].apply(this, _args)
		}
	}, delay)

	return {
		put: put,
		remove: remove,
		run: run,
	}
}

module.exports = Debouncer