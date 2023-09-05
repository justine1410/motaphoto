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
	<?php  get_template_part( 'template-parts/filtre' );?>

</div>


<div class="photos_post" id="portfolio">	
	<?php

		$category_filter = (isset($_GET['category'])) ? $_GET['category'] : '';
		$category_filter_format = (isset($_GET['category'])) ? $_GET['category'] : '';

		$args = array(
			'post_type' => 'photos', // Utilisez le slug de votre CPT
			'posts_per_page' => 8,   

		);

		// Si une catégorie est sélectionnée, ajoutez-la à la requête
		if (!empty($category_filter)) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'categorie',
					'field' => 'slug',
					'terms' => $category_filter,
				),
			);
		}
		
		// Affichage du portofolio sur la page.
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


<div class="bouton">
	<button id="afficher-plus">Charger plus</button>

</div>

<?php get_footer(); ?>


