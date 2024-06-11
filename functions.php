<?php 
// ADD DYANMIC TITLE
function booktopia_theme_support(){
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'booktopia_theme_support');


// ADD DYNAMIC NAVIGATION
function booktopia_register_menus(){
    $locations = array(
        'primary' => "Desktop Primary Left Sidebar",
        'footer' => "Footer Menu Items"
    );

    register_nav_menus($locations);
}

add_action('init', 'booktopia_register_menus');

function booktopia_register_styles(){

    $version = wp_get_theme()->get('Version');

    wp_enqueue_style('booktopia-style', get_template_directory_uri() . "/style.css", array(), $version, 'all');
    wp_enqueue_style('booktopia-navigation', get_template_directory_uri() . "/assets/css/navigation.css", array(), '1.0', 'all');
    wp_enqueue_style('booktopia-header', get_template_directory_uri() . "/assets/css/header.css", array(), '1.0', 'all');
    wp_enqueue_style('booktopia-slider', get_template_directory_uri() . "/assets/css/slider.css", array(), '1.0', 'all');
    // IF NEED DEPENDENCIES
    // wp_enqueue_style('booktopia-header', get_template_directory_uri() . "/assets/css/header.css", array('booktopia-style'), '1.0', 'all');
    // THEN THE STYLE.CSS WILL BE LOADED FIRST

}

add_action('wp_enqueue_scripts', 'booktopia_register_styles');

function booktopia_register_script(){

    wp_enqueue_script('booktopia-script', get_template_directory_uri() . "/assets/js/script.js", array(), '1.0', true);
    wp_enqueue_script('booktopia-script-navigation', get_template_directory_uri() . "/assets/js/navigation.js", array(), '1.0', true);
    wp_enqueue_script('booktopia-script-header', get_template_directory_uri() . "/assets/js/header.js", array(), '1.0', true);
    wp_enqueue_script('booktopia-script-slider', get_template_directory_uri() . "/assets/js/slider.js", array(), '1.0', true);
    // IF NEED DEPENDENCIES
    // wp_enqueue_script('booktopia-header', get_template_directory_uri() . "/assets/js/header.js", array('booktopia-script'), '1.0', true);
    // THEN THE SCRIPT.JS WILL BE LOADED FIRST
}

add_action('wp_enqueue_scripts', 'booktopia_register_script');

add_filter('show_admin_bar', '__return_false');


function get_products_data() {
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1
    );
    $loop = new WP_Query($args);
    $products = [];

    while ($loop->have_posts()) : $loop->the_post();
        global $product;
        $product_data = [
            'title' => get_the_title(),
            'description' => $product->get_description(),
            'images' => []
        ];

        $image_ids = $product->get_gallery_image_ids();
        array_unshift($image_ids, $product->get_image_id()); // Add main image to the front

        foreach ($image_ids as $image_id) {
            $product_data['images'][] = wp_get_attachment_url($image_id);
        }

        $products[] = $product_data;
    endwhile;
    wp_reset_query();

    return $products;
}

add_filter('the_content', 'replace_nbsp_with_space');
function replace_nbsp_with_space($content) {
    return str_replace('&nbsp;', ' ', $content);
}


?>