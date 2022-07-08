<?php
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
            
            echo "</div>";

            $total_pages = $query_p->max_num_pages;
            if ($total_pages > 1) {
                echo "<div class='wrap_pagination'>";

                    echo paginate_links(array(
                        'base' => get_pagenum_link(1) . '%_%',
                        'format' => '&paged=%#%',
                        'current' => max ( 1, $paged ),
                        'total' => $total_pages,
                        'prev_text'    => __('« Prev'),
                        'next_text'    => __('Next »'),
                    ));

                echo "</div>";
            }

        wp_reset_postdata();
    }

echo "</div>";

get_footer();
?>