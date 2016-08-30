var Skeleton = function(_name) {
	var name = _name;
	
	var hello = function() {
    	console.log('Hello ' + name + '!');
	};

	return {
		hello: hello
	};
};

var skeleton = new Skeleton('Skeleton');
skeleton.hello();