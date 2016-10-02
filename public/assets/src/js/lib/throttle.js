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

var Throttler = function(threshhold, args) {
	var
	fnlist = [];

	var add = function(fn) {
		if (typeof fn === 'function') {
			fnlist.push(fn);
		}
	};

	var run = throttle(function() {
		var _args = typeof args === 'function' ? args() : args;
		for (var i in fnlist) {
			fnlist[i].apply(this, _args);
		}
	}, threshhold);

	return {
		add: add,
		run: run,
	};
};

var Debouncer = function(delay, args) {
	var
	fnlist = [];

	var add = function(fn) {
		if (typeof fn === 'function') {
			fnlist.push(fn);
		}
	};

	var run = debounce(function() {
		var _args = typeof args === 'function' ? args() : args;
		for (var i in fnlist) {
			fnlist[i].apply(this, _args);
		}
	}, delay);

	return {
		add: add,
		run: run,
	};
};
