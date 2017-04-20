<?php

$favicons_url = assets_url( 'favicon' );

?>

<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
<link href="//www.google-analytics.com" rel="dns-prefetch">

<link rel="apple-touch-icon" sizes="57x57" href="<?= $favicons_url ?>/apple-touch-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?= $favicons_url ?>/apple-touch-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?= $favicons_url ?>/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?= $favicons_url ?>/apple-touch-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?= $favicons_url ?>/apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?= $favicons_url ?>/apple-touch-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?= $favicons_url ?>/apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?= $favicons_url ?>/apple-touch-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?= $favicons_url ?>/apple-touch-icon-180x180.png">
<link rel="icon" type="image/png" href="<?= $favicons_url ?>/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="<?= $favicons_url ?>/favicon-194x194.png" sizes="194x194">
<link rel="icon" type="image/png" href="<?= $favicons_url ?>/favicon-96x96.png" sizes="96x96">
<link rel="icon" type="image/png" href="<?= $favicons_url ?>/android-chrome-192x192.png" sizes="192x192">
<link rel="icon" type="image/png" href="<?= $favicons_url ?>/favicon-16x16.png" sizes="16x16">
<link rel="manifest" href="<?= $favicons_url ?>/manifest.json">
<link rel="mask-icon" href="<?= $favicons_url ?>/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#2d89ef">
<meta name="msapplication-TileImage" content="<?= $favicons_url ?>/mstile-144x144.png">
<meta name="theme-color" content="#ffffff">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php bloginfo('description'); ?>">
