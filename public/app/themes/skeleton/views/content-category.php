<?php check_directly_access(); ?>

<section>

	<h1><?= _t( 'Categories for ' ) . single_cat_title(); ?></h1>

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
