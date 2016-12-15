<?php check_directly_access(); ?>

<section>

	<h1><?= _t( 'Archives' ); ?></h1>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
				</a>
			<?php endif; ?>
			<h2>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>
			<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			<span class="author"><?php _t( 'Published by' ); ?> <?php the_author_posts_link(); ?></span>
			<span class="comments"><?php if ( comments_open( get_the_ID() ) ) comments_popup_link( _t( 'Leave your thoughts' ), _t( '1 Comment' ), _t( '% Comments' )); ?></span>

			<?php print_excerpt('excerpt_base_length'); // Build your custom callback length in functions.php ?>

			<?php edit_post_link(); ?>

		</article>

	<?php endwhile; ?>

	<div class="pagination">
		<?php pagination(); ?>
	</div>

	<?php else: ?>
		
		<article>
			<h2><?php _t( 'Sorry, nothing to display.' ); ?></h2>
		</article>

	<?php endif; ?>


</section>










<section>

	<?php do_action( 'woocommerce_before_main_content' ); ?>

		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>

		<?php if ( have_posts() ) : ?>

			<?php do_action( 'woocommerce_before_shop_loop' ); ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php wc_get_template_part( 'content', 'product' ); ?>
						
						<?php edit_post_link(); ?>

					</article>

				<?php endwhile; ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php do_action( 'woocommerce_after_shop_loop' ); ?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php do_action( 'woocommerce_after_main_content' ); ?>

</section>
