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

module.exports = throttle;