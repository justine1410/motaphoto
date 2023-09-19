<div class="lightbox">
    <div class="post-image">
        <?=the_post_thumbnail()?>
    </div>
    <div class="lightbox-info">
        <div class="fullscreen">
            <img class="icone_fullscreen" src="<?= get_stylesheet_directory_uri().'/img/Icon_fullscreen.png' ?>">
        </div >
        <a href='<?= the_permalink()?>'> 
            <img class="icone_eye" src="<?= get_stylesheet_directory_uri().'/img/Icon_eye.png' ?>">
        </a>
        <div class="info">
            <?php 
                the_field('référence') ;
            
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