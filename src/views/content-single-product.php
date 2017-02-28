<?php do_action( 'woocommerce_before_main_content' ); ?>

    <?php while ( have_posts() ) : the_post(); ?>
    
        <?php
        do_action( 'woocommerce_before_single_product' );

        if ( post_password_required() ) {
            echo get_the_password_form();
            return;
        }
        ?>

        <article itemscope itemtype="<?= woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php do_action( 'woocommerce_before_single_product_summary' ); ?>

            <div class="summary entry-summary">

                <?php do_action( 'woocommerce_single_product_summary' ); ?>

            </div>

            <?php do_action( 'woocommerce_after_single_product_summary' ); ?>

            <meta itemprop="url" content="<?php the_permalink(); ?>" />

        </article>

        <?php do_action( 'woocommerce_after_single_product' ); ?>


    <?php endwhile; ?>

<?php do_action( 'woocommerce_after_main_content' ); ?>







