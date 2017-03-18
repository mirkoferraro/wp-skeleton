var throttle = require('./throttle')

function Throttler(threshhold, args) {
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

	var run = throttle(function() {
		var _args = typeof args === 'function' ? args() : args
		for (var i in fnlist) {
			fnlist[i].apply(this, _args)
		}
	}, threshhold)

	return {
		put: put,
		remove: remove,
		run: run,
	}
}

module.exports = Throttler