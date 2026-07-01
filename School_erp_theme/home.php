<?php get_header(); ?>

<?php
if(have_posts()){
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