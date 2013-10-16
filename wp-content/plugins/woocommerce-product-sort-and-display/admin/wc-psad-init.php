<?php
/**
 * Register Activation Hook
 */
update_option('wc_psad_plugin', 'wc_psad');
function wc_psad_install(){
	global $wpdb;
	//global $wp_rewrite;
	WC_PSAD_Settings::set_setting();
	WC_PSAD_Functions::auto_create_order_keys_all_products();
	update_option('wc_psad_version', '1.0.0');
	update_option('wc_psad_plugin', 'wc_psad');
	delete_transient("wc_psad_update_info");
	//$wp_rewrite->flush_rules();
	update_option('wc_psad_just_installed', true);
}

function psad_init() {
	if ( get_option('wc_psad_just_installed') ) {
		delete_option('wc_psad_just_installed');
		wp_redirect( admin_url( 'admin.php?page=woocommerce_settings&tab=psad_settings', 'relative' ) );
		exit;
	}
	load_plugin_textdomain( 'wc_psad', false, WC_PSAD_FOLDER.'/languages' );
}

// Add language
add_action('init', 'psad_init');

// Add text on right of Visit the plugin on Plugin manager page
add_filter( 'plugin_row_meta', array('WC_PSAD_Settings_Hook', 'plugin_extra_links'), 10, 2 );

update_option('wc_psad_version', '1.0.0');

global $wc_psad;
$wc_psad = new WC_PSAD_Settings();
$wc_psad_setting_hook = new WC_PSAD_Settings_Hook();

// Update Onsale order and Featured order value
add_action( 'save_post', array( 'WC_PSAD_Functions', 'update_orders_value' ), 101, 2 );

?>