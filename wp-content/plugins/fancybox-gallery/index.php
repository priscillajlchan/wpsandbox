<?php 
/*
Plugin Name: FancyBox Gallery
Plugin URI: 
Description: This plugin overrides the build-in gallery and replaces it with a fancybox gallery.
Version: 1.0
Author: Priscilla Chan
Author URI: www.priscillajchan.com
*/

remove_shortcode('gallery');
add_shortcode('gallery', 'parse_gallery_shortcode');

function load_fancybox(){
	wp_enqueue_script('fancybox', plugins_url('fancybox-gallery').'/source/jquery.fancybox.pack.js', array('jquery'));
	wp_enqueue_script('custom-script', plugins_url('fancybox-gallery').'/fancybox-head.js', array('jquery'));
	wp_enqueue_style('fancybox', plugins_url('fancybox-gallery').'/source/jquery.fancybox.css');
	wp_enqueue_style('custom-style', plugins_url('fancybox-gallery').'/fancybox-style.css');
}
add_action('wp_enqueue_scripts', 'load_fancybox');

function parse_gallery_shortcode($atts) {
 
    global $post;
 
    // Check if we are using a list of ids (new media flow). If so, put the relevant data in the proper attribute elements.

    if ( ! empty( $atts['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $atts['orderby'] ) )
            $atts['orderby'] = 'post__in';
        $atts['include'] = $atts['ids'];
    }
 
    /*
    Extract the current gallery options. Here, we can specify default values for any gallery option that is left undefined by the user. To add a new gallery option, simply add it to the shortcode_atts array.

    The extract WordPress function will then put its results into local variables named after each of the gallery options. For example, $id will contain the gallery id, $size will contain the gallery size and so on.
    */

    extract(shortcode_atts(array(
        'orderby' => 'menu_order ASC, ID ASC',
        'include' => '',
        'id' => $post->ID,
        // 'itemtag' => 'dl',
        // 'icontag' => 'dt',
        // 'captiontag' => 'dd',
        // 'columns' => 4,
        // 'size' => 'thumbnail',
        'size' => array(100,100),
        'link' => 'file'
    ), $atts));
 
    // Once we have extracted all the relevant gallery options, we can retrieve all the images or photos from the relevant WordPress gallery using the WordPress get_posts function. Here, we prepare the arguments for our get_posts query to search for images.

    $args = array(
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'post_mime_type' => 'image',
        'orderby' => $orderby
    );

    // If we are using the new id-list system, we enter the list of ids into the â€˜includeâ€™ argument. Otherwise, we use the old system which extracts images based on parent-id (â€˜post_parentâ€™ argument).

    if ( !empty($include) )
        $args['include'] = $include;
    else {
        $args['post_parent'] = $id;
        $args['numberposts'] = -1;
    }

    // Call the get_posts function to retrieve the relevant set of images.

    $images = get_posts($args);

    $gal = "<ul>"; // open the unordered list 

    foreach ( $images as $image ) {     
        $caption = $image->post_excerpt;
 
        $description = $image->post_content;
        if($description == '') $description = $image->post_title;
 
        $image_alt = get_post_meta($image->ID,'_wp_attachment_image_alt', true);
 
        // Render the images in the WordPress gallery according to your own layout and style.

        $gal .= "<li class='gthumb'><a class='fancybox' rel='gallery' title='".$caption."' href='". wp_get_attachment_url($image->ID)."'>";
        // $variable = '<a class="classname" href="">';
        $gal .= wp_get_attachment_image($image->ID, $size);
        $gal .="</a></li>";

    }

    $gal .= "</ul>"; // close the unordered list
    return $gal;
}
?>