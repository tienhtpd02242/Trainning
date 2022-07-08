<div class="product" id="productPlan<?php echo $key + 1;?>">

        <?php if ( !empty( $item_prd['label'])): ?>
          <span class="_label"><?php echo $item_prd['label'];?></span>
        <?php endif; ?>

        <?php if ( !empty( $item_prd['name'])): ?>
          <h4 class="_name"><?php echo $item_prd['name'];?></h4>
        <?php endif; ?>

        <?php if ( !empty( $item_prd['image'])): ?>
          <figure>
            <img src="<?php echo esc_url($item_prd['image']['url']);?>" alt="<?php echo esc_attr($item_prd['image']['alt']); ?>">
          </figure>
        <?php endif; ?>

        <?php if ( !empty( $item_prd['ingredients'])): ?>
          <div class="_ingredients list_plan">
            <h4><?php echo __('Ingredients', 'mealprep');?></h4>
            <?php foreach ($item_prd['ingredients'] as $value): ?>

              <?php if (!empty($value['content'])): ?>
                <div class="_item_ingr ingr">
                  <?php echo $value['content'];?>
                </div>
              <?php endif; ?>

            <?php endforeach; ?>

            <?php if ( count($item_prd['ingredients']) > 4 ): ?>
              <a class="show _see_ingr" href="#"><?php echo __('See all ingredients', 'mealprep');?></a>
            <?php endif; ?>

          </div>
        <?php endif; ?>

        <?php if ( !empty( $item_prd['steps'])): ?>
          <div class="_steps list_plan">
            <h4><?php echo __('Steps', 'mealprep');?></h4>
            <?php foreach ($item_prd['steps'] as $key => $item_step): ?>

              <?php if (!empty($item_step['content'])): ?>
                <div class="_item_ingr st">
                  <span><?php echo $key + 1;?>.</span>
                  <?php echo $item_step['content'];?>
                </div>
              <?php endif; ?>

            <?php endforeach; ?>

            <?php if ( count($item_prd['steps']) > 4 ): ?>
              <a class="show _see_step" href="#"><?php echo __('See all steps', 'mealprep');?></a>
            <?php endif; ?>

          </div>
        <?php endif; ?>

        <?php if ( !empty( $item_prd['cta_url']) && !empty($item_prd['cta_text']) ): ?>
          <div class="_bottom">
            <a target="<?php echo (!empty( $item_prd['open_new_tab'])) ? '_blank' : '_self';?>" href="<?php echo $item_prd['cta_url'];?>">
              <?php echo $item_prd['cta_text'];?>
              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M2.80003 1.8667C2.5525 1.8667 2.3151 1.96503 2.14007 2.14007C1.96503 2.3151 1.8667 2.5525 1.8667 2.80003V11.2C1.8667 11.4476 1.96503 11.685 2.14007 11.86C2.3151 12.035 2.5525 12.1334 2.80003 12.1334H11.2C11.4476 12.1334 11.685 12.035 11.86 11.86C12.035 11.685 12.1334 11.4476 12.1334 11.2V7.93337C12.1334 7.8096 12.0842 7.6909 11.9967 7.60338C11.9092 7.51587 11.7905 7.4667 11.6667 7.4667C11.5429 7.4667 11.4242 7.51587 11.3367 7.60338C11.2492 7.6909 11.2 7.8096 11.2 7.93337V11.2H2.80003V2.80003H6.0667C6.19047 2.80003 6.30917 2.75087 6.39668 2.66335C6.4842 2.57583 6.53337 2.45714 6.53337 2.33337C6.53337 2.2096 6.4842 2.0909 6.39668 2.00338C6.30917 1.91587 6.19047 1.8667 6.0667 1.8667H2.80003ZM11.9971 2.00297C12.0839 2.08997 12.1328 2.20769 12.1334 2.33057V5.13337C12.1334 5.25714 12.0842 5.37583 11.9967 5.46335C11.9092 5.55087 11.7905 5.60003 11.6667 5.60003C11.5429 5.60003 11.4242 5.55087 11.3367 5.46335C11.2492 5.37583 11.2 5.25714 11.2 5.13337V3.4599L6.3971 8.26377C6.35371 8.30716 6.3022 8.34157 6.24551 8.36506C6.18882 8.38854 6.12806 8.40062 6.0667 8.40062C6.00534 8.40062 5.94458 8.38854 5.88789 8.36506C5.8312 8.34157 5.77969 8.30716 5.7363 8.26377C5.69291 8.22038 5.65849 8.16887 5.63501 8.11218C5.61153 8.05549 5.59944 7.99473 5.59944 7.93337C5.59944 7.87201 5.61153 7.81125 5.63501 7.75456C5.65849 7.69787 5.69291 7.64636 5.7363 7.60297L10.5402 2.80003H8.8667C8.74293 2.80003 8.62423 2.75087 8.53672 2.66335C8.4492 2.57583 8.40003 2.45714 8.40003 2.33337C8.40003 2.2096 8.4492 2.0909 8.53672 2.00338C8.62423 1.91587 8.74293 1.8667 8.8667 1.8667H11.6667C11.728 1.86654 11.7888 1.8785 11.8455 1.90188C11.9022 1.92526 11.9537 1.95962 11.9971 2.00297Z" fill="white"/>
              </svg>
            </a>
          </div>
        <?php endif; ?>

      </div>

      <?php
$menu_pages = arpc_parents_child_pages();
if (empty($menu_pages)) {
	return;
}
global $post;

?>
<div class="left-hand-menu">
    <div class="mobile-menu">
        <a href="#" class="">IN THIS SECTION: <span class="lnr lnr-chevron-down"></span></a>
    </div>

    <h4>IN THIS SECTION:</h4>
    <nav>
        <ul>
			<?php foreach ($menu_pages as $menu_page) {
				$is_current = $menu_page->ID == $post->ID ? "current" : "";
				?>
                <li>
                    <a href="<?php the_permalink($menu_page->ID); ?>" class="<?php echo $is_current; ?>"><?php echo $menu_page->post_title; ?></a>
					<?php
					if ($is_current && have_rows('side_menu')) { ?>
                        <ul class="anchor-links">
							<?php while (have_rows('side_menu')) : the_row(); ?>
                                <li><a href="<?php the_sub_field('menu_links'); ?>"><?php the_sub_field('menu_name'); ?></a></li>
							<?php endwhile; ?>
                        </ul>
					<?php }else{

						if($menu_page->ID == 8728 ){

							$currentPage = get_the_ID();
							$sub_menu = get_field('side_menu', $currentPage );

							$chilPage = get_pages(array(
								'child_of' => 8728,
								'depth' => 2,
								'post_status' => array('publish', 'private'),
							));
							$arr_childP = [];
							foreach ($chilPage as $key => $value) {
								$arr_childP[] = $value->ID;
							}

							if (in_array( $currentPage, $arr_childP)) {
								if (!empty($chilPage)) {
									echo "<ul class='anchor-links'>";
									foreach ($chilPage as $key => $value) { ?>
										<li>
											<a href="<?php echo get_the_permalink( $value->ID );?>"><?php echo get_the_title( $value->ID ); ?></a>

											<?php
											if ( $value->ID == get_the_ID() ) {
												$subs_m = get_field('side_menu', $value->ID);
												if (!empty($subs_m)) { ?>
													<ul>
														<?php foreach ($subs_m as $sub): ?>
															<li><a href="<?php echo $sub['menu_links']; ?>"><?php echo $sub['menu_name']; ?></a></li>
														<?php endforeach; ?>
													</ul>
												<?php }
											}
											?>

										</li>
									<?php }
									echo "</ul>";
								}
							}else{}
						}
					}
										// print_r( $iAmParent );
                    // if( $menu_page->ID == 8728 ){
										// 	wp_list_pages( array(
										// 		'post_status' => array('private', 'publish'),
										// 		'child_of' => 8728,
										// 		'depth' => 2,
										// 		'sort_order' => 'asc',
					 					// 	));
										// }

					global $people ;
					// Board sub-menu
                    $anchors = [];
					if ($is_current && !empty($people)) {
						foreach ($people as $person):
								$slug = basename(get_permalink($person));
								$anchors[$slug] = get_the_title($person);
						endforeach;
						?>
                        <ul class="anchor-links">
							<?php foreach ($anchors as $key => $an): ?>
                                <li><a href="#<?php echo $key; ?>"><?php echo $an; ?></a></li>
							<?php endforeach; ?>
                        </ul>
						<?php
					}
					?>
                </li>
			<?php } ?>
        </ul>
    </nav>
</div>
