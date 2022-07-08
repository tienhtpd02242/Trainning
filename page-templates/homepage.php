<?php 
/* Template Name: Homepage */ 
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$query_p = new WP_Query( array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'paged'       => $paged,
) );

if( $query_p->have_posts() ){
    echo "<div class='wrap__post'>";
        echo "<div class='wrap'>";
        while( $query_p->have_posts() ){
            $query_p->the_post();
            ?>
            <div class="item">
                <a href="<?php the_permalink();?>"><?php the_title();?></a>
            </div>
            <?php
        }
        
        echo "</div>";

        the_posts_pagination( array(
            'mid_size'  => 2,
            'prev_text' => __( 'Prev', 'textdomain' ),
            'next_text' => __( 'Next', 'textdomain' ),
        ) );

    echo "</div>";
    wp_reset_postdata();
}
get_footer();
?>
