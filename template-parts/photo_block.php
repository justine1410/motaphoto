<?php
        if(is_single()){
            
            $taxonomie = 'categorie'; 
            $terme = get_the_term_list(get_the_ID(),$taxonomie); 
            $args = array(
                'post_type' => 'photo',  
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
                get_template_part( 'template-parts/lightbox' ); 
              endwhile;
                wp_reset_postdata(); // Réinitialiser la requête post
            else :
                echo "Aucun post trouvé avec cette taxonomie.";
            endif;
        }else{
            $args = array(
                'post_type' => 'photo', 
                'posts_per_page' => 8, 
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                ), 
            );
            // Affichage du portofolio sur la page.
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    // Afficher le contenu du post ici (titre, contenu, etc.)
                     get_template_part('template-parts/lightbox' ); 
    
                endwhile;
                wp_reset_postdata(); // Réinitialiser la requête post
            else :
                echo "Aucun post trouvé avec cette taxonomie.lol";
            endif;
           
    };

 ?>
