var Semaphore = require('../lib/Semaphore');

var
map_loaded = false,
sem      = new Semaphore();

sem.sleep();

window.initMap = function() {
	map_loaded = true;
	sem.awake();
};

window.onMapLoaded = function( callback ) {
	sem.put( callback, map_loaded );
};