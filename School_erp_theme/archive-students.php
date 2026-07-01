<?php echo  get_header(); ?>
<?php
$roll = get_post_meta(get_the_ID(), 'roll_number', true);
?>
<?php
if(have_posts()){
	while(have_posts()){
		the_post();
	}
?> 
	<h1> <?php the_title(); ?> </h1>
	<p> Roll Number: <?php echo $roll; ?></p>
	<a href="<?php the_permalink(); ?>">View More</a>
<?php
	   }
?>
<?php get_footer(); ?>