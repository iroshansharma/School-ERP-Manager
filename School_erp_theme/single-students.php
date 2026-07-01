<?php get_header(); ?>

<?php 
	if (have_posts()) {
		while(have_posts()){
			the_post();

			$roll = get_post_meta(get_the_ID(), 'roll_number', true);
			$section = get_post_meta(get_the_ID(),'section',true);
			$classes = get_the_terms(get_the_ID(),'class',true);
			$hosues = get_the_terms(get_the_ID(),'house',true);
?>

<?php if(has_post_thumbnail()) : ?>
	<?php the_post_thumbnail('medium'); ?>
<?php endif; ?>
<h1> <?php the_title(); ?> </h1>
<p><strong>Roll Number :</strong> <?php echo $roll; ?> </p>
<p><strong>Section :</strong> <?php echo $section; ?> </p>
<p><strong>Class : </strong> 
<?php 
			if($classes){
				foreach($classes as $class) {
					echo $class->name;
				}
			}
?>
<p><strong>House : </strong> 
<?php 
			if($hosues){
				foreach($hosues as $hosue) {
					echo $hosue->name;
				}
			}
?>

<?php
}
	}
?>

<?php get_footer(); ?>