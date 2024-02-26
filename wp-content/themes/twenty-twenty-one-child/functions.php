<?php
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_setup' );
function enqueue_child_theme_setup(){
	$parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', array(),  $theme->parent()->get('Version'));
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),array( $parenthandle ),$theme->get('Version'));
}
?>