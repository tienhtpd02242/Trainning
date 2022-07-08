<?php
add_action( 'wp_ajax_nopriv_pagination_load', 'pagination_load' );
add_action( 'wp_ajax_pagination_load', 'pagination_load' );
function pagination_load() {

    $paged_ajax = $_POST['page'];

    $data = array();

    ob_start();
    $arg_ajax = new WP_Query( array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged'       => $paged_ajax,
        'posts_per_page' => get_option( 'posts_per_page' ),
    ));

    if($arg_ajax>have_posts()){
        while( $arg_ajax->have_posts() ){
            $arg_ajax->the_post();
            ?>
            <div class="item">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </div>
            <?php
        }
        wp_reset_postdata();

    }

    $content = ob_get_clean();

    $data['contents'][] = $content;

    $total_pages = $arg_ajax->max_num_pages;

    if ( $total_pages > 1 ) {
        ob_start();

        echo paginate_links(array(
            'base' => site_url() . '%_%',
            'format' => '?paged=%#%',
            'current' => max ( 1, $paged_ajax ),
            'total' => $total_pages,
            'prev_text'    => __('« Prev'),
            'next_text'    => __('Next »'),
        ));

        $pagination = ob_get_clean();


        $data['pagination'] = $pagination;
    }

    wp_send_json($data);

    die();
}

add_action('wp_ajax_tranning_load_more', 'tranning_load_more');
add_action('wp_ajax_nopriv_tranning_load_more', 'tranning_load_more');
function tranning_load_more() {

    $args = json_decode( stripslashes( $_POST['query'] ), true );
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';

    query_posts( $args );

    if(have_posts()){
        while( have_posts()){
            the_post();
            ?><div class='title'><?php
            the_title();
            ?></div> <?php
        }
        wp_reset_postdata();
    }
    exit();
}

add_action('wp_ajax_data_fetch_search_ajax' , 'data_fetch_search_ajax');
add_action('wp_ajax_nopriv_data_fetch_search_ajax','data_fetch_search_ajax');
function data_fetch_search_ajax(){

    $keyword = $_POST['keyword'] ? $_POST['keyword'] : '';
    echo $keyword;

    if( $keyword !== ' ' ){
        $the_query = new WP_Query( 
            array( 
                'post_type' => 'post',
                's' => $keyword,
                'post_status' => 'publish',
            )
        );
    }else{
        $the_query = new WP_Query( 
            array( 
                'post_type' => 'post',
                'post_status' => 'publish',
            )
        );
    }
    
    
    if( $the_query->have_posts() ){
        while( $the_query->have_posts() ): $the_query->the_post();

        $myquery = esc_attr( $keyword );

        $search = get_the_title();
        
        if( stripos("/{$search}/", $myquery) !== false) {
            ?>
            <div class="item">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </div>
            <?php                     
        }
        endwhile;
        wp_reset_postdata();  
    }else{
        echo '<p class="not-found">Not Found...</p>';
    }

    die();
}

add_action('wp_ajax_filter_post_by_category' , 'filter_post_by_category');
add_action('wp_ajax_nopriv_filter_post_by_category','filter_post_by_category');
function filter_post_by_category(){
    
    $slug_cat = $_POST['slug_cat'] ? $_POST['slug_cat'] : 'nothing';
    $data_arr = $_POST['data_arr'];
    $next_page = $_POST['next_page'] ? $_POST['next_page'] : 1;
    
    // $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $array_item = array();
    ob_start();
    $arg_cat = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'date',
        'order'   => 'DESC',
        'paged'    => $next_page,
    );

    if( $slug_cat != 'all' ){
        $arg_cat['category_name'] = $slug_cat;
    }else{
        $arg_cat['category_name'] = $data_arr;
    }

    $query_p_ajax = new WP_Query($arg_cat);

    $total_page_ajax = $query_p_ajax->max_num_pages;

    if( $query_p_ajax->have_posts()){
        while( $query_p_ajax->have_posts()) {
            $query_p_ajax->the_post();
            ?>
                <div class="item">
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </div>
            <?php
        }
        wp_reset_postdata();
    }

    $item_post = ob_get_clean();
    $array_item['item_posts'] = $item_post;

    ob_start();
    if( $total_page_ajax > 1 ){
        echo paginate_links(array(
            'base' => site_url() . '%_%',
            'format' => '&paged=%#%',
            'current' => max ( 1, $next_page ),
            'total' => $total_page_ajax,
            'prev_text'    => __('« Prev'),
            'next_text'    => __('Next »'),
        ));
    }
    $pagination_filter_p = ob_get_clean(); 
    $array_item['pagination_filter'] = $pagination_filter_p;

    $array_item['status'] = $arg_cat;

    wp_send_json($array_item);

    die();
}

add_action('wp_ajax_filterPostByPostType' , 'filterPostByPostType');
add_action('wp_ajax_nopriv_filterPostByPostType','filterPostByPostType');
function filterPostByPostType(){

    $slug_post_type = ($_POST['post_type'] != 'all') ? $_POST['post_type'] : array('movies', 'pictures', 'music');
    $paged = $_POST['paged'] ? $_POST['paged'] : 1 ;

    $arrayPostPT = array();

    ob_start();
    $argPT = array(
        'post_type' => $slug_post_type,
        'post_status' => 'publish',
        'orderby' => 'date',
        'order' => 'DESC',
        'paged' => $paged,
    );

    $query_p_pt = new WP_Query( $argPT );

    if ($query_p_pt->have_posts() ) {
        while ( $query_p_pt->have_posts() ) {
            $query_p_pt->the_post();
            ?>
                <div class="item">
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </div>
            <?php
        }
        wp_reset_postdata();
    }

    $item = ob_get_clean();
    $arrayPostPT['items'] = $item;

    $total_page_pt = $query_p_pt->max_num_pages;
    ob_start();
    if ( $total_page_pt > 1) {
        echo paginate_links(array(
            'base' => site_url() . '%_%',
            'format' => '&paged=%#%',
            'current' => max ( 1, $paged ),
            'total' => $total_page_pt,
            'prev_text'    => __('« Prev'),
            'next_text'    => __('Next »'),
        ));
    }
    $pagination_pt = ob_get_clean();
    $arrayPostPT['paginations'] = $pagination_pt;

    $arrayPostPT['status'] = $argPT;
    wp_send_json($arrayPostPT);

    die();
}