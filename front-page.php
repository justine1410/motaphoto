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

<div class="photos_post">
	<?php  
		 $args = array(
			'post_type' => 'photos',  
			'posts_per_page' => 8,   
			
		);

		$query = new WP_Query($args);

		if ($query->have_posts()) :
			while ($query->have_posts()) : $query->the_post();
				// Afficher le contenu du post ici (titre, contenu, etc.)
				the_post_thumbnail();
			endwhile;
			wp_reset_postdata(); // Réinitialiser la requête post
		else :
			echo "Aucun post trouvé avec cette taxonomie.";
		endif;
	?>

</div>

<?php get_footer(); ?>

