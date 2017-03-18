var Queue = require('../lib/queue')

var
map_loaded = false,
queue      = new Queue()

queue.sleep()

window.initMap = function() {
	map_loaded = true
	queue.awake()
}

window.onMapLoaded = function( callback ) {
	queue.put( callback, map_loaded )
}