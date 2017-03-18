var Queue = require('../lib/queue')

var
map_loaded = false,
queue      = new Queue()

queue.sleep()

function initMap() {
	map_loaded = true
	queue.awake()
}

function onMapLoaded( callback ) {
	queue.put( callback, map_loaded )
}

window.initMap = initMap //public callback needed by gmaps script

module.exports = {
	initMap:     initMap,
	onMapLoaded: onMapLoaded,
}