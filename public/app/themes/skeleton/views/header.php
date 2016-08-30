<?php check_directly_access(); ?>

<header class="header clear" role="banner">
	<div class="logo">
		<a href="<?= $home_url; ?>">
			<svg>
				<use xlink:href="#skeleton"></use>
			</svg>
		</a>
	</div>
	<nav class="nav" role="navigation">
		<div class="container">
		<?php nav_menu( 'header' ); ?>
		</div>
	</nav>
</header>
