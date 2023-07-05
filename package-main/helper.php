<?php
if ( ! function_exists( 'mytheme_register_nav_menu' ) ) {
 
    function mytheme_register_nav_menu(){
        register_nav_menus( array(
            'main_menu' => __( 'Main Menu', 'text_domain' ),
            'mega_menu' => __( 'Mega Menu', 'text_domain' ),
        ) );
    }
    add_action( 'after_setup_theme', 'mytheme_register_nav_menu', 0 );
}


function trainning_render_pagination_lst() {
    echo '<div class="pagination-blog-post">';
    the_posts_pagination( array(
        'type' => 'plain',
        'mid_size' => 1,
        'format'		=> '?page=%#%',
        'prev_text' => __( '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 4L2.5 8L6.5 12" stroke="#333333" stroke-linecap="square"/><path d="M14.5 8L3.16667 8" stroke="#333333" stroke-linecap="square"/>
                            <path d="M2.50008 8L3.16675 8" stroke="#333333" stroke-linecap="round"/></svg>Newer', 'pp' ),
        'next_text' => __( 'Older<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.5 12L14.5 8L10.5 4" stroke="#333333" stroke-linecap="square"/><path d="M2.5 8H13.8333" stroke="#333333" stroke-linecap="square"/><path d="M14.4999 8H13.8333" stroke="#333333" stroke-linecap="round"/></svg>', 'pp' ),
        'screen_reader_text' => false
    ) );
    echo '</div>';
}

function filterByFieldPost($query){
    if( !is_admin() && $query->is_main_query() ){
        if( is_category() || is_tag() ){
            $meta_query = array();
            if ( $_GET['filter_by'] == 'videos' ) {
                $meta_query[]  =   array(
                       'key'=>'video',
                       'value'=> '',
                       'compare'=>'!=',
                );
            }
            $query->set('meta_query',$meta_query);
        }
    }
}
add_action( 'pre_get_posts', 'filterByFieldPost' );

?>