<?php 
/* Template Name: Search Ajax */ 

get_header();

$query_search = new WP_Query( array(
    'post_type' => 'post',
    'post_status' => 'publish',
));

echo "<div class='wrap__post'>";
    ?>
    <div class="wrap-search">
        <input id="valueInputSearch" type="text">
    </div>
    
    <?php
    if( $query_search->have_posts() ){
        echo "<div class='wrap'>";
            while ($query_search->have_posts()) {
                $query_search->the_post();
                ?>
                <div class="item">
                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                </div>
                <?php
            }
        echo "</div>";
        wp_reset_postdata();
    }
echo "</div>";


get_footer();