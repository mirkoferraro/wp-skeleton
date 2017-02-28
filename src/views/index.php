<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

	<head>
		<?php view( 'head' ); ?>
	</head>

	<body <?php body_class(); ?>>

		<div class="body-wrapper">

			<?php view( 'header' ); ?>

			<div class="main-wrapper <?= display_sidebar() ? 'with-sidebar' : '' ?>">
				
				<?php //include ABSPATH . '../../src/modules/test/test.php'; ?>
				<main class="main" role="main">
					<?php view( 'content' ); ?>
				</main>

				<?php if ( display_sidebar() ) : ?>
				<aside class="sidebar" role="complementary">
					<?php view( 'sidebar' ); ?>
				</aside>
				<?php endif; ?>

			</div>

			<?php view( 'footer' ); ?>

		</div>

		<?php wp_footer(); ?>

	</body>
</html>

