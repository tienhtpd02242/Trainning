<?php 
/* Template Name: Filter Post By Category */ 
get_header();

$list_categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );

?>
<div class="wrap-body">
    <div class="list-cat">
        <?php 
        if ( !empty($list_categories)) {
            echo "<ul id='ulFilterCat'>";

            $arr_cat = [];
            foreach ($list_categories as $key => $value) {
                $arr_cat[$key] = $value->slug;

                if ($key == 0) echo '<li class="active" data-cat="all">All</li>';
                ?>
                <li data-cat="<?php echo $value->slug;?>"><?php echo $value->name;?></li>
                <?php
            }
            echo "</ul>";

            $last_arr_cat = implode( ',',$arr_cat );
            echo "<input type='hidden' name='arrCat' id='arrayCategory' value='". $last_arr_cat ."' />";

        }
        ?>
        <div class="__post-filter">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $arg_cat = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'orderby' => 'date',
                'order'   => 'DESC',
                'category_name' => $last_arr_cat,
                'paged'    => $paged,
            );

            $query_all = new WP_Query($arg_cat);

            $total_page = $query_all->max_num_pages;

            if( $query_all->have_posts(  )){
                echo "<div class='wrap-cat'>";
                    while( $query_all->have_posts()) {
                        $query_all->the_post();
                        ?>
                            <div class="item">
                                <a href="<?php the_permalink();?>"><?php the_title();?></a>
                            </div>
                        <?php
                    }
                    wp_reset_postdata();
                echo "</div>";
            }

            if( $total_page > 1 ){
                echo "<div class='wrap_pagination_cat'>";

                    echo paginate_links(array(
                        'base' => get_pagenum_link(1) . '%_%',
                        'format' => '&paged=%#%',
                        'current' => max ( 1, $paged ),
                        'total' => $total_page,
                        'prev_text'    => __('« Prev'),
                        'next_text'    => __('Next »'),
                    ));

                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>
<?php

get_footer();