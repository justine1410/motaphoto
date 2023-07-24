<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));

}



function add_js_scripts() {
    wp_enqueue_script( 'script-js', get_stylesheet_directory_uri() . '/js/main.js', array(), false, true );
    wp_enqueue_script( 'swiper-js', get_stylesheet_directory_uri() . '/js/swiper.js', array(), false, true );

}
add_action('wp_enqueue_scripts', 'add_js_scripts');


?>