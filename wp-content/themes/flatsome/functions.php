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
 
