var glob = require('glob');

module.exports = (path) => {
    
    return glob.sync(path, {}).map((file) => {
            var
            p = file.lastIndexOf('/'),
            e = file.lastIndexOf('.');
            return {
                path:     file,
                basepath: file.substring(0, p + 1),
                filename: file.substring(p + 1),
                basename: file.substring(p + 1, e),
                ext:      file.substring(e + 1)
            };
        });

}