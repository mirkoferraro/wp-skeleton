# Twitter Integration Guide for [WpSkeleton](https://github.com/mirkoferraro/wp-skeleton)

Install TwitterOAuth lib withg composer:
```composer require abraham/twitteroauth```

Create your Twitter App and put the secret keys in config.php:
```
define('TWITTER_CONSUMER_KEY', '');
define('TWITTER_CONSUMER_SECRET', '');
define('TWITTER_ACCESS_TOKEN', '');
define('TWITTER_ACCESS_TOKEN_SECRET', '');
```

Copy twitter.php file in /public/app/mu-plugins

Use the Twitter class
