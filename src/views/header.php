<?php

$home_url = home_url();

?>

<header class="header clear" role="banner">
	<nav class="nav" role="navigation">
		<div class="top-bar">
			<div class="top-bar-left">
				<?php foundation_nav_menu( 'header' ); ?>
			</div>
			<div class="top-bar-right">
				<ul class="menu">
					<li><input type="search" placeholder="Search"></li>
					<li><button type="button" class="button">Search</button></li>
				</ul>
			</div>
		</div>
	</nav>

</header>