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

<div class='post-filters'>
	<?php get_template_part( 'template-parts/filtre' ); ?>
</div>


<div class="photos_post" id="portfolio">	
	<?php
		get_template_part('template-parts/photo_block')
	?>
</div>


<div class="bouton">
	<button id="load-more-button">charger plus</button>
</div>




<?php get_footer(); ?>


