<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php the_content(); ?>
        <?php comments_template( '', true ); ?>
        <?php edit_post_link(); ?>
    </article>
<?php endwhile; ?>
<?php else: ?>
    <article>
        <h2><?= _t('Sorry, nothing to display.'); ?></h2>
    </article>
<?php endif; ?>

