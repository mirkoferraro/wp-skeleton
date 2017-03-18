function Queue() {
	var
	_sleep = false,
	_busy  = false,
	_queue = []

	function put( cb ) {
		if ( typeof cb !== 'function' ) {
			return
		}

		_queue.push( cb )

		if ( ! _sleep && ! _busy ) {
			awake()
		}
	}

	function awake() {
		_sleep = false

		if ( ! _busy && _queue.length ) {
			_busy = true

			var cb = _queue.shift()
			cb()
			
			_busy = false

			if ( ! _sleep ) {
				awake()
			}
		}
	}

	function sleep() {
		_sleep = true
	}

	return {
		put: put,
		awake: awake,
		sleep: sleep
	}
}

module.exports = Queue