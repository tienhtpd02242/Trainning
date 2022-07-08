<?php
get_header();

echo "Hello Everybody. This is Archive Page";

$option = $_GET['filter_by'] ? $_GET['filter_by'] : 'all';

echo "<div class='wrap__post'>";
        ?>
        <select id="filterPost">
            <option value="">All</option>
            <option value="videos" <?php if($option == 'videos') echo "selected"; ?>>Videos</option>
            <option value="image" <?php if($option == 'image') echo "selected"; ?>>Images</option>
            <option value="music" <?php if($option == 'music') echo "selected"; ?>>Music</option>
        </select>
        <?php 
    if( have_posts() ){
            echo "<div class='wrap'>";
            while( have_posts() ){
                the_post();
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
                'prev_text' => __( 'Newer', 'pp' ),
                'next_text' => __( 'Older', 'pp' ),
                'screen_reader_text' => false
            ) );
    }

echo "</div>";

?>
<script type="text/javascript">
    ( function( w, $ ) {
        $(document).ready(function() {
            $("#filterPost").on('change', function(){
              if (typeof URLSearchParams !== 'undefined') {
                  // Get current URL and params
                  current_url = new URL(window.location.href);
                  let params = new URLSearchParams(current_url.search);

                  // Remove params page and filter_by
                  params.delete('page');
                  params.delete('filter_by');

                  // Set new value for filter_by if it exists
                  $new_filter_val = $(this).val();
                  if ( $new_filter_val ) params.set('filter_by', $new_filter_val);

                  // Push new params to URL and reload page
                  window.history.replaceState({}, '', `${location.pathname}?${params}`);
                  location.reload();
              } else {
                  console.log(`Your browser ${navigator.appVersion} does not support URLSearchParams`)
              }
            });
        });
    } )( window, jQuery );
</script>
<?php

get_footer();