
<?php get_header(); ?>
<div class="hero_section"> 
	<h1><?php echo get_theme_mod('hero_heading'); ?></h1>
	<p> <?php echo get_theme_mod('hero_paragraph'); ?> </p>
	<a href="<?php echo get_theme_mod('hero_button_url'); ?>"><?php echo get_theme_mod('hero_button_txt');?></a>
</div>

<div class="About-school">
	<h2> <?php echo get_theme_mod('about'); ?> </h2>
	<p> <?php echo get_theme_mod('desc'); ?> </p>
	<a href="<?php echo get_theme_mod('about_button_url'); ?>"><?php echo get_theme_mod('about_button_txt');?></a>
</div>

<div class="page_blog">
<?php
if (have_posts()){
	while(have_posts()){	
		the_post();
		
?>
	<h2><?php the_title(); ?></h2>
	<?php the_excerpt(); ?>
	<a href="<?php the_permalink(); ?>">Read More</a>
<?php
	}
}
?>
</div>

<div class="footer">
<?php get_footer(); ?>
</div>
