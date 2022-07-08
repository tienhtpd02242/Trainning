<?php 
/* Template Name: Filter Post By $_GET */ 
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$query_p = new WP_Query( array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'paged'       => $paged,
) );

echo "<div class='wrap__post'>";
    if( $query_p->have_posts() ){
            echo "<div class='wrap'>";
            while( $query_p->have_posts() ){
                $query_p->the_post();
                ?>
                <div class="item">
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </div>
                <?php
            }
            wp_reset_postdata();
            
            echo "</div>";

            the_posts_pagination( array(
                'type' => 'plain',
                'mid_size' => 1,
                'format'		=> '?page=%#%',
                'prev_text' => __( '<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.5 4L2.5 8L6.5 12" stroke="#333333" stroke-linecap="square"/><path d="M14.5 8L3.16667 8" stroke="#333333" stroke-linecap="square"/>
                                    <path d="M2.50008 8L3.16675 8" stroke="#333333" stroke-linecap="round"/></svg>Newer', 'pp' ),
                'next_text' => __( 'Older<svg width="17" height="16" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.5 12L14.5 8L10.5 4" stroke="#333333" stroke-linecap="square"/><path d="M2.5 8H13.8333" stroke="#333333" stroke-linecap="square"/><path d="M14.4999 8H13.8333" stroke="#333333" stroke-linecap="round"/></svg>', 'pp' ),
                'screen_reader_text' => false
                ) );

            trainning_render_pagination_lst();

        wp_reset_postdata();
    }

echo "</div>";

get_footer();