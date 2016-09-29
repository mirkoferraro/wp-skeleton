(function($, root) {

	var
	map_loaded = false,
	queue      = new Semaphore();

	root.initMap = function() {
		map_loaded = true;
		queue.awake();
	};

	root.onMapLoaded = function( callback ) {
		queue.put( callback, map_loaded );
	};

})(jQuery, this);
