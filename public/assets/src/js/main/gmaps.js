//=require ../../../../../node_modules/gmaps/gmaps.js
//=require ../lib/semaphore.js

(function(root) {

	var
	map_loaded = false,
	sem      = new Semaphore();

	sem.sleep();
	
	root.initMap = function() {
		map_loaded = true;
		sem.awake();
	};

	root.onMapLoaded = function( callback ) {
		sem.put( callback, map_loaded );
	};

})(this);
