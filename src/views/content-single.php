<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <?php if ( has_post_thumbnail()): ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        <?php endif; ?>

        <h1>
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h1>

        <span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
        <span class="author"><?php _t( 'Published by' ); ?> <?php the_author_posts_link(); ?></span>
        <span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( _t('Leave your thoughts'), _t('1 Comment'), _t('% Comments')); ?></span>

        <?php the_content(); ?>

        <?php the_tags( _t('Tags: '), ', ', '<br>'); ?>

        <p><?= _t('Categorised in: ') . the_category(', '); ?></p>

        <p><?= _t('This post was written by ') . the_author(); ?></p>

        <?php edit_post_link(); ?>

        <?php comments_template(); ?>

    </article>

<?php endwhile; ?>

<?php else: ?>

    <article>

        <h1><?php _t( 'Sorry, nothing to display.' ); ?></h1>

    </article>

<?php endif; ?>
