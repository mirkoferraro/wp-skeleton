module.exports = function (gulp, plugins, config, paths) {
    return function () {
        var s = [
            '==== WpSkeleton Helper ====',
            'VAGRANT',
            '# vagrant up:              build up the vagrant vm',
            'WP-CLI',
            '# wp core download:        install latest version of WordPress',
            '# wp core update:          update WordPress core to the latest available version',
            '# wp db export <file>:     export database',
            'COMPOSER',
            '# composer install:        install composer dependecies',
            'NPM',
            '# npm install:             install node modules',
            'GULP',
            '# gulp:                    run the build and watch tasks',
            '# gulp build:              run the build task (compile assets)',
            '# gulp img:                run the image optimization task',
            '# gulp svg:                run the svg sprite task',
            '# gulp favicon:            run the favicon task',
            '# gulp prod:               run the production task (connect to remote server via ssh and update the remote repository)'
        ];

        for (var i in s) {
            console.log(s[i]);
        }
    }
};
