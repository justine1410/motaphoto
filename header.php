<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img src="http://motaphoto.local/wp-content/uploads/2023/07/Logo-3.png" alt="">
    </a>
    <?php wp_nav_menu(); ?>
</header>

