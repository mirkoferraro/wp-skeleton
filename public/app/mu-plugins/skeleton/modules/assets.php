<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( defined( 'GOOGLE_ANALYTICS_ID' ) && ! empty( GOOGLE_ANALYTICS_ID ) ) {
	add_action( 'wp_head', 'print_google_analytics_code', 0, 1000 );
}
function print_google_analytics_code() {
	?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', '<?= GOOGLE_ANALYTICS_ID; ?>', 'auto');
	  ga('send', 'pageview');

	</script>
	<?php
}


if ( defined( 'GOOGLE_TAG_MANAGER_ID' ) && ! empty( GOOGLE_TAG_MANAGER_ID ) ) {
	add_action( 'wp_head', 'print_google_tag_manager_script', 0, 1000 );
	add_action( 'wp_footer', 'print_google_tag_manager_noscript', 0, 1000 );
}
function print_google_tag_manager_script() {
	?>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','<?= GOOGLE_TAG_MANAGER_ID; ?>');</script>
	<?php
}

function print_google_tag_manager_noscript() {
	?>
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= GOOGLE_TAG_MANAGER_ID; ?>"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<?php
}

add_action( 'wp_footer', 'print_svg_sprite', 0 );
function print_svg_sprite() {
	?>
	<div style="display: none;">
	<?php include assets_path('img') . '/svg-sprite.svg'; ?>
	</div>
	<?php
}

add_action( 'wp_footer', 'load_async_css', 1000 );
function load_async_css() {
	global $async_styles;
	$libpath = assets_path('js') . '/lib/loadcss.min.js';
	if ( is_array( $async_styles ) && count( $async_styles ) && file_exists( $libpath ) ) : ?>
	<script type="text/javascript">
		<?php
		include $libpath;
		foreach ( $async_styles as $style_src ) : ?>
			loadCSS('<?= $style_src ?>');
		<?php endforeach; ?>
	</script>
	<?php
	endif;
}

function add_font_face_observer( $font_family, $font_weight ) {
	global $font_face_observer;

	$font_weight = (array) $font_weight;

	$font_weight = array_map( 'strtolower', $font_weight );
	$font_weight = array_filter( $font_weight, function( $weight ) {
		return in_array( $weight, array(
			'100',
			'200',
			'300',
			'400',
			'500',
			'600',
			'700',
			'800',
			'900',
			'light',
			'normal',
			'medium',
			'bold',
			'extrabold',
			'black',
		) );
	} );

	foreach ( $font_weight as $weight ) {

		switch( $weight ) {
			case 'light':     $weight = '300'; break;
			case 'normal':    $weight = '400'; break;
			case 'medium':    $weight = '500'; break;
			case 'bold':      $weight = '700'; break;
			case 'extrabold': $weight = '800'; break;
			case 'black':     $weight = '900'; break;
		}

		if ( ! isset( $font_face_observer ) || empty( $font_face_observer ) || ! is_array( $font_face_observer ) ) {
			$font_face_observer = array();
		}

		if ( ! isset( $font_face_observer[$font_family] ) ) {
			$font_face_observer[$font_family] = array();
		}

		if ( ! in_array( $weight, $font_face_observer[$font_family] ) ) {
			$font_face_observer[$font_family][] = $weight;
		}

	}

}

add_action( 'wp_footer', 'font_loader', 1000 );
function font_loader() {
	global $font_face_observer;

	if ( ! isset( $font_face_observer ) || ! count( $font_face_observer ) ) {
		return;
	}

	?>
	<script type="text/javascript">
	<?php include PUBLIC_DIR . '/../node_modules/fontfaceobserver/fontfaceobserver.standalone.js'; ?>
	var
	fonts = {
		<?php foreach ( $font_face_observer as $fontfamily => $weights ) : ?>
			<?php foreach ( $weights as $weight ) : ?>
				<?= $fontfamily . $weight; ?>: new FontFaceObserver('<?= $fontfamily; ?>', { weight: <?= $weight; ?> }),
			<?php endforeach; ?>
		<?php endforeach; ?>
	},
	fonts_loaded = {
		<?php foreach ( $font_face_observer as $fontfamily => $weights ) : ?>
			<?php foreach ( $weights as $weight ) : ?>
				<?= $fontfamily . $weight; ?>: false,
			<?php endforeach; ?>
		<?php endforeach; ?>
	},
	count = 0,
	loaded = 0;

	for (var name in fonts) {

		if (typeof fonts[name].load !== 'function') {
			continue;
		}

		count++;

		(function(font, name) {

			font.load(null, 3000).then(function () {
				loaded++;
				fonts_loaded[name] = true;
				// document.documentElement.className += ' ' + name;

				if (count == loaded) {
					document.documentElement.className += ' fonts-loaded';
				}
			}, function() {
				loaded++;

				if (count == loaded) {
					document.documentElement.className += ' fonts-loaded';
				}
			});

		})(fonts[name], name);
	}
	</script>
	<?php
}

add_action( 'wp_footer', 'browser_sync_snippet', 1000 );
function browser_sync_snippet() {
	if ( WP_ENV != 'development' ) {
		return;
	}

	$browser_sync_json_path = PUBLIC_DIR . '/../node_modules/browser-sync/package.json';
	if ( ! file_exists( $browser_sync_json_path ) ) {
		return;
	}

	$browser_sync_json = json_decode( file_get_contents( $browser_sync_json_path ) );

	if ( ! isset( $browser_sync_json->version ) ) {
		return;
	}

	?>
	<script id="__bs_script__">//<![CDATA[
		document.write("<script async src='http://localhost:3000/browser-sync/browser-sync-client.js?v=<?= $browser_sync_json->version; ?>'><\/script>");
	//]]></script>
	<?php
}

function critical_css_path() {
	return assets_path( 'css' ) . '/critical.css';
}

function print_critical_style() {
	$critical_path = critical_css_path();
	if ( file_exists( $critical_path ) ) : ?>
	<style><?php include $critical_path; ?></style>
	<?php endif;
}
