<section>

	<div class="container">
		<h1><?= _t( 'Home Page' ); ?></h1>

		<?php view( 'slider', array(
			'slides' => array(
				'My Slide 1',
				'My Slide 2',
				'My Slide 3',
			),
			'buttons' => true
		) ); ?>

		<?php loremipsum( 5000 ); ?>
	</div>
	
</section>
