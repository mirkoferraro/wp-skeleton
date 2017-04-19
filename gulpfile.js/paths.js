var
assets = './public/assets',
src    = './src'

module.exports = {
    assets: assets,
    src:    src,
    styles: {
        src:  src + '/scss',
        dest: assets + '/css',
    },
    scripts: {
        src:  src + '/js',
        dest: assets + '/js',
    },
    images: {
        src:  src + '/img',
        dest: assets + '/img',
    },
    svg: {
        src:  src + '/svg',
        dest: assets + '/img',
    },
    sprite: {
        src:  src + '/img/sprite',
        dest: assets + '/img',
    },
    favicon: {
        src:  src,
        dest: assets + '/favicons',
    },
    move: {
        src:  src + '/static',
        dest: assets,
    }
}