<div class="swiper-container" style="height: <?= $height ?>px">
    <div class="swiper-wrapper">
        <?php foreach ( $slides as $slide ) :
            if ( is_array( $slide['style'] ) ) {
                $slide['style'] = implode( ';', $slide['style'] );
            }
            ?>
        <div class="swiper-slide" style="<?= $slide['style'] ?>"><?= $slide['content'] ?></div>
        <?php endforeach; ?>
    </div>

    <?php if ( isset( $pagination ) && $pagination ) : ?>
    <div class="swiper-pagination"></div>
    <?php endif ?>

    <?php if ( isset( $buttons ) && $buttons ) : ?>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <?php endif ?>

    <?php if ( isset( $scrollbar ) && $scrollbar ) : ?>
    <div class="swiper-scrollbar"></div>
    <?php endif ?>
</div>