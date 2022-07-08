<?php
function tranning_enqueue_style() {
    wp_enqueue_script( 'jquery', get_stylesheet_directory_uri().'/package-main/js/jquery-3.6.0.min.js' );
    wp_enqueue_script( 'tranning', get_stylesheet_directory_uri().'/package-main/js/main.js');

    global $wp_query;
    wp_localize_script( 'tranning', 'pj_php_data', apply_filters( 'pj/wp_localize_script/pj_php_data', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'posts' => json_encode( $wp_query->query_vars),
        'current_page' => get_query_var ( 'paged') ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages
    ]));
}
add_action( 'wp_enqueue_scripts', 'tranning_enqueue_style' );