
<?php get_header(); ?>
<h1> Latest News </h1>
<?php
	if (have_posts()) {
	   while(have_posts()){
		   the_post();
?> 
	<h1> <?php the_title(); ?> </h1>
	<?php the_excerpt(); ?> 
	<a href="<?php the_permalink(); ?>">Read More</a>
<?php
	   }
}
?>
<?php get_footer(); ?>