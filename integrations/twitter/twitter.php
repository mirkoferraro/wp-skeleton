<?php
/*
Plugin Name: Twitter Inside
Description: Twitter integration
Version: 1.0.0
Author: Mirko Ferraro
Author URI: http://www.mirkoferraro.it
*/

class Twitter {

	private static $consumer_key = null;
	private static $consumer_secret = null;
	private static $access_token = null;
	private static $access_token_secret = null;

	private static $conection = null;

	public static function init( $consumer_key, $consumer_secret, $access_token, $access_token_secret ) {
		self::$consumer_key        = $consumer_key;
		self::$consumer_secret     = $consumer_secret;
		self::$access_token        = $access_token;
		self::$access_token_secret = $access_token_secret;
	}

	private static function connection() {
		if ( self::$conection == null ) {
			self::$conection = new Abraham\TwitterOAuth\TwitterOAuth( self::$consumer_key, self::$consumer_secret, self::$access_token, self::$access_token_secret );
		}

		return self::$conection;
	}

	public static function get( $api, $args = array() ) {
		return self::connection()->get( $api, $args );
	}

	public static function getTweets( $count = 20, $include_retweets = false ) {
		return self::get( "statuses/user_timeline", array(
			"count"       => $count,
			"include_rts" => $include_retweets
		) );
	}

	public static function getShareURL( $url, $text, $via = '' ) {
		$args = array(
			'url=' . $url,
			'text=' . $text,
			'via=' . $via,
			'original_referer=' . $_SERVER['SERVER_NAME'],
			'tw_p=tweetbutton'
		);

		return "https://twitter.com/intent/tweet?" . implode("&", $args);
	}

	public static function printJsSDK() {
		?>
		<script async>
		window.twttr = (function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0],
		t = window.twttr || {};
		if (d.getElementById(id)) return t;
		js = d.createElement(s);
		js.id = id;
		js.src = "https://platform.twitter.com/widgets.js";
		fjs.parentNode.insertBefore(js, fjs);

		t._e = [];
		t.ready = function(f) {
		t._e.push(f);
		};

		return t;
		}(document, "script", "twitter-wjs"));
		</script>
		<?php
	}
}

if ( defined('TWITTER_CONSUMER_KEY') &&
	defined('TWITTER_CONSUMER_SECRET') &&
	defined('TWITTER_ACCESS_TOKEN') &&
	defined('TWITTER_ACCESS_TOKEN_SECRET') ) {

	Twitter::init( TWITTER_CONSUMER_KEY, TWITTER_CONSUMER_SECRET, TWITTER_ACCESS_TOKEN, TWITTER_ACCESS_TOKEN_SECRET );
}

