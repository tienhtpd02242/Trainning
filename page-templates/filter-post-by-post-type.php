<?php 
/* Template Name: Filter Post By Post Type */ 
get_header('filter-post-type');

$paged = get_query_var('paged') ? get_query_var('paged') : 1;

$args = array(
    'post_type' => array('movies', 'pictures', 'music'),
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
);
$query_post_type = new WP_Query( $args );

?>
<div class="wrap-body">
    <div class="wrap-cat posttype">
        <?php 
        if ($query_post_type->have_posts() ) {
            while ($query_post_type->have_posts() ) {
                $query_post_type->the_post();
                ?>
                    <div class="item">
                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                    </div>
                <?php
            }
            wp_reset_postdata();
        }
        ?>
    </div>

    <?php 
        $total_page_pt = $query_post_type->max_num_pages;
        if ( $total_page_pt > 1 ) {
            echo "<div class='wrap_pagination_pt'>";
                echo paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => '?paged=%#%',
                    'current' => max ( 1, $paged ),
                    'total' => $total_page_pt,
                    'prev_text'    => __('« Prev'),
                    'next_text'    => __('Next »'),
                ));

            echo "</div>";
        }
    ?>
    
</div>

<?php

get_footer();
?>