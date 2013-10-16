<?php
/**
 * WC_PSAD Functions
 *
 * Table Of Contents
 *
 * auto_create_order_keys_all_products()
 * update_orders_value()
 */
class WC_PSAD_Functions 
{	
	public static function auto_create_order_keys_all_products() {
		global $wpdb;
		
		// Get all Products
		$all_products = $wpdb->get_results( " SELECT ID FROM ".$wpdb->posts." WHERE post_status='publish' AND post_type='product' " );	
		
		// Create sort keys
		if ( $all_products && count( $all_products ) > 0 ) {
			foreach ( $all_products as $a_product ) {
				$product = get_product( $a_product->ID );
				if ( $product ) {
					if ( $product->is_on_sale() ) {
						update_post_meta( $a_product->ID, '_psad_onsale_order', 2 );
					} else {
						update_post_meta( $a_product->ID, '_psad_onsale_order', 1 );
					}
					if ( $product->is_featured() ) {
						update_post_meta( $a_product->ID, '_psad_featured_order', 2 );
					} else {
						update_post_meta( $a_product->ID, '_psad_featured_order', 1 );	
					}
				}
			}
		}
	}
	
	public static function update_orders_value( $post_id, $post ) {
		if ( is_int( wp_is_post_revision( $post_id ) ) ) return;
		if ( is_int( wp_is_post_autosave( $post_id ) ) ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
		if ( ! current_user_can( 'edit_post', $post_id ) ) return $post_id;
		if ( $post->post_type != 'product' ) return $post_id;
		
		$product = get_product( $post );
		if ( $product->is_on_sale() ) {
			update_post_meta( $post_id, '_psad_onsale_order', 2 );
		} else {
			update_post_meta( $post_id, '_psad_onsale_order', 1 );
		}
		if ( $product->is_featured() ) {
			update_post_meta( $post_id, '_psad_featured_order', 2 );
		} else {
			update_post_meta( $post_id, '_psad_featured_order', 1 );	
		}
	}
}
?>