<?php get_header(); ?>

<div class="banniere">
<?php
		query_posts(array('post_type' => 'photos', 'orderby' => 'rand', 'showposts' => 1));
		if (have_posts()) :
		while (have_posts()) : the_post(); 

		the_post_thumbnail() 

		?>
		<h1><img class="titre" src="<?= get_stylesheet_directory_uri().'/img/titre_header.png'?>" alt='titre du site'></h1>

		<?php endwhile;

		endif; 
	?>
</div>

<?php get_footer(); ?>

