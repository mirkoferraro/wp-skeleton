function FunctionWrapper() {
	var
	_busy  = false,
	_args = [],
	_list = {}

	function setArgs(args) {
		_args = args
	}

	function put( name, cb ) {
		if ( typeof cb !== 'function' ) {
			return
		}

		_list[name] = cb
	}

	function remove( name ) {
		delete _list[name]
	}

	function run() {
		if ( ! _busy ) {
			_busy = true

			var args = typeof _args === 'function' ? args() : _args
			for (var name in _list) {
				_list[name].apply(this, args)
			}
			
			_busy = false
		}
	}

	return {
		setArgs: setArgs,
		put:     put,
		remove:  remove,
		run:     run
	}
}

module.exports = FunctionWrapper