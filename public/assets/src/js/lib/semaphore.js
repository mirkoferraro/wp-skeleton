function Semaphore() {
	var
	busy = false,
	queue = [];

	var put = function( callback, immediately ) {
		if ( typeof callback !== 'function' ) {
			return;
		}

		queue.push( callback );

		if ( typeof immediately === 'undefined' ) {
			immediately = true;
		}

		if ( immediately && ! busy ) {
			awake();
		}
	};

	var awake = function() {
		if ( ! busy && queue.length ) {
			busy = true;
			var func = queue.shift();
			func();
			busy = false;
			awake();
		}
	};

	return {
		put: put,
		awake: awake
	};
}
