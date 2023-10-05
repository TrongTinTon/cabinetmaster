<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$tabs_style = get_theme_mod( 'product_display', 'tabs' );

// Get sections instead of tabs if set.
if ( $tabs_style == 'sections' ) {
	wc_get_template_part( 'single-product/tabs/sections' );

	return;
}

// Get accordion instead of tabs if set.
if ( $tabs_style == 'accordian' || $tabs_style == 'accordian-collapsed' ) {
	wc_get_template_part( 'single-product/tabs/accordian' );

	return;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 *
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

$tab_count   = 0;
$panel_count = 0;

if ( ! empty( $product_tabs ) ) : ?>
	<div id="sticky-tab" class="woocommerce-tabs wc-tabs-wrapper container tabbed-content">
		<div class="tab-panels">
			<div id="sticky-tab-chucnang-container" class="row">
				<div class="tab-container col small-2 large-2">
					<div id="sticky-tab-chucnang" class="tab-chucnang" >
					    <a href="#dac-diem"  id="head-dac-diem"  onclick="clickNavScroll(this, 'head-dac-diem', 'sticky-tab')" class="list-chucnang"><span>ĐẶC ĐIỂM</span></a>
					    <a href="#thong-so"  id="head-thong-so"  onclick="clickNavScroll(this, 'head-thong-so', 'sticky-tab')" class="list-chucnang"><span>THÔNG SỐ</span></a>
					    <a href="#hinh-anh"  id="head-hinh-anh"  onclick="clickNavScroll(this, 'head-hinh-anh', 'sticky-tab')" class="list-chucnang"><span>HÌNH ẢNH</span></a>
					    <!--<a href="#san-pham"  class="list-chucnang">SẢN PHẨM CỦA MÁY</a>-->
					    <a href="#video-may"id="head-video-may"  onclick="clickNavScroll(this, 'head-video-may', 'sticky-tab')"  class="list-chucnang"><span>VIDEO</span></a>
					</div>
				</div>
				<div class="tab-target-container col small-10 large-10">
					<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
						<?php if ($key == 'reviews') {continue;}?>
						<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content <?php if (in_array($key, array('ux_video_tab', 'description')) ) echo 'active'; ?>" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
							<?php if ( $key == 'description' && ux_builder_is_active() ) echo flatsome_dummy_text(); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
							<?php
							if ( isset( $product_tab['callback'] ) ) {
								call_user_func( $product_tab['callback'], $key, $product_tab );
							}
							?>
						</div>	    
						<?php $panel_count++; ?>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content active" id="tab-<?php echo esc_attr('reviews'); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr('reviews'); ?>">
				<?php
				if ( isset( $product_tabs['reviews']['callback'] ) ) {
					call_user_func( $product_tabs['reviews']['callback'], 'reviews', $product_tabs['reviews'] );
				}
				?>
			</div>	    
			<?php do_action( 'woocommerce_product_after_tabs' ); ?>
		</div>
	</div>
<?php endif; ?>
