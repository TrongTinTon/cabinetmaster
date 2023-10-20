<?php
/**
 * Flatsome functions and definitions
 *
 * @package flatsome
 */

require get_template_directory() . '/inc/init.php';

/**
 * Note: It's not recommended to add any custom code here. Please use a child theme so that your customizations aren't lost during updates.
 * Learn more here: http://codex.wordpress.org/Child_Themes
 */
 
/*
* Code Bỏ /product/ hoặc /cua-hang/ hoặc /shop/ ... có hỗ trợ dạng %product_cat%
* Thay /cua-hang/ bằng slug hiện tại của bạn
*/
function devvn_remove_slug( $post_link, $post ) {
    if ( !in_array( get_post_type($post), array( 'product' ) ) || 'publish' != $post->post_status ) {
        return $post_link;
    }
    if('product' == $post->post_type){
        $post_link = str_replace( '/san-pham/', '/', $post_link ); //Thay cua-hang bằng slug hiện tại của bạn
    }else{
        $post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
    }
    return $post_link;
}
add_filter( 'post_type_link', 'devvn_remove_slug', 10, 2 );
/*Sửa lỗi 404 sau khi đã remove slug product hoặc cua-hang*/
function devvn_woo_product_rewrite_rules($flash = false) {
    global $wp_post_types, $wpdb;
    $siteLink = esc_url(home_url('/'));
    foreach ($wp_post_types as $type=>$custom_post) {
        if($type == 'product'){
            if ($custom_post->_builtin == false) {
                $querystr = "SELECT {$wpdb->posts}.post_name, {$wpdb->posts}.ID
                            FROM {$wpdb->posts} 
                            WHERE {$wpdb->posts}.post_status = 'publish' 
                            AND {$wpdb->posts}.post_type = '{$type}'";
                $posts = $wpdb->get_results($querystr, OBJECT);
                foreach ($posts as $post) {
                    $current_slug = get_permalink($post->ID);
                    $base_product = str_replace($siteLink,'',$current_slug);
                    add_rewrite_rule($base_product.'?$', "index.php?{$custom_post->query_var}={$post->post_name}", 'top');                    
                    add_rewrite_rule($base_product.'comment-page-([0-9]{1,})/?$', 'index.php?'.$custom_post->query_var.'='.$post->post_name.'&cpage=$matches[1]', 'top');
                    add_rewrite_rule($base_product.'(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?'.$custom_post->query_var.'='.$post->post_name.'&feed=$matches[1]','top');
                }
            }
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_woo_product_rewrite_rules');
/*Fix lỗi khi tạo sản phẩm mới bị 404*/
function devvn_woo_new_product_post_save($post_id){
    global $wp_post_types;
    $post_type = get_post_type($post_id);
    foreach ($wp_post_types as $type=>$custom_post) {
        if ($custom_post->_builtin == false && $type == $post_type) {
            devvn_woo_product_rewrite_rules(true);
        }
    }
}
add_action('wp_insert_post', 'devvn_woo_new_product_post_save');
/*
 * Author: https://levantoan.com
 * Link https://levantoan.com/xoa-bo-product-category-va-toan-bo-slug-cua-danh-muc-cha-khoi-duong-dan-cua-woocommerce/
 * */
// Remove product cat base
add_filter('term_link', 'devvn_no_term_parents', 1000, 3);
function devvn_no_term_parents($url, $term, $taxonomy) {
    if($taxonomy == 'product_cat'){
        $term_nicename = $term->slug;
        $url = trailingslashit(get_option( 'home' )) . user_trailingslashit( $term_nicename, 'category' );
    }
    return $url;
}
 
// Add our custom product cat rewrite rules
function devvn_no_product_cat_parents_rewrite_rules($flash = false) {
    $terms = get_terms( array(
        'taxonomy' => 'product_cat',
        'post_type' => 'product',
        'hide_empty' => false,
    ));
    if($terms && !is_wp_error($terms)){
        foreach ($terms as $term){
            $term_slug = $term->slug;
            add_rewrite_rule($term_slug.'/?$', 'index.php?product_cat='.$term_slug,'top');
            add_rewrite_rule($term_slug.'/page/([0-9]{1,})/?$', 'index.php?product_cat='.$term_slug.'&paged=$matches[1]','top');
            add_rewrite_rule($term_slug.'/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?product_cat='.$term_slug.'&feed=$matches[1]','top');
        }
    }
    if ($flash == true)
        flush_rewrite_rules(false);
}
add_action('init', 'devvn_no_product_cat_parents_rewrite_rules');

/*
* Remove the default WooCommerce 3 JSON/LD structured data format
*/function remove_output_structured_data() {
remove_action( 'wp_footer', array( WC()->structured_data, 'output_structured_data' ), 10 ); // Frontend pages
remove_action( 'woocommerce_email_order_details', array( WC()->structured_data, 'output_email_structured_data' ), 30 ); // Emails
}
add_action( 'init', 'remove_output_structured_data' );

add_filter('woocommerce_is_purchasable', '__return_TRUE'); 
add_filter('woocommerce_is_in_stock', '__return_TRUE'); 
add_filter('woocommerce_product_backorders_allowed', '__return_TRUE'); 

function custom_add_to_cart_button() {
    global $product;
    if (is_product()) {
        // wc_get_stock_html( $product ); // WPCS: XSS ok.
        $action =  "".esc_url(apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink()));
        do_action( 'woocommerce_before_add_to_cart_form' );
        $html = "<form class='cart' action='{$action}' method='post' enctype='multipart/form-data'>";
        do_action( 'woocommerce_before_add_to_cart_button' );
        do_action( 'woocommerce_before_add_to_cart_quantity' );
        $inputQty =  woocommerce_quantity_input(
            array(
                'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                'max_value'   => 0,
                'input_value' => isset( $_POST['quantity']) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), 
            ), 
            $product,
            false
        );
        $html .= $inputQty;
        do_action( 'woocommerce_after_add_to_cart_quantity' );
        $escAttrId = esc_attr( $product->get_id());
        $escAttrClass = ( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' );
        $escBtnText =  esc_html( $product->single_add_to_cart_text() );
        $html .= "<button type='submit' name='add-to-cart' value='$escAttrId' class='single_add_to_cart_button button alt$escAttrClass'>$escBtnText</button>";
        do_action( 'woocommerce_after_add_to_cart_button' );
        $html .= "</form>";
        return $html;
    } else {
        return "Shortcode only use Product page";
    }
}

add_shortcode('custom_add_to_cart_button', 'custom_add_to_cart_button');

add_action( 'wp_ajax_nopriv_get_category_json', 'get_category_json' );

function get_category_json() {
    get_product_subcategory($_POST['term_id']);
    wp_die();
}

function custom_scroll_product_page() {
    ?>  
        <script type='text/javascript'>
            function onClickSubCategory(targets, id, parentId) {
                var targetElements = document.querySelectorAll(`#${id}`);
                var parentLinks = document.querySelectorAll(`#${parentId} .subcategory-item`);
                targetElements.forEach(function (element) {
                    element.classList.remove('active');
                });

                parentLinks.forEach(function (link) {
                    link.classList.remove('active');
                });
                var term_id =  jQuery(targets).data('term');
                var parent  =  jQuery(targets).data('parent');

                var data = {
                    'action': 'get_category_json',
                    'term_id': term_id
                };
                var ajaxurl =  "<?php echo admin_url('admin-ajax.php'); ?>";
                jQuery('#load-ajax-products').addClass('loading-cat');
                jQuery.post(ajaxurl, data, function(response) {
                    console.log(jQuery('.products'));
                    jQuery('#load-ajax-products').empty();
                    jQuery('#load-ajax-products').html(response);
                    jQuery('.woocommerce-pagination').empty();
                    jQuery('#load-ajax-products').removeClass('loading-cat');
                });
               
                targetElements.forEach(function (element) {
                    element.classList.add('active');
                });
            }

            function clickNavScroll(targets, id, parentId) {
                var targetElements = document.querySelectorAll(`#${id}`);
                var parentLinks = document.querySelectorAll(`#${parentId} a`);
                targetElements.forEach(function (element) {
                    element.classList.remove('active');
                });

                parentLinks.forEach(function (link) {
                    link.classList.remove('active');
                });
                targetElements.forEach(function (element) {
                    element.classList.add('active');
                });
            }

            window.addEventListener('scroll', function() {
                var headerWrapper = document.querySelector('.header-wrapper');
                var stickyTab = document.getElementById("sticky-tab-chucnang-container");
                if (stickyTab) {
                    const scrollPosition = window.scrollY;
                    console.log(window.innerWidth)
                    var tabChucnang = document.getElementById('sticky-tab-chucnang')
                    var rect = stickyTab.getBoundingClientRect();
                    var rectItemTab = tabChucnang.getBoundingClientRect();
                    if (rect.top <= 0 && rect.bottom >= 0 && rect.bottom  > (rectItemTab.height + 120)) {
                        tabChucnang.classList.add('sticky-tab-fixed')
                    }  else {
                        tabChucnang.classList.remove('sticky-tab-fixed')
                    }

                    if (headerWrapper.classList.contains('stuck') && tabChucnang) {
                        tabChucnang.style.top = '100px';
                    } else if (tabChucnang) {
                        tabChucnang.style.top = '0';
                    }


                    var tabDescriptions = document.querySelectorAll('#tab-description h3 span');
                    tabDescriptions.forEach(function(span) {
                        var position = span.getBoundingClientRect();
                        const windowHeight = window.innerHeight;
                        const tabTop = position.top + scrollPosition;
                        var id = span.getAttribute('id');
                        if (id && tabTop <= scrollPosition + (windowHeight / 2)) {
                            
                            var stickyTabLinks = document.querySelectorAll('#sticky-tab .tab-chucnang a');

                            stickyTabLinks.forEach(function(link) {
                                link.classList.remove('active');
                            });

                            var activeLink = document.querySelector('#sticky-tab .tab-chucnang a[id="head-' + id + '"]');

                            if (activeLink) {

                                activeLink.classList.add('active');
                            }
                        }
                       
                    });
                }
            });
        </script>;
    <?php
}

add_action('wp_footer', 'custom_scroll_product_page');

/**
 * Convert Rank Math FAQ Block Into Accordion
 */
function turn_rm_toc_collapsable() {
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var tocItems = document.querySelectorAll("div.wp-block-rank-math-toc-block");
            tocItems && tocItems.forEach(function(tocItem) {
                    tocItem.addEventListener("click", function(event) {
                        if (event.target.tagName.toLowerCase() === "a") {
                            return; // Khi click vào "a", không thực hiện thay đổi
                        }
                        var nav = this.querySelector("nav");
                        if (getComputedStyle(nav).getPropertyValue("display") === "none") {
                            nav.style.display = "block";
                        } else {
                            nav.style.display = "none";
                        }
                    });
                });
            
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'turn_rm_toc_collapsable' );
add_filter('use_block_editor_for_post', '__return_TRUE');

function findRelatedCategories($categories, $term_id) {
    $relatedCategories = array();

    // Tìm danh mục có term_id trùng với term_id được cung cấp
    $targetCategory = null;
    foreach ($categories as $category) {
        if ($category->term_id == $term_id) {
            $targetCategory = $category;
            break;
        }
    }

    if ($targetCategory) {
        $parent_id = $targetCategory->parent;

        // Tìm danh mục cha
        $relatedCategories = array_merge($relatedCategories, findParentCategories($categories, $parent_id));

        // Tìm các danh mục cùng cấp
        $relatedCategories = array_merge($relatedCategories, findSiblingsCategories($categories, $parent_id));

        // Tìm các danh mục con
        $relatedCategories = array_merge($relatedCategories, findChildCategories($categories, $term_id));
    }

    return $relatedCategories;
}

function findSiblingsCategories($categories, $parent_id) {
    $siblingCategories = array();

    foreach ($categories as $category) {
        if ($category->parent == $parent_id && $category->term_id != $parent_id && $category->parent > 0) {
            $siblingCategories[] = $category;
        }
    }

    return $siblingCategories;
}

function findChildCategories($categories, $parent_id) {
    $childCategories = array();

    foreach ($categories as $category) {
        if ($category->parent == $parent_id) {
            $childCategories[] = $category;
            $childCategories = array_merge($childCategories, findChildCategories($categories, $category->term_id));
        }
    }

    return $childCategories;
}

function findParentCategories($categories, $parent_id) {
    $parentCategories = array();

    foreach ($categories as $category) {
        if ($category->term_id == $parent_id) {
            $parent_id = $category->parent;
            $parentCategories = findSiblingsCategories($categories, $category->parent);
        }
    }

    return $parentCategories;
}

function tab_catgoreis($categories = array()) {
    $queried_object = get_queried_object();
    $categories = get_categories(array(
        'taxonomy'     => 'product_cat',
    ));
   
    $categories = findRelatedCategories($categories, $queried_object->term_id);
   
    if ($categories) {
        $html = '<div id="category-tab-container">';
        $html.= '<div class="filter-wrap">';
        $html.="<h4>Lọc theo:</h4>";
        $html .= '<div id="category-tabs" class="list-filter">';

        foreach ( $categories as $category ) {
            $id = "head-$category->term_id";
            $term_id = $category->term_id;
            $parent = $category->parent;
            $stickyContainer = 'category-tabs';
            $urlTabIndex = "#$category->id";
            $active_class = $term_id == $queried_object->term_id ? "active" : "";
            $html .= "<div id='$id' data-term='$term_id' data-parent='$parent'  onclick='onClickSubCategory(this, `$id`, `$stickyContainer`)' class='subcategory-item $active_class'><span>$category->name</span></div>";
        }
        $html.="</div>";
        $html.="</div>";
        $html .= "</div>";
    }
  
    return $html;
}

function get_product_subcategory($termId) {
    $terms =  get_term($termId);

    if ( $terms ) {
        $args = array(
          'post_type' => 'product',
          'product_cat' => $terms->slug, 
          'nopaging' => true,
        );
        $loop = new WP_Query( $args );  
        if ( $loop->have_posts() ) {
            woocommerce_product_loop_start();
            while ( $loop->have_posts() ) : $loop->the_post();
                wc_get_template_part( 'content', 'product' );
            endwhile;
            woocommerce_product_loop_end();
        }  
    }
}

function woocommerce_product_subcategory( $args = array() ) {
    echo tab_catgoreis();
    $queried_object = get_queried_object();
    $nopaging = $queried_object->parent > 0 ? true : false;
    $pageReqest = get_query_var('paged');
    $paged =  $pageReqest > 0 ?  $pageReqest : 1;
    $total = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
    $products_per_page=wc_get_loop_prop("per_page");
    $args = array(
        'parent' => $queried_object->term_id,
        'post_type' => 'product',
        'product_cat' => $queried_object->slug, 
        'nopaging' =>  $nopaging,
        'paged' => $paged,
        'posts_per_page' => $products_per_page
        // 'orderby' => 'pa_featured_product', // Sắp xếp theo giá trị của trường tùy chỉnh
        // 'meta_key' => '_product_attributes', // Tên trường tùy chỉnh để xác định sản phẩm nổi bật
        // 'order' => 'ASC', // Sắp xếp giảm dần
    );
 
    $loop = new WP_Query( $args );

    echo "<div id='load-ajax-products' class=''>";  
    if ( $loop->have_posts() ) {
        woocommerce_product_loop_start();
        while ( $loop->have_posts() ) : $loop->the_post();
            wc_get_template_part( 'content', 'product' );
        endwhile;
        woocommerce_product_loop_end();
    } 
    echo "</div>";
}

add_shortcode('products_of_subcategory', 'woocommerce_product_subcategory');

function woo_breadcrums () {
    echo '<div class="shop-page-title category-page-title page-title ">';
    echo '<div class="page-title-inner flex-row  medium-flex-wrap container">';
    echo '<div class="flex-col flex-grow medium-text-center">';
    echo '<div class="is-medium">';
    echo woocommerce_breadcrumb(); 
    echo '</div>';
    echo '<div class="flex-col medium-text-center">';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
add_shortcode('woo_breadcrums', 'woo_breadcrums');


function custom_left_menu_blog_category() {
    echo '<span class="widget-title "><span>Chuyên mục</span></span>';
    echo '<div class="is-divider small"></div>';
    echo "<ul id='menu-danh-muc' class='menu active'>";
    $categories = get_categories(array(
       'taxonomy'  => 'category',
       'parent' => 0
    ));

    foreach ($categories as $category) {
        $category_link = get_category_link($category->term_id);
        echo "<li class='menu-item active'>";
        echo    "<a rel='nofollow' href='$category_link'>$category->name</a>";
            $child_categories = get_terms(array(
                'taxonomy' => 'category',
                'parent' => $category->term_id, // Lấy các danh mục con của danh mục cha hiện tại.
                'hide_empty' => false,
            ));
            if (!empty($child_categories)) {    
                echo    "<ul class='sub-menu'>";            
                    foreach ($child_categories as $child_category) {
                        if ($child_category->slug =='tin-tuc-chuyen-nghanh') {
                            $nofollow = 'dofollow';
                        } else {
                            $nofollw = 'nofollow';
                        }
                        echo '<li class="menu-item" ><a rel="'.$nofollow.'" href="' . get_term_link($child_category) . '">' . $child_category->name . '</a></li>';
                    }
                echo "</ul>";
            }
        echo "</li>";
    }
    echo "</ul>";
}

add_shortcode('left_menu_blog_category', 'custom_left_menu_blog_category');


function custom_left_menu_product_category($atts = array()) {
    $args = shortcode_atts(array(
        'list' => '',
    ), $atts);

    // Kiểm tra xem 'list' có được truyền vào không
    if (empty($args['list'])) {
        return 'Danh sách trống.';
    }
      // Chuyển đổi chuỗi danh sách thành mảng
    $list_array = explode(',', $args['list']);

    echo '<span class="widget-title "><span>Danh mục sản phẩm</span></span>';
    echo '<div class="is-divider small"></div>';
    echo "<ul id='menu-danh-muc' class='menu'>";
    // Danh sách các danh mục cha bạn muốn lấy

    $selected_parent_categories =  $list_array;

    foreach ($selected_parent_categories as $slug) {
        $category = get_term_by( 'slug', $slug, 'product_cat' );
        if ($category) {
            $category_link = get_category_link($category->term_id);
            echo "<li slug='$category->slug' class='menu-item'>";
            echo    "<a rel='nofollow' href='$category_link'>$category->name</a>";
          
                        $child_categories = get_terms(array(
                            'taxonomy' => 'product_cat',
                            'parent' => $category->term_id, // Lấy các danh mục con của danh mục cha hiện tại.
                            'hide_empty' => false,
                        ));
                        if (!empty($child_categories)) {    
                            echo    "<ul class='sub-menu'>";            
                                foreach ($child_categories as $child_category) {
                                    echo '<li slug="$child_category->slug" class="menu-item" ><a rel="nofollow" href="' . get_term_link($child_category) . '">' . $child_category->name . '</a></li>';
                                }
                            echo "</ul>";
                        }
                 
            echo "</li>";
        }
    }
    echo "</ul>";
}

add_shortcode('left_menu_product_category', 'custom_left_menu_product_category');


function cta_button () {
   echo '<div class="zalo-chat-widget" data-oaid="2153511105125714794" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="" data-height="" data-right="10"></div>';
}
add_action('wp_footer', 'cta_button' );

function enqueue_custom_scripts() {
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/zalo_chat_widget.js');
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


function custom_left_menu_archive_list( $args = array() ) {
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3
    );
 
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) {
        echo '<div id="post-left-list">';
        echo '<h1 class="blog-header-wrapper"><span>' . get_theme_mod( 'blog_header' ) . '</span></h1>';
         while ( $loop->have_posts() ) : $loop->the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="article-inner <?php flatsome_blog_article_classes(); ?>">

                <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
                <div class="entry-image-float">
                    <?php get_template_part( 'template-parts/posts/partials/entry-image', 'default'); ?>
                </div>
                <?php } ?>
                <div class="entry-content">
                
                    <div class="entry-summary">
                        <header class="entry-header">
                            <div class="entry-header-text text-<?php echo get_theme_mod( 'blog_posts_title_align', 'center' );?>">
                                 <?php echo '<h2 class="entry-title"><a href="' . get_the_permalink() . '" rel="nofollowo" class="plain">' . get_the_title() . '</a></h2>';?>
                            </div>

                        </header>
                    </div>
                </div>
    
            </div>
        </article>

        <?php endwhile; 
        echo '</div>';
    } 
}

add_shortcode('left_menu_archive_list', 'custom_left_menu_archive_list');


