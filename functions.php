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
        
        get_template_part( 'template-parts/lightbox' ); 

        endwhile;
    endif;

    wp_reset_postdata();
    die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

// filtre
function filter_posts() {
    
    $categorie =  $_POST['category']; 
    $format = $_POST['format'];
    $sort_order =$_POST['order'];
    

   
    if($categorie && $format){
        $args = array(
            'post_type'=>'photos',
            'orderby' => 'date',
            'order' => $sort_order,
            'tax_query'=> array(
                'relation'=> 'AND',
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $categorie,
                ),
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => $format,
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
                echo "Il n'y a pas de photos correspondant à votre recherche";
            endif;
    
    }
    elseif($categorie){
        $args = array(
                    'post_type' => 'photos',  
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'categorie',
                            'field'    => 'slug',
                            'terms'    =>  $categorie ,
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
                    echo "Il n'y a pas de photos correspondant à votre recherche";
            
                endif;
            
    }
    elseif($format){
        $args = array(
            'post_type' => 'photos',  
            'tax_query' => array(
                array(
                    'taxonomy' => 'format',
                    'field'    => 'slug',
                    'terms'    =>  $format ,
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
            echo "Il n'y a pas de photos correspondant à votre recherche";
    
        endif;
    

    }
    

}

add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');




  ?>