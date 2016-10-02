module.exports = function (gulp, plugins, config, events, paths) {
    return function (done) {
        plugins.realFavicon.generateFavicon({
    		masterPicture: paths.favicon.src + '/favicon.png',
    		dest: paths.favicon.dest,
    		iconsPath: '/',
    		design: config.favicon,
    		settings: {
    			scalingAlgorithm: 'Mitchell',
    			errorOnImageTooSmall: false
    		},
            markupFile: paths.favicon.dest + '/markup.json'
    	}, function() {
    		done();
    	});
    };
};
