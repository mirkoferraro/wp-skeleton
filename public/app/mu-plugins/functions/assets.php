<?php
check_directly_access();

function assets_url( $type = null ) {
	$url = home_url() . '/assets';

	if ( $type != null && in_array( $type, array( 'css', 'favicons', 'fonts', 'img', 'js' ) ) ) {
		$url .= '/' . $type;
	}

	return $url;
}

function assets_path( $type = null ) {
	$url = WP_DIR . '/assets';

	if ($type != null && in_array($type, array('css', 'favicons', 'fonts', 'img', 'js'))) {
		$url .= '/' . $type;
	}

	return $url;
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

add_action( 'wp_footer', 'print_svg_sprite', 0 );
function print_svg_sprite() {
	?>
	<div style="display: none;">
	<?php include WP_DIR . '/assets/img/svg-sprite.svg'; ?>
	</div>
	<?php
}

add_action( 'wp_footer', 'load_async_css', 1000 );
function load_async_css() {
	global $async_styles;
	$libpath = WP_DIR . '/assets/js/lib/loadcss.min.js';
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

add_action( 'wp_footer', 'font_loader', 1000 );
function font_loader() {
	?>
	<script type="text/javascript">
	<?php include WP_DIR . '/assets/js/lib/fontloader.min.js'; ?>
	fontloader.onload({
		'Lato': [400,300,700],
	});
	</script>
	<?php
}

add_action( 'wp_footer', 'browser_sync_snippet', 1000 );
function browser_sync_snippet() {
	if ( WP_ENV != 'development' ) {
		return;
	}

	$browser_sync_json_path = WP_DIR . '/../node_modules/browser-sync/package.json';
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
