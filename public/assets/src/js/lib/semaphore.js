function Semaphore() {
	var
	_sleep = false,
	_busy = false,
	_queue = [];

	function put( callback ) {
		if ( typeof callback !== 'function' ) {
			return;
		}

		_queue.push( callback );

		if ( ! _sleep && ! _busy ) {
			awake();
		}
	}

	function awake() {
		_sleep = false;

		if ( ! _busy && _queue.length ) {
			_busy = true;

			var func = _queue.shift();
			func();
			
			_busy = false;

			if ( ! _sleep ) {
				awake();
			}
		}
	}

	function sleep() {
		_sleep = true;
	}

	return {
		put: put,
		awake: awake,
		sleep: sleep
	};
}

module.exports = Semaphore;