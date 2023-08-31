<?php get_header(); ?>

<div class="banniere">
    <img class="banniere-img" src="<?= get_stylesheet_directory_uri().'/img/banniere.png' ?>">
</div>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
    
    	<h1><?php the_title(); ?></h1>
    
    	<?php the_content(); ?>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>