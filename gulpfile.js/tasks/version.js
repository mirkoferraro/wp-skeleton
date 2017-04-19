var
fs    = require('fs'),
merge = require('merge-stream');

function version( length ) {
	if ( typeof length === 'undefined' ) {
		length = 16;
	}

    var
	chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',
	ver   = '';

    for ( var i = 0; i < length; i++ )
        ver += chars.charAt( Math.floor( Math.random() * chars.length ) );

    return ver;
}

module.exports = function ($, config) {
    return function () {
    	var
		tasks      = [],
		phpcontent = '<?php\n';

		tasks.push($.gulp.src(config.version.clean)
            .pipe($.clean()));

    	for ( var varname in config.version.src ) {
    		var
			src      = config.version.src[varname],
			ver      = version(),
			sep      = src.lastIndexOf('.'),
			filename = src.substr(0, sep),
			ext      = src.substr(sep);

    		tasks.push($.gulp.src(src)
	            .pipe($.rename(filename + '.' + ver + ext))
	            .pipe($.gulp.dest('.')));

    		phpcontent += 'define("' + varname + '_VERSION", "' + ver + '");\n';
        }

		fs.writeFileSync('./config/versions.php', phpcontent);

    	return merge(tasks);
    };
};
