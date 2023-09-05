<?php
		$taxonomy = 'categorie';
		// Récupérer toutes les catégories
		$categories = get_terms($taxonomy, array(
			'hide_empty' => false, // Inclure les catégories sans articles
		));

		// Vérifier la catégorie sélectionnée (via la requête GET)
		$category_filter = (isset($_GET['category'])) ? $_GET['category'] : '';
        
        echo'
            <div class="category-filter">
            <form id="category-filter-form" action="' . esc_url(home_url()) . '" method="get">
                <select id="category-select" name="category">
                <option value="">Catégories</option>
                
        ';
        foreach ($categories as $category) :
			$selected = ($category->slug === $category_filter) ? 'selected' : '';
			echo '<option value="' . esc_attr($category->slug) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
		endforeach;
        echo '
            </select>
            </form>
            </div>
        ';


		$taxonomyFormat = 'format'; // Remplacez par le nom de la taxonomie que vous souhaitez afficher
		$terms =  get_terms($taxonomyFormat, array(
			'hide_empty' => false, // Inclure les catégories sans articles
		));

		// Vérifier la catégorie sélectionnée (via la requête GET)
		$category_filter_format = (isset($_GET['category'])) ? $_GET['category'] : '';

		echo'
		<div class="category-filter_format">
		<form id="category-filter-format-form" action="' . esc_url(home_url()) . '" method="get">
			<select id="category-select-format" name="category">
			<option value="">Formats</option>
			
		';
		foreach ($terms as $category) :
				$selected = ($category->slug === $category_filter_format) ? 'selected' : '';
				echo '<option value="' . esc_attr($category->slug) . '" ' . $selected . '>' . esc_html($category->name) . '</option>';
			endforeach;
			echo '
				</select>
				</form>
				</div>
			';

	


		
?>	

