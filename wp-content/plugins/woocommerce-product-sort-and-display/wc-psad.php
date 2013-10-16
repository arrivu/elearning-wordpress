<?php
/*
Plugin Name: WooCommerce Product Sort and Display LITE
Description: Take control of your WooCommerce Shop random product display with WooCommerce Show Products by Category. Sort and show products on Shop page by category with 'On Sale' or 'Featured' products showing first. Products showing and total products per category count for intelligent viewing.
Version: 1.0.0
Author: A3 Revolution
Author URI: http://www.a3rev.com/
License: This software is under commercial license and copyright to A3 Revolution Software Development team

	WooCommerce Show Products By Categories. Plugin for the WooCommerce shopping Cart.
	Copyright© 2011 A3 Revolution Software Development team
	
	A3 Revolution Software Development team
	admin@a3rev.com
	PO Box 1170
	Gympie 4570
	QLD Australia
*/
?>
<?php
define('WC_PSAD_FILE_PATH', dirname(__FILE__));
define('WC_PSAD_DIR_NAME', basename(WC_PSAD_FILE_PATH));
define('WC_PSAD_FOLDER', dirname(plugin_basename(__FILE__)));
define('WC_PSAD_URL', WP_CONTENT_URL.'/plugins/'.WC_PSAD_FOLDER);
define('WC_PSAD_DIR', WP_CONTENT_DIR.'/plugins/'.WC_PSAD_FOLDER);
define('WC_PSAD_NAME', plugin_basename(__FILE__) );
define('WC_PSAD_TEMPLATE_PATH', WC_PSAD_FILE_PATH . '/templates' );
define('WC_PSAD_IMAGES_URL',  WC_PSAD_URL . '/assets/images' );
define('WC_PSAD_JS_URL',  WC_PSAD_URL . '/assets/js' );
define('WC_PSAD_CSS_URL',  WC_PSAD_URL . '/assets/css' );
define('WC_PSAD_WP_TESTED', '3.5.2' );
if(!defined("WC_PSAD_AUTHOR_URI"))
    define("WC_PSAD_AUTHOR_URI", "http://a3rev.com/shop/woocommerce-product-sort-and-display/");

include 'classes/class-wc-psad.php';
include 'admin/classes/class-wc-psad-admin.php';
include 'classes/class-wc-psad-functions.php';
include 'classes/class-wc-psad-admin-hook.php';

include 'admin/wc-psad-init.php';

/**
* Call when the plugin is activated and deactivated
*/
register_activation_hook(__FILE__,'wc_psad_install');

function wc_psad_uninstall() {
	if ( get_option('psad_clean_on_deletion') == 1 ) {
		delete_option( 'psad_shop_page_enable' );
		delete_option( 'psad_category_page_enable' );
		delete_option( 'psad_tag_page_enable' );
		delete_option( 'psad_shop_enable_product_showing_count' );
		delete_option( 'psad_cat_enable_product_showing_count' );
		delete_option( 'psad_shop_category_per_page' );
		delete_option( 'psad_category_per_page' );
		delete_option( 'psad_shop_product_per_page' );
		delete_option( 'psad_product_per_page' );
		delete_option( 'psad_category_product_nosub_per_page' );
		delete_option( 'psad_tag_product_per_page' );
		delete_option( 'psad_top_product_per_page' );
		delete_option( 'psad_shop_product_show_type' );
		delete_option( 'psad_product_show_type' );
		delete_option( 'psad_tag_product_show_type' );
		delete_option( 'psad_seperator_enable' );
		delete_option( 'psad_seperator_border_width' );
		delete_option( 'psad_seperator_border_style' );
		delete_option( 'psad_seperator_border_color' );
		delete_option( 'psad_seperator_padding_tb' );
		delete_option( 'psad_endless_scroll_category_shop' );
		delete_option( 'psad_endless_scroll_category_shop_tyle' );
		delete_option( 'psad_endless_scroll_category' );
		delete_option( 'psad_endless_scroll_category_tyle' );
		delete_option( 'psad_endless_scroll_tag' );
		delete_option( 'psad_endless_scroll_tag_tyle' );
		
		// Delete Endless Scroll Style Shop Page
		delete_option( 'psad_es_shop_bt_type' );
		delete_option( 'psad_es_shop_bt_align' );
		delete_option( 'psad_es_shop_bt_text' );
		delete_option( 'psad_es_shop_bt_bg' );
		delete_option( 'psad_es_shop_bt_bg_from' );
		delete_option( 'psad_es_shop_bt_bg_to' );
		delete_option( 'psad_es_shop_bt_border_width' );
		delete_option( 'psad_es_shop_bt_border_style' );
		delete_option( 'psad_es_shop_bt_border_color' );
		delete_option( 'psad_es_shop_bt_rounded' );
		delete_option( 'psad_es_shop_bt_font_family' );
		delete_option( 'psad_es_shop_bt_font_size' );
		delete_option( 'psad_es_shop_bt_font_style' );
		delete_option( 'psad_es_shop_bt_font_color' );
		delete_option( 'psad_es_shop_bt_class' );
		delete_option( 'psad_es_shop_link_align' );
		delete_option( 'psad_es_shop_link_text' );
		delete_option( 'psad_es_shop_link_font_family' );
		delete_option( 'psad_es_shop_link_font_size' );
		delete_option( 'psad_es_shop_link_font_style' );
		delete_option( 'psad_es_shop_link_font_color' );
		delete_option( 'psad_es_shop_link_font_hover_color' );
		
		// Delete Endless Scroll Style Category Page
		delete_option( 'psad_es_category_bt_type' );
		delete_option( 'psad_es_category_bt_align' );
		delete_option( 'psad_es_category_bt_text' );
		delete_option( 'psad_es_category_bt_bg' );
		delete_option( 'psad_es_category_bt_bg_from' );
		delete_option( 'psad_es_category_bt_bg_to' );
		delete_option( 'psad_es_category_bt_border_width' );
		delete_option( 'psad_es_category_bt_border_style' );
		delete_option( 'psad_es_category_bt_border_color' );
		delete_option( 'psad_es_category_bt_rounded' );
		delete_option( 'psad_es_category_bt_font_family' );
		delete_option( 'psad_es_category_bt_font_size' );
		delete_option( 'psad_es_category_bt_font_style' );
		delete_option( 'psad_es_category_bt_font_color' );
		delete_option( 'psad_es_category_bt_class' );
		delete_option( 'psad_es_category_link_align' );
		delete_option( 'psad_es_category_link_text' );
		delete_option( 'psad_es_category_link_font_family' );
		delete_option( 'psad_es_category_link_font_size' );
		delete_option( 'psad_es_category_link_font_style' );
		delete_option( 'psad_es_category_link_font_color' );
		delete_option( 'psad_es_category_link_font_hover_color' );
		
		// Delete View All Products Style
		delete_option( 'psad_es_category_item_bt_type' );
		delete_option( 'psad_es_category_item_bt_position' );
		delete_option( 'psad_es_category_item_bt_align' );
		delete_option( 'psad_es_category_item_bt_text' );
		delete_option( 'psad_es_category_item_bt_bg' );
		delete_option( 'psad_es_category_item_bt_bg_from' );
		delete_option( 'psad_es_category_item_bt_bg_to' );
		delete_option( 'psad_es_category_item_bt_border_width' );
		delete_option( 'psad_es_category_item_bt_border_style' );
		delete_option( 'psad_es_category_item_bt_border_color' );
		delete_option( 'psad_es_category_item_bt_rounded' );
		delete_option( 'psad_es_category_item_bt_font_family' );
		delete_option( 'psad_es_category_item_bt_font_size' );
		delete_option( 'psad_es_category_item_bt_font_style' );
		delete_option( 'psad_es_category_item_bt_font_color' );
		delete_option( 'psad_es_category_item_bt_class' );
		delete_option( 'psad_es_category_item_link_align' );
		delete_option( 'psad_es_category_item_link_text' );
		delete_option( 'psad_es_category_item_link_font_family' );
		delete_option( 'psad_es_category_item_link_font_size' );
		delete_option( 'psad_es_category_item_link_font_style' );
		delete_option( 'psad_es_category_item_link_font_color' );
		delete_option( 'psad_es_category_item_link_font_hover_color' );
		
		// Delete Endless Scroll Style for Products
		delete_option( 'psad_es_products_bt_type' );
		delete_option( 'psad_es_products_bt_align' );
		delete_option( 'psad_es_products_bt_text' );
		delete_option( 'psad_es_tag_products_bt_text' );
		delete_option( 'psad_es_products_bt_bg' );
		delete_option( 'psad_es_products_bt_bg_from' );
		delete_option( 'psad_es_products_bt_bg_to' );
		delete_option( 'psad_es_products_bt_border_width' );
		delete_option( 'psad_es_products_bt_border_style' );
		delete_option( 'psad_es_products_bt_border_color' );
		delete_option( 'psad_es_products_bt_rounded' );
		delete_option( 'psad_es_products_bt_font_family' );
		delete_option( 'psad_es_products_bt_font_size' );
		delete_option( 'psad_es_products_bt_font_style' );
		delete_option( 'psad_es_products_bt_font_color' );
		delete_option( 'psad_es_products_bt_class' );
		delete_option( 'psad_es_products_link_align' );
		delete_option( 'psad_es_products_link_text' );
		delete_option( 'psad_es_tag_products_link_text' );
		delete_option( 'psad_es_products_link_font_family' );
		delete_option( 'psad_es_products_link_font_size' );
		delete_option( 'psad_es_products_link_font_style' );
		delete_option( 'psad_es_products_link_font_color' );
		delete_option( 'psad_es_products_link_font_hover_color' );
		
		// Delete Count Meta Styling
		delete_option( 'psad_count_meta_font_family' );
		delete_option( 'psad_count_meta_font_size' );
		delete_option( 'psad_count_meta_font_style' );
		delete_option( 'psad_count_meta_font_color' );
		
		delete_post_meta_by_key( '_psad_onsale_order' );
		delete_post_meta_by_key( '_psad_featured_order' );
		
		delete_option( 'psad_clean_on_deletion' );
		
		$metadata = array('psad_category_per_page','psad_top_product_per_page', 'psad_shop_product_per_page', 'psad_product_per_page', 'psad_shop_product_show_type', 'psad_product_show_type', 'psad_category_product_nosub_per_page');
		foreach ( $metadata as $meta_key ) {
			delete_metadata( 'woocommerce_term', '', $meta_key, '', true );
		}
	}
}
if ( get_option('psad_clean_on_deletion') == 1 ) {
	register_uninstall_hook( __FILE__, 'wc_psad_uninstall' );
}
?>
