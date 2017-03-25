<section>

	<div class="container">
		<h1 class="column"><?= _t( 'Home Page' ); ?></h1>

		<?php view( 'slider', array(
			'slides' => array(
				'My Slide 1',
				'My Slide 2',
				'My Slide 3',
			),
			'buttons' => true
		) ); ?>

		<div class="row">
			<div class="medium-6 column"><?php loremipsum( 50 ); ?></div>
			<div class="medium-6 column"><?php loremipsum( 40 ); ?></div>
			<div class="medium-6 column"><?php loremipsum( 40 ); ?></div>
			<div class="medium-6 column"><?php loremipsum( 50 ); ?></div>
		</div>
	</div>
	
</section>
