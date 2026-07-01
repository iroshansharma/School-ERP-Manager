<!DOCTYPE html>
<html>
	<head>
	<!-- this is very imp funcation of wordpress ex :- like js,css and other page footer section add here-->
		<?php wp_footer() ?>

		
	<head/>
<body>
	<footer>
	<div class="sidebar1">
		<?php dynamic_sidebar('sidebar-1'); ?>
		</div>
		<div class="sidebar2">
		<?php dynamic_sidebar('sidebar-2'); ?>
		</div>
		<div class="sidebar3">
		<?php dynamic_sidebar('sidebar-3'); ?>	
		</div>
		<div class=copyright>
		<p><?php echo get_theme_mod('footer'); ?> </p>
		</div>
	</footer>
</body>
</html>