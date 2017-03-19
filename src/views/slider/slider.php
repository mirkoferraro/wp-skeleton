<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ( $slides as $slide ) : ?>
        <div class="swiper-slide"><?= $slide ?></div>
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