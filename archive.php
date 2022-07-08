<?php 
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$query_p = new WP_Query( array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'order'       => 'DESC',
    'orderby'     => 'date',
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

        global $wp_query;
 
        $big = 999999999; // need an unlikely integer        
        echo paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $paged,
            'total' => $wp_query->max_num_pages,
        ) );

    echo "</div>";
    wp_reset_postdata();
}
get_footer();
?>
