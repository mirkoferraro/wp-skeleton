var
root   = '.',
assets = root + '/public/assets',
src    = assets + '/src';

module.exports = {
    assets: assets,
    src:    src,
    theme:  root + '/public/app/themes/skeleton',
    css: {
        src:  src + '/scss',
        dest: assets + '/css',
    },
    js: {
        src:  src + '/js',
        dest: assets + '/js',
    },
    svg: {
        src:  src + '/svg',
        dest: assets + '/img',
    },
    img: {
        src:  src + '/img',
        dest: assets + '/img',
    },
    favicon: {
        src:  src,
        dest: assets + '/favicons',
    }
};
