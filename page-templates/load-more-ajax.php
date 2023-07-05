<?php 
/* Template Name: Load More Ajax */ 
get_header();


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
<input type="hidden" id="currentPage" value="<?php echo $paged;?>">
<input type="hidden" id="max_page" value="<?php echo $query_post_type->max_num_pages;?>">
<div class="wrap-body loadmore">
    <div class="wrap-cat">
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

    <?php if ( $query_post_type->max_num_pages > 1  ) {
        ?>
        <button id="loadMoreTemplate">Load More</button>
        <?php
    } ?>
    
</div>
<?php

get_footer();