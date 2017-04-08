module.exports = function ($, config) {
    return function (cb) {
        $.realFavicon.generateFavicon({
    		masterPicture: config.paths.favicon.src + '/favicon.png',
    		dest: config.paths.favicon.dest,
    		iconsPath: '/',
    		design: config.favicon,
    		settings: {
    			scalingAlgorithm: 'Mitchell',
    			errorOnImageTooSmall: false
    		},
            markupFile: config.paths.favicon.dest + '/markup.json'
    	}, function() {
    		cb();
    	});
    };
};
