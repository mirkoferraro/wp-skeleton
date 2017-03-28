module.exports = function (gulp, plugins, config, events, paths) {
    return function() {
		if (!config.critical) {
			return;
		}

		var
		request     = require('request'),
		path        = require( 'path' ),
		criticalcss = require("criticalcss"),
		fs          = require('fs'),
		tmpDir      = require('os').tmpdir(),
		cssPath     = path.join( tmpDir, 'style.css' );

		request(config.critical.main_css)
			.pipe(fs.createWriteStream(cssPath))
			.on('close', function() {
				criticalcss.getRules(cssPath, function(err, output) {
					if (err) {
						throw new Error(err);
					}
					
					criticalcss.findCritical(config.critical.base_url, { rules: JSON.parse(output), ignoreConsole: true }, function(err, output) {
						if (err) {
							throw new Error(err);
						}

						fs.writeFile(paths.css.dest + '/critical.css', output, function(err) {
							if (err) {
								return console.log(err);
							}

							console.log("Generated critical.css");
						});
					});
				});
		});
    }
};
