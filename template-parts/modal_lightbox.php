<!-- The Modal -->
<div id="modaLightbox" >
	<div class="container-lightbox">
        <div class="close_light">
        <img class="close-lightbox" src="<?= get_stylesheet_directory_uri().'/img/close-light.png' ?>">
        </div>
        <div class="post_light">
             <div class="arrow-prec">

                <img src="<?= get_stylesheet_directory_uri().'/img/nav-precedent.png' ?>">
             </div>
             

            <div class="post-image-light">
            <?php 
                            // Arguments de requête pour récupérer les articles
                $args = array(
                    'post_type' => 'photo',   // Type de post : article
                    'posts_per_page' => -1,  // Récupérer tous les articles

                );

                // Récupérer les articles en utilisant get_posts()
                $articles = get_posts($args);
                // Initialiser un tableau pour stocker les données des articles
                $tableau_articles = array();

                // Boucler à travers les articles récupérés et les ajouter au tableau
                foreach ($articles as $article) {

                    $taxonomy_name='categorie';
                    $ref_name='reference';
                    
                    $thumbnail = get_the_post_thumbnail($article->ID, 'large');
                    $terms = get_the_terms($article->ID, $taxonomy_name);
                    $ref = get_field('référence');

                    $article_data = array(
                        'ID' => $article->ID,
                        'thumbnail' => $thumbnail,
                        'taxonomy' => $terms,
                        'field' => $article->$ref,
                        
                        // Vous pouvez ajouter d'autres champs selon vos besoins
                    );
                    
                    // Ajouter les données de l'article au tableau
                    $tableau_articles[] = $article_data;

                    $tableau_articles_json = json_encode($tableau_articles);
                }

               
            ?>
             <!-- Utiliser une balise script pour passer les données à JavaScript -->
            <script>
                let articlesData = <?php echo $tableau_articles_json; ?>;
            </script>
            <div id="image-container" ></div>

            
            </div>
            
            <div class="arrow-suiv">
                <img  src="<?= get_stylesheet_directory_uri().'/img/nav-suivant.png' ?>">
             </div>

        </div>
        <div class="infos_light">
            <div class="ref">
                <?= the_field('reference'); ?>
            </div>

        <?php 
            
                $taxonomy = 'categorie'; // Remplacez par le nom de la taxonomie que vous souhaitez afficher
                $terms = get_the_terms(get_the_ID(), $taxonomy);

                if ($terms && !is_wp_error($terms)) {
                    
                    foreach ($terms as $term) {
                        echo '<a href="' . esc_url(get_term_link($term)) . '" class="therme">' . esc_html($term->name) . '</a> ';
                    }
                } 
            ?>
        </div>
	</div>
</div>

