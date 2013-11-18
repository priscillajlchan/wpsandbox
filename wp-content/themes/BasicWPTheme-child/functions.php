<?php

// child theme functions! 

// add_theme_support ('post-thumbnails');
// add_image_size ('front-page-thumb', 255, 255, true)


add_action( 'init', 'register_cpt_testimionals' );

function register_cpt_testimionals() {

    $labels = array( 
        'name' => _x( 'testimonials', 'testimionals' ),
        'singular_name' => _x( 'testimionals', 'testimionals' ),
        'add_new' => _x( 'Add New', 'testimionals' ),
        'add_new_item' => _x( 'Add New testimionals', 'testimionals' ),
        'edit_item' => _x( 'Edit testimionals', 'testimionals' ),
        'new_item' => _x( 'New testimionals', 'testimionals' ),
        'view_item' => _x( 'View testimionals', 'testimionals' ),
        'search_items' => _x( 'Search testimonials', 'testimionals' ),
        'not_found' => _x( 'No testimonials found', 'testimionals' ),
        'not_found_in_trash' => _x( 'No testimonials found in Trash', 'testimionals' ),
        'parent_item_colon' => _x( 'Parent testimionals:', 'testimionals' ),
        'menu_name' => _x( 'testimonials', 'testimionals' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'This is a description of the "testimonials" custom post type. ',
        'supports' => array( 'title', 'editor', 'custom-fields' ),
        'taxonomies' => array( 'category' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'testimionals', $args );
}

add_action( 'init', 'register_taxonomy_locations' );

function register_taxonomy_locations() {

    $labels = array( 
        'name' => _x( 'Locations', 'locations' ),
        'singular_name' => _x( 'Location', 'locations' ),
        'search_items' => _x( 'Search Locations', 'locations' ),
        'popular_items' => _x( 'Popular Locations', 'locations' ),
        'all_items' => _x( 'All Locations', 'locations' ),
        'parent_item' => _x( 'Parent Location', 'locations' ),
        'parent_item_colon' => _x( 'Parent Location:', 'locations' ),
        'edit_item' => _x( 'Edit Location', 'locations' ),
        'update_item' => _x( 'Update Location', 'locations' ),
        'add_new_item' => _x( 'Add New Location', 'locations' ),
        'new_item_name' => _x( 'New Location', 'locations' ),
        'separate_items_with_commas' => _x( 'Separate locations with commas', 'locations' ),
        'add_or_remove_items' => _x( 'Add or remove locations', 'locations' ),
        'choose_from_most_used' => _x( 'Choose from the most used locations', 'locations' ),
        'menu_name' => _x( 'Locations', 'locations' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => false,
        'hierarchical' => true,

        'rewrite' => true,
        'query_var' => true
    );

    register_taxonomy( 'locations', array('testimonal'), $args );
}

function my_scripts_method(){
    wp_enqueue_script('jquery');
    wp_enqueue_script('thickbox');
}
// add_action('wp_enqueue_scripts', 'my_scripts_method');

if (function_exists('register_sidebar')) {
 register_sidebar(array(
 'name' => 'Home Twitter Area',
 'id' => 'home-twitter',
 'description' => 'Add Twitter widget here',
 'before_widget' => ' ',
 'after_widget' => ' ',
 'before_title' => '<h3>',
 'after_title' => '</h3>'
 ));
}
?>