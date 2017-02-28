<section>

<?php if (have_posts()): the_post(); ?>

	<h1><?= _t('Author Archives for ') . get_the_author(); ?></h1>

	<?php if ( get_the_author_meta('description')): ?>
		<?= get_avatar(get_the_author_meta('user_email')); ?>
		<h2><?= _t( 'About ' ) . get_the_author(); ?></h2>
		<?= wpautop( get_the_author_meta('description') ); ?>
	<?php endif; ?>

	<?php rewind_posts(); while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if (has_post_thumbnail()): ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(array(120,120)); ?>
			</a>
		<?php endif; ?>

		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>

		<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
		<span class="author"><?= _t( 'Published by' ); ?> <?php the_author_posts_link(); ?></span>
		<span class="comments"><?php comments_popup_link( _t('Leave your thoughts'), _t('1 Comment'), _t('% Comments')); ?></span>

		<?php print_excerpt('excerpt_base_length'); ?>

		<br class="clear">

		<?php edit_post_link(); ?>

	</article>

<?php endwhile; ?>
<?php else: ?>

	<article>
		<h2><?= _t( 'Sorry, nothing to display.' ); ?></h2>
	</article>

<?php endif; ?>

<?php pagination(); ?>

</section>
