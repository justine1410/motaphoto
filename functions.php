<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));

}



function add_js_scripts() {
    wp_enqueue_script( 'modal-js', get_stylesheet_directory_uri() . '/js/modal.js', array(), false, true );
    wp_enqueue_script( 'single_post-js', get_stylesheet_directory_uri() . '/js/single_post.js', array(), false, true );
    wp_enqueue_script( 'cta-js', get_stylesheet_directory_uri() . '/js/cta.js', array(), false, true );
    wp_enqueue_script( 'filtre-js', get_stylesheet_directory_uri() . '/js/filtre.js', array(), false, true );

}

add_action('wp_enqueue_scripts', 'add_js_scripts');

// test

function charger_plus_de_publications() {
    $taxonomie = 'categorie'; // Remplacez par le nom de la taxonomie que vous souhaitez filtrer

    $args = array(
       'post_type' => 'photos', // Type de publication à charger (changez-le selon vos besoins)
       'post_status' => 'publish',
       'posts_per_page' => 12,   
       'tax_query' => array(
        array(
            'taxonomy' => $taxonomie,
            'field'    => 'slug',
        ),
    ),
    );
 
    $query = new WP_Query($args);
 
    if ($query->have_posts()) :
       while ($query->have_posts()) : $query->the_post();
          // Contenu de la publication
          echo '<h2>' . get_the_title() . '</h2>';
       endwhile;
    endif;
 
    wp_die();
 }
 
 add_action('wp_ajax_charger_plus_de_publications', 'charger_plus_de_publications');
 add_action('wp_ajax_nopriv_charger_plus_de_publications', 'charger_plus_de_publications');
 

  ?>