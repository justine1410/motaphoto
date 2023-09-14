<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));

}


// fichier js
function add_js_scripts() {
    wp_enqueue_script( 'modal-js', get_stylesheet_directory_uri() . '/js/modal.js', array(), false, true );
    wp_enqueue_script( 'single_post-js', get_stylesheet_directory_uri() . '/js/single_post.js', array(), false, true );
    wp_enqueue_script( 'filtre-js', get_stylesheet_directory_uri() . '/js/filtre.js', array(), false, true );
    wp_enqueue_script( 'lightbox-js', get_stylesheet_directory_uri() . '/js/lightbox.js', array(), false, true );
    wp_enqueue_script( 'my-ajax-script-js', get_stylesheet_directory_uri() . '/js/my-ajax-script.js', array(), false, true );
    wp_enqueue_script( 'menu-js', get_stylesheet_directory_uri() . '/js/menu.js', array(), false, true );


}

add_action('wp_enqueue_scripts', 'add_js_scripts');

// AFichier ajax
function enqueue_ajax_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('my-ajax-script', get_template_directory_uri() . '/js/ajax-load-more.js', array('jquery'), '1.0', true);
    wp_enqueue_script('filtre', get_template_directory_uri() . '/js/filtre.js', array('jquery'), '1.0', true);


    // Passez l'URL Ajax au script
    wp_localize_script('my-ajax-script', 'my_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
    wp_localize_script('filtre', 'my_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

}
add_action('wp_enqueue_scripts', 'enqueue_ajax_scripts');



// afficher plus
function load_more_posts() {
    $page = $_POST['photos'];

    $query_args = array(
        'post_type' => 'photos',
        'posts_per_page' => 12,  
        'paged' => $page,
        array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
        ), 
    );

    $query = new WP_Query($query_args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            // Affichez ici le contenu de chaque article
            the_post_thumbnail();
        endwhile;
    endif;

    wp_reset_postdata();
    die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

// filtre
function filter_posts() {
    
    $categorie = 'categorie' ;  
    $taxonomie =  $_POST['category']; 
    $format = 'format';
    $taxoFormat = $_POST['format'];
    $sort_order =$_POST['order'];


    if($taxonomie){
        $args = array(
            'post_type' => 'photos',  
            'tax_query' => array(
                array(
                    'taxonomy' => $categorie,
                    'field'    => 'slug',
                    'terms'    =>  $taxonomie ,
                ),
            ),
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
            ?>
            <a href='<?= the_permalink()?>'> <?=the_post_thumbnail()?></a>
       <? endwhile;
        wp_reset_postdata(); // Réinitialiser la requête post
        else :
            echo "oups";
    
        endif;
    
    }
    elseif($taxoFormat){
        $args = array(
            'post_type' => 'photos',  
            'tax_query' => array(
                array(
                    'taxonomy' => $format,
                    'field'    => 'slug',
                    'terms'    =>  $taxoFormat ,
                ),
            ),
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
            ?>
				<a href='<?= the_permalink()?>'> <?=the_post_thumbnail()?></a>
           <? endwhile;
            wp_reset_postdata(); // Réinitialiser la requête post
        else :
            echo "coucou";
    
        endif;

    }
    elseif($sort_order == 'date-asc'){
        $args = array(
            'post_type' => 'photos',
            'orderby' => 'date',
            'order' => 'ASC',
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>
            <a href='<?= the_permalink()?>'> <?=the_post_thumbnail()?></a>
       <? 
       endwhile;           
        wp_reset_postdata(); // Réinitialiser la requête post
        else :
            echo "coucou";
    
        endif;
    }elseif($sort_order == 'date-desc'){
        $args = array(
            'post_type' => 'photos',
            'orderby' => 'date',
            'order' => 'DEC',
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
        ?>
                // Afficher le contenu du post ici (titre, contenu, etc.)
                the_post_thumbnail();
        <?  endwhile;
            wp_reset_postdata(); // Réinitialiser la requête post
        else :
            echo "coucou";
    
        endif;

    }

}

add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');




  ?>