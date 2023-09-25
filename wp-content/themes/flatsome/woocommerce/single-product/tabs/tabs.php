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

	<div class="woocommerce-tabs wc-tabs-wrapper container tabbed-content">
		<div class="tab-chucnang" >
		    <a href="#dac-diem"  class="list-chucnang">ĐẶC ĐIỂM</a>
		    <a href="#thong-so"  class="list-chucnang">THÔNG SỐ</a>
		    <a href="#hinh-anh"  class="list-chucnang">HÌNH ẢNH</a>
		    <!--<a href="#san-pham"  class="list-chucnang">SẢN PHẨM CỦA MÁY</a>-->
		    <a href="#video-may" class="list-chucnang">VIDEO</a>
		</div>
		
		<div class="tab-panels">
			<?php foreach ( $product_tabs as $key => $product_tab ) : ?>
				<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content <?php if ( $panel_count == 0 ) echo 'active'; ?>" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
					<?php if ( $key == 'description' && ux_builder_is_active() ) echo flatsome_dummy_text(); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
					<?php
					if ( isset( $product_tab['callback'] ) ) {
						call_user_func( $product_tab['callback'], $key, $product_tab );
					}
					?>
					<!--content-lien he-->
					<div class="content-lienhe">
					    <div id="col-166983735" class="col small-12 large-12">
				            <div class="col-inner">
			                    <h4><span style="color: #d83131;">Liên hệ ngay với Quốc Duy để được tư vấn – báo giá miễn phí hoàn toàn</span></h4>
		                        <div class="icon-box featured-box icon-box-left text-left">
					                <div class="icon-box-img" style="width: 50px">
				                        <div class="icon">
					                        <div class="icon-inner">
						                        <img width="256" height="256" src="https://cabinetmaster.vn/wp-content/uploads/2022/09/hotline.png" class="attachment-medium size-medium" alt="HOTLINE KINGWOODMAC" loading="lazy" srcset="https://cabinetmaster.vn/wp-content/uploads/2022/09/hotline.png 256w, https://cabinetmaster.vn/wp-content/uploads/2022/09/hotline-150x150.png 150w, https://cabinetmaster.vn/wp-content/uploads/2022/09/hotline-100x100.png 100w" sizes="(max-width: 256px) 100vw, 256px">
						                    </div>
				                        </div>
			                        </div>
				                    <div class="icon-box-text last-reset">
                                        <h4>HOTLINE 24/7</h4>
                                        <p><span style="color: #ff6600; font-size: 110%;"><a style="color: #ff6600;" href="tel:0903600113"><strong>0903 600 113</strong></a></span></p>
		                            </div>
	                            </div>
	                            
                    <!--dienthoai-tuvan-->
                    
		                        <div class="icon-box featured-box icon-box-left text-left">
					                <div class="icon-box-img" style="width: 56px">
				                        <div class="icon">
					                        <div class="icon-inner">
						                        <img width="256" height="256" src="https://cabinetmaster.vn/wp-content/uploads/2022/09/dien-thoai.png" class="attachment-medium size-medium" alt="ĐIỆN THOẠI CABINETMASTER" loading="lazy" srcset="https://cabinetmaster.vn/wp-content/uploads/2022/09/dien-thoai.png 256w, https://cabinetmaster.vn/wp-content/uploads/2022/09/dien-thoai-150x150.png 150w, https://cabinetmaster.vn/wp-content/uploads/2022/09/dien-thoai-100x100.png 100w" sizes="(max-width: 256px) 100vw, 256px">					
						                    </div>
				                        </div>
			                        </div>
				                    <div class="icon-box-text last-reset">
									    <h4>Điện thoại tư vấn – báo giá</h4>
                                        <p><span style="color: #ff6600; font-size: 110%;"><a style="color: #ff6600;" href="tel:02873095276"><b>(+84-28) 7309 5276</b></a></span></p>
		                            </div>
	                            </div>
	                            
	                <!--email-->
	                
		                        <div class="icon-box featured-box icon-box-left text-left">
					                <div class="icon-box-img" style="width: 56px">
				                        <div class="icon">
					                        <div class="icon-inner">
						                        <img width="256" height="256" src="https://cabinetmaster.vn/wp-content/uploads/2022/09/email.png" class="attachment-medium size-medium" alt="EMAIL CABINETMASTER" loading="lazy" srcset="https://cabinetmaster.vn/wp-content/uploads/2022/09/email.png 256w, https://cabinetmaster.vn/wp-content/uploads/2022/09/email-150x150.png 150w, https://cabinetmaster.vn/wp-content/uploads/2022/09/email-100x100.png 100w" sizes="(max-width: 256px) 100vw, 256px">			
						                    </div>
				</div>
			</div>
				                    <div class="icon-box-text last-reset">
                                        <h4>Email</h4>
                                        <p><span style="color: #ff6600; font-size: 110%;"><a style="color: #ff6600;" href="mailto:info@quocduy.com.vn"><b>info@quocduy.com.vn</b></a></span></p>
		                            </div>
	                            </div>
	                            
	                <!--website-->
	                
	                        	<div class="icon-box featured-box icon-box-left text-left">
					                <div class="icon-box-img" style="width: 60px">
				                        <div class="icon">
					                        <div class="icon-inner">
						                        <img width="256" height="256" src="https://cabinetmaster.vn/wp-content/uploads/2022/09/website.png" class="attachment-medium size-medium" alt="website kingwoodmac" loading="lazy" srcset="https://cabinetmaster.vn/wp-content/uploads/2022/09/website.png 256w, https://cabinetmaster.vn/wp-content/uploads/2022/09/website-150x150.png 150w, https://cabinetmaster.vn/wp-content/uploads/2022/09/website-100x100.png 100w" sizes="(max-width: 256px) 100vw, 256px">				
						                    </div>
				</div>
			</div>
				                    <div class="icon-box-text last-reset">
                                        <h4>Website</h4>
                                        <p><span style="font-size: 120%; color: #ff6600;"><b><a style="color: #ff6600;" href="http://www.quocduy.com.vn" target="_blank" rel="noopener">www.quocduy.com.vn</a> – <a style="color: #ff6600;" href="http://www.semac.com.vn" target="_blank" rel="noopener">www.semac.com.vn</a></b></span></p>
		                            </div>
	                            </div>
	                            
	                <!--d/chi-->
	                
	                        	<div class="icon-box featured-box icon-box-left text-left">
					                <div class="icon-box-img" style="width: 60px">
                        				<div class="icon">
					                        <div class="icon-inner">
                        						<img width="256" height="256" src="https://cabinetmaster.vn/wp-content/uploads/2022/09/dia-chi.png" class="attachment-medium size-medium" alt="ĐỊA CHỈ CABINETMASTER" loading="lazy" srcset="https://cabinetmaster.vn/wp-content/uploads/2022/09/dia-chi.png 256w, https://cabinetmaster.vn/wp-content/uploads/2022/09/dia-chi-150x150.png 150w, https://cabinetmaster.vn/wp-content/uploads/2022/09/dia-chi-100x100.png 100w" sizes="(max-width: 256px) 100vw, 256px">				
                        					</div>
				</div>
			</div>
				                    <div class="icon-box-text last-reset">
                                        <h4>ĐỊA CHỈ XEM MÁY</h4>
                                        <p><span style="color: #ff6600; font-size: 110%;"><b>401 Tô Ngọc Vân, KP1, Phường Thạnh Xuân, Quận 12, TP. Hồ Chí Minh</b></span></p>
		                            </div>
	                            </div>
	                       	</div>
					    </div>
					
					<!--content-mak-SEO-->
					
					<div class="content-mkt">
					    <div class="container section-title-container"><h4 class="section-title section-title-bold"><b></b><span class="section-title-main"><i class="icon-angle-down"></i>Để mang đến sự thuận tiện cho Quý Khách , chúng tôi cung cấp đa dạng các phương thức hỗ trợ tư vấn online như bên dưới. Xin vui lòng lựa chọn phương thức phù hợp.</span><b></b></h4>
					    </div>
					</div>
					
					<!--phuong-thuc-lien-he-->
					<div class="row row-box-shadow-1 row-box-shadow-1-hover" id="row-687457482">
	                    <div id="col-1881610074" class="col medium-3 small-6 large-3">
				            <div class="col-inner">
	                            <a class="plain" href="tel:0903600113">	</a>
	                                <div class="icon-box featured-box icon-box-center text-center">
	                                    <a class="plain" href="tel:0903600113">
					                        <div class="icon-box-img" style="width: 60px">
				                                <div class="icon">
					                                <div class="icon-inner">
						                                <img width="256" height="256" src="https://cabinetmaster.vn/wp-content/uploads/2022/11/phone-call-cabinetmaster.webp" class="attachment-medium size-medium" alt="HOTLINE CABINETMASTER" decoding="async" loading="lazy" srcset="https://cabinetmaster.vn/wp-content/uploads/2022/11/phone-call-cabinetmaster.webp 256w, https://cabinetmaster.vn/wp-content/uploads/2022/11/phone-call-cabinetmaster-150x150.webp 150w, https://cabinetmaster.vn/wp-content/uploads/2022/11/phone-call-cabinetmaster-100x100.webp 100w" sizes="(max-width: 256px) 100vw, 256px">
						                            </div>
				                                </div>
			                                </div>
			                              </a>
			                     <div class="icon-box-text last-reset">
			                        <a class="plain" href="tel:0903600113">
                                        <h4>Hotline</h4>
                                        <p>Hỗ trợ tư vấn qua hình thức trao đổi trực tiếp với nhân viên của chúng tôi.</p>
                                    </a>
                                    <a href="tel:0903600113" target="_self" class="button primary" style="border-radius:5px;">
                                        <span>gọi ngay</span>
                                    </a>
		                          </div>
	                           </div>
		                  </div>
					</div>
					<!--LIVE-CHAT-->
                        <div id="col-1592581859" class="col medium-3 small-6 large-3">
				            <div class="col-inner">
				                <a class="plain" href="https://tawk.to/chat/63291e3037898912e96a28f6/1gdc9rsg8" rel="noopener">	
				                </a>
				                <div class="icon-box featured-box icon-box-center text-center">
				                    <a class="plain" href="https://tawk.to/chat/63291e3037898912e96a28f6/1gdc9rsg8" rel="noopener">
					                    <div class="icon-box-img" style="width: 60px">
				                            <div class="icon">
					                            <div class="icon-inner">
						                            <img width="256" height="256" src="https://cabinetmaster.vn/wp-content/uploads/2022/09/chat.png" class="attachment-medium size-medium" alt="Live chat cabinetmaster" decoding="async" loading="lazy" srcset="https://cabinetmaster.vn/wp-content/uploads/2022/09/chat.png 256w, https://cabinetmaster.vn/wp-content/uploads/2022/09/chat-100x100.png 100w, https://cabinetmaster.vn/wp-content/uploads/2022/09/chat-150x150.png 150w" sizes="(max-width: 256px) 100vw, 256px">
						                        </div>
				                            </div>
			                            </div>
				                    </a>
				                    <div class="icon-box-text last-reset">
				                        <a class="plain" href="https://tawk.to/chat/63291e3037898912e96a28f6/1gdc9rsg8" rel="noopener">
                                            <h4>Livechat</h4>
                                            <p>Hỗ trợ tư vấn qua hình thức chat trực tuyến với nhân viên của chúng tôi.</p>
                                        </a>
                                        <a href="https://tawk.to/chat/63291e3037898912e96a28f6/1gdc9rsg8" target="_self" class="button primary" style="border-radius:5px;" rel="noopener">
                                            <span>Chat ngay</span>
                                        </a>

		                            </div>
	                            </div>
		                    </div>
					    </div>
					<!--ZALO-CHAT-->
	                    <div id="col-1017118068" class="col medium-3 small-6 large-3">
				            <div class="col-inner">
	                            <a class="plain" href="https://zalo.me/0903600113" rel="noopener">
	                            </a>
	                            <div class="icon-box featured-box icon-box-center text-center">
	                                <a class="plain" href="https://zalo.me/0903600113" rel="noopener">
					                    <div class="icon-box-img" style="width: 60px">
				                            <div class="icon">
					                            <div class="icon-inner">
						                            <img width="256" height="256" src="https://cabinetmaster.vn/wp-content/uploads/2022/09/zalo.png" class="attachment-medium size-medium" alt="CHAT ZALO CABINETMASTER" decoding="async" loading="lazy" srcset="https://cabinetmaster.vn/wp-content/uploads/2022/09/zalo.png 256w, https://cabinetmaster.vn/wp-content/uploads/2022/09/zalo-100x100.png 100w, https://cabinetmaster.vn/wp-content/uploads/2022/09/zalo-150x150.png 150w" sizes="(max-width: 256px) 100vw, 256px">
						                        </div>
				                            </div>
		                                </div>
				                    </a>
				                    <div class="icon-box-text last-reset">
				                        <a class="plain" href="https://zalo.me/0903600113" rel="noopener">
                                            <h4>Zalo chat</h4>
                                            <p>Nhắn tin hoặc gọi qua Zalo của chúng tôi để hỗ trợ tư vấn – báo giá miễn phí.</p>
                                        </a>
                                        <a href="https://zalo.me/0903600113" target="_self" class="button primary" style="border-radius:5px;" rel="noopener">
                                            <span>Chat ngay</span>
                                        </a>
		                            </div>
	                            </div>
		                      </div>
					       </div>
					<!--FACEBOOK-->
	                    <div id="col-259044436" class="col medium-3 small-6 large-3">
			            	<div class="col-inner">
	                            <a class="plain" href="https://m.me/xuongmaychebiengoQuocDuy">	
	                            </a>
	                            <div class="icon-box featured-box icon-box-center text-center">
	                                <a class="plain" href="https://m.me/xuongmaychebiengoQuocDuy">
					                    <div class="icon-box-img" style="width: 60px">
				                            <div class="icon">
					                            <div class="icon-inner">
						                            <img width="256" height="256" src="https://cabinetmaster.vn/wp-content/uploads/2022/09/facebook-messenger.png" class="attachment-medium size-medium" alt="CHAT FACEBOOK CABINETMASTER" decoding="async" loading="lazy" srcset="https://cabinetmaster.vn/wp-content/uploads/2022/09/facebook-messenger.png 256w, https://cabinetmaster.vn/wp-content/uploads/2022/09/facebook-messenger-100x100.png 100w, https://cabinetmaster.vn/wp-content/uploads/2022/09/facebook-messenger-150x150.png 150w" sizes="(max-width: 256px) 100vw, 256px">
						                        </div>
				                            </div>
			                            </div>
				                    </a>
				                    <div class="icon-box-text last-reset">
				                        <a class="plain" href="https://m.me/xuongmaychebiengoQuocDuy">
                                            <h4>Facebook</h4>
                                            <p>Nhắn tin hoặc gọi qua Facebook của chúng tôi để được hỗ trợ tư vấn.</p>
                                        </a>
                                        <a href="https://m.me/xuongmaychebiengoQuocDuy" target="_self" class="button primary" style="border-radius:5px;">
                                            <span>Chat ngay</span>
                                        </a>
		                            </div>
                                </div>
		                   </div>
					</div>
                    </div>
				<?php $panel_count++; ?>
			<?php endforeach; ?>

			<?php do_action( 'woocommerce_product_after_tabs' ); ?>
		</div>
	</div>

<?php endif; ?>
