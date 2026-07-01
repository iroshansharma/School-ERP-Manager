<!DOCTYPE html>
<html>
	<head>

	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<!-- this is very imp funcation of wordpress ex :- like js,css and other page header section add here-->
		<?php wp_head(); ?>
	<head/>
<body>
	<header> 
	
	<div class=logo>
		<?php the_custom_logo(); ?>	
		</div>
		<div class=header>
		<h1><?php echo get_theme_mod('header') ?> </h1>
		</div>
		<div class=nav_menu>
		<?php wp_nav_menu(); ?>
		</div>
	</header>
</body>
</html>	