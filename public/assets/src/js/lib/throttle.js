function throttle(fn, threshhold, scope) {
	threshhold || (threshhold = 250);
	var
	last,
	deferTimer;
	return function() {
		var
		context = scope || this,
		now = +new Date,
		args = arguments;
		if (last && now < last + threshhold) {
			clearTimeout(deferTimer);
			deferTimer = setTimeout(function() {
				last = now;
				fn.apply(context, args);
			}, threshhold + last - now);
		} else {
			last = now;
			fn.apply(context, args);
		}
	};
}

function debounce(fn, delay) {
	delay || (delay = 250);
	var timer = null;
	return function() {
		var
		context = this,
		args = arguments;
		clearTimeout(timer);
		timer = setTimeout(function() {
			fn.apply(context, args);
		}, delay);
	}
}

function Throttler(threshhold, args) {
	var
	fnlist = {};

	var put = function(name, fn) {
		if (typeof fn === 'function') {
			fnlist[name] = fn;
		}
	};

	var remove = function(name) {
		if (typeof fnlist[name] !== 'undefined') {
			delete fnlist[name];
		}
	};

	var run = throttle(function() {
		var _args = typeof args === 'function' ? args() : args;
		for (var i in fnlist) {
			fnlist[i].apply(this, _args);
		}
	}, threshhold);

	return {
		put: put,
		remove: remove,
		run: run,
	};
};

function Debouncer(delay, args) {
	var
	fnlist = {};

	var put = function(name, fn) {
		if (typeof fn === 'function') {
			fnlist[name] = fn;
		}
	};

	var remove = function(name) {
		if (typeof fnlist[name] !== 'undefined') {
			delete fnlist[name];
		}
	};

	var run = debounce(function() {
		var _args = typeof args === 'function' ? args() : args;
		for (var i in fnlist) {
			fnlist[i].apply(this, _args);
		}
	}, delay);

	return {
		put: put,
		remove: remove,
		run: run,
	};
};
