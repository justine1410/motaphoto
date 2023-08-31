<?php
                            
                $taxonomie = 'categorie'; // Remplacez par le nom de la taxonomie que vous souhaitez filtrer
                $terme = get_the_term_list(get_the_ID(),$taxonomie); // Remplacez par le nom du terme spécifique que vous souhaitez filtrer
               

                $args = array(
                    'post_type' => 'photos',  
                    'posts_per_page' => 2,   
                    'post__not_in' => array(get_the_ID()), 
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomie,
                            'field'    => 'slug',
                            'terms'    => $terme,
                        ),
                    ),
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