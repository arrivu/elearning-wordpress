<?php
/**
 * WC_PSAD_Settings Class
 *
 * Class Function into WooCommerce plugin
 *
 * Table Of Contents
 *
 * set_setting()
 * __construct()
 * on_add_tab()
 * psad_shop_category_end()
 * psad_endless_scroll_end()
 * settings_tab_action()
 * add_settings_fields()
 * get_tab_in_view()
 * init_form_fields()
 * get_font_size()
 * get_border()
 * get_font()
 * save_settings()
 * setting()
 * add_scripts()
 */
class WC_PSAD_Settings
{
	public function set_setting($reset=false){
		if ( get_option('psad_shop_page_enable') == '' || $reset ) {
			update_option('psad_shop_page_enable','yes');
		}
		if ( get_option('psad_shop_enable_product_showing_count') == '' || $reset ) {
			update_option('psad_shop_enable_product_showing_count','yes');
		}
		if ( get_option('psad_shop_category_per_page') <= 0 || $reset ) {
			update_option('psad_shop_category_per_page','3');
		}
		if ( get_option('psad_shop_product_per_page') <= 0 || $reset ) {
			update_option('psad_shop_product_per_page','3');
		}
		if ( get_option('psad_seperator_enable') == '' || $reset ) {
			update_option('psad_seperator_enable','yes');
		}
		if ( get_option('psad_seperator_border_width') <= 0 || $reset ) {
			update_option('psad_seperator_border_width','0');
		}
		if ( get_option('psad_seperator_border_style') == '' || $reset ) {
			update_option('psad_seperator_border_style','solid');
		}
		if ( get_option('psad_seperator_border_color') == '' || $reset ) {
			update_option('psad_seperator_border_color','#000000');
		}
		if ( get_option('psad_seperator_padding_tb') <= 0 || $reset ) {
			update_option('psad_seperator_padding_tb','5');
		}
		
		if ( get_option('psad_endless_scroll_category_shop') == '' || $reset ) {
			update_option('psad_endless_scroll_category_shop','yes');
		}
		if ( get_option('psad_endless_scroll_category_shop_tyle') == '' || $reset ) {
			update_option('psad_endless_scroll_category_shop_tyle','click');
		}
		
		// Endless Style for Shop Page
		if ( get_option('psad_es_shop_bt_type', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_type','link');
		}
		if ( get_option('psad_es_shop_bt_align', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_align','center');
		}
		if ( get_option('psad_es_shop_bt_text', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_text', __( 'Click More Categories', 'wc_psad' ) );
		}
		if ( get_option('psad_es_shop_bt_bg', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_bg', '#7497B9' );
		}
		if ( get_option('psad_es_shop_bt_bg_from', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_bg_from', '#7497B9' );
		}
		if ( get_option('psad_es_shop_bt_bg_to', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_bg_to', '#4b6E90' );
		}
		if ( get_option('psad_es_shop_bt_border_width', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_border_width', '1' );
		}
		if ( get_option('psad_es_shop_bt_border_style', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_border_style', 'solid' );
		}
		if ( get_option('psad_es_shop_bt_border_color', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_border_color', '#7497B9' );
		}
		if ( get_option('psad_es_shop_bt_rounded', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_rounded', '3' );
		}
		if ( get_option('psad_es_shop_bt_font_family', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_font_family', 'Arial, sans-serif' );
		}
		if ( get_option('psad_es_shop_bt_font_size', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_font_size', '12' );
		}
		if ( get_option('psad_es_shop_bt_font_style', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_font_style', 'bold' );
		}
		if ( get_option('psad_es_shop_bt_font_color', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_font_color', '#FFFFFF' );
		}
		if ( get_option('psad_es_shop_bt_class', '') == '' || $reset ) {
			update_option('psad_es_shop_bt_class', '' );
		}
		
		if ( get_option('psad_es_shop_link_align', '') == '' || $reset ) {
			update_option('psad_es_shop_link_align','center');
		}
		if ( get_option('psad_es_shop_link_text', '') == '' || $reset ) {
			update_option('psad_es_shop_link_text', __( 'Click More Categories', 'wc_psad' ) );
		}
		if ( get_option('psad_es_shop_link_font_family', '') == '' || $reset ) {
			update_option('psad_es_shop_link_font_family', 'Arial, sans-serif' );
		}
		if ( get_option('psad_es_shop_link_font_size', '') == '' || $reset ) {
			update_option('psad_es_shop_link_font_size', '12' );
		}
		if ( get_option('psad_es_shop_link_font_style', '') == '' || $reset ) {
			update_option('psad_es_shop_link_font_style', 'bold' );
		}
		if ( get_option('psad_es_shop_link_font_color', '') == '' || $reset ) {
			update_option('psad_es_shop_link_font_color', '#7497B9' );
		}
		if ( get_option('psad_es_shop_link_font_hover_color', '') == '' || $reset ) {
			update_option('psad_es_shop_link_font_hover_color', '#4b6E90' );
		}
		
		// View All Products Styling
		if ( get_option('psad_es_category_item_bt_type') == '' || $reset ) {
			update_option('psad_es_category_item_bt_type','link');
		}
		if ( get_option('psad_es_category_item_bt_position') == '' || $reset ) {
			update_option('psad_es_category_item_bt_position','bottom');
		}
		if ( get_option('psad_es_category_item_bt_align') == '' || $reset ) {
			update_option('psad_es_category_item_bt_align','center');
		}
		if ( get_option('psad_es_category_item_bt_text', '') == '' || $reset ) {
			update_option('psad_es_category_item_bt_text', __( 'See more...', 'wc_psad' ) );
		}
		if ( get_option('psad_es_category_item_bt_bg', '') == '' || $reset ) {
			update_option('psad_es_category_item_bt_bg', '#7497B9' );
		}
		if ( get_option('psad_es_category_item_bt_bg_from', '') == '' || $reset ) {
			update_option('psad_es_category_item_bt_bg_from', '#7497B9' );
		}
		if ( get_option('psad_es_category_item_bt_bg_to', '') == '' || $reset ) {
			update_option('psad_es_category_item_bt_bg_to', '#4b6E90' );
		}
		if ( get_option('psad_es_category_item_bt_border_width', '') == '' || $reset ) {
			update_option('psad_es_category_item_bt_border_width', '1' );
		}
		if ( get_option('psad_es_category_item_bt_border_style', '') == '' || $reset ) {
			update_option('psad_es_category_item_bt_border_style', 'solid' );
		}
		if ( get_option('psad_es_category_item_bt_border_color', '') == '' || $reset ) {
			update_option('psad_es_category_item_bt_border_color', '#7497B9' );
		}
		if ( get_option('psad_es_category_item_bt_rounded', '') == '' || $reset ) {
			update_option('psad_es_category_item_bt_rounded', '3' );
		}
		if ( get_option('psad_es_category_item_bt_font_family', '') == '' || $reset ) {
			update_option('psad_es_category_item_bt_font_family', 'Arial, sans-serif' );
		}
		if ( get_option('psad_es_category_item_bt_font_size', '') == '' || $reset ) {
			update_option('psad_es_category_item_bt_font_size', '12' );
		}
		if ( get_option('psad_es_category_item_bt_font_style', '') == '' || $reset ) {
			update_option('psad_es_category_item_bt_font_style', 'bold' );
		}
		if ( get_option('psad_es_category_item_bt_font_color', '') == '' || $reset ) {
			update_option('psad_es_category_item_bt_font_color', '#FFFFFF' );
		}
		
		if ( get_option('psad_es_category_item_link_align', '') == '' || $reset ) {
			update_option('psad_es_category_item_link_align','center');
		}
		if ( get_option('psad_es_category_item_link_text', '') == '' || $reset ) {
			update_option('psad_es_category_item_link_text', __( 'See more...', 'wc_psad' ) );
		}
		if ( get_option('psad_es_category_item_link_font_family', '') == '' || $reset ) {
			update_option('psad_es_category_item_link_font_family', 'Arial, sans-serif' );
		}
		if ( get_option('psad_es_category_item_link_font_size', '') == '' || $reset ) {
			update_option('psad_es_category_item_link_font_size', '12' );
		}
		if ( get_option('psad_es_category_item_link_font_style', '') == '' || $reset ) {
			update_option('psad_es_category_item_link_font_style', 'bold' );
		}
		if ( get_option('psad_es_category_item_link_font_color', '') == '' || $reset ) {
			update_option('psad_es_category_link_font_color', '#7497B9' );
		}
		if ( get_option('psad_es_category_link_font_hover_color', '') == '' || $reset ) {
			update_option('psad_es_category_link_font_hover_color', '#4b6E90' );
		}
		
		// Count Meta Styling
		if ( get_option('psad_count_meta_font_family', '') == '' || $reset ) {
			update_option('psad_count_meta_font_family', 'Arial, sans-serif' );
		}
		if ( get_option('psad_count_meta_font_size', '') == '' || $reset ) {
			update_option('psad_count_meta_font_size', '11' );
		}
		if ( get_option('psad_count_meta_font_style', '') == '' || $reset ) {
			update_option('psad_count_meta_font_style', 'italic' );
		}
		if ( get_option('psad_count_meta_font_color', '') == '' || $reset ) {
			update_option('psad_count_meta_font_color', '#000000' );
		}
	}
		
	public function __construct() {
   		$this->current_tab = ( isset($_GET['tab']) ) ? $_GET['tab'] : 'general';
    	$this->settings_tabs = array(
        	'psad_settings' => __('Sort & Display', 'wc_psad')
        );
        add_action('woocommerce_settings_tabs', array(&$this, 'on_add_tab'), 10);
		
        // Run these actions when generating the settings tabs.
        foreach ( $this->settings_tabs as $name => $label ) {
        	add_action('woocommerce_settings_tabs_' . $name, array(&$this, 'settings_tab_action'), 10);
			if (get_option('a3rev_wc_psad_just_confirm') == 1) {
          		update_option('a3rev_wc_psad_just_confirm', 0);
			} else {
				add_action('woocommerce_update_options_' . $name, array(&$this, 'save_settings'), 10);
			}
        }
		
		//add_action( 'woocommerce_settings_psad_shop_global_settings_end_after', array(&$this, 'psad_shop_global_settings_end') );
		add_action( 'woocommerce_settings_psad_endless_scroll_category_shop_end_after', array(&$this, 'psad_endless_scroll_category_shop_end') );
		add_action( 'woocommerce_settings_psad_count_meta_styling_end_after', array(&$this, 'psad_count_meta_styling_end') );
		add_action( 'woocommerce_settings_psad_tag_page_settings_end_after', array(&$this, 'psad_tag_page_settings_end') );
		
		add_action( 'woocommerce_settings_psad_global_settings_end_after', array(&$this, 'psad_global_settings_end') );
		add_action( 'woocommerce_settings_psad_shop_category_end_after', array(&$this, 'psad_shop_category_end') );
		add_action( 'woocommerce_settings_psad_endless_scroll_end_after', array(&$this, 'psad_endless_scroll_end') );
		add_action( 'woocommerce_settings_psad_shop_page_scroll_end_after', array(&$this, 'psad_shop_page_scroll_end') );
		add_action( 'woocommerce_settings_psad_es_category_scroll_end_after', array(&$this, 'psad_es_category_scroll_end') );
		add_action( 'woocommerce_settings_psad_es_category_item_end_after', array(&$this, 'psad_es_category_item_end') );
		add_action( 'woocommerce_settings_wcpsad_endless_scroll_product_style_end_after', array(&$this, 'wcpsad_endless_scroll_product_style_end') );
		add_action( 'woocommerce_settings_psad_seperator_settings_end_after', array(&$this, 'psad_seperator_settings_end') );
		add_action( 'woocommerce_settings_psad_count_meta_text_start', array(&$this, 'psad_count_meta_text_start') );
		add_action( 'woocommerce_settings_psad_tag_count_meta_text_start', array(&$this, 'psad_tag_count_meta_text_start') );
		add_action( 'woocommerce_settings_psad_count_meta_styling_start', array(&$this, 'psad_count_meta_styling_start') );
		
        // Add the settings fields to each tab.
        add_action('woocommerce_psad_settings', array(&$this, 'add_settings_fields'), 10);
				
	}

    /*
    * Admin Functions
    */

    /* ----------------------------------------------------------------------------------- */
    /* Admin Tabs */
    /* ----------------------------------------------------------------------------------- */
	public function on_add_tab() {
    	foreach ( $this->settings_tabs as $name => $label ) :
        	$class = 'nav-tab';
      		if ( $this->current_tab == $name )
            	$class .= ' nav-tab-active';
      		echo '<a href="' . admin_url('admin.php?page=woocommerce_settings&tab=' . $name) . '" class="' . $class . '">' . $label . '</a>';
     	endforeach;
	}
	
	public function psad_shop_global_settings_end() {
    	echo '<div class="pro_feature_fields">';
	}
	
	public function psad_global_settings_end() {
	?>
    	<h3><?php _e('Global Category Reset', 'wc_psad');?> :</h3>		
        <table class="form-table">
            <tr valign="top" class="">
				<th class="titledesc" scope="row"><label for="psad_global_category_reset"><?php _e('Product Category Reset', 'wc_psad');?></label></th>
				<td class="forminp">
						<label><input type="checkbox" value="1" id="psad_global_category_reset" name="psad_global_category_reset" />
						<?php _e("Check this box and Save Changes to reset all custom settings made in the 'a3rev Category Page' settings on Product Categories.", 'wc_psad');?></label> <br>
				</td>
			</tr>
		</table>
    <?php
	}
	
	public function psad_tag_page_settings_end() {
		echo '</div>';
	}
	
	public function psad_shop_category_end() {
	?>
    	<h3><?php _e('House Keeping', 'wc_psad');?> :</h3>		
        <table class="form-table">
            <tr valign="top" class="">
				<th class="titledesc" scope="row"><label for="psad_clean_on_deletion"><?php _e('Clean up on Deletion', 'wc_psad');?></label></th>
				<td class="forminp">
						<label><input <?php checked( get_option('psad_clean_on_deletion'), 1); ?> type="checkbox" value="1" id="psad_clean_on_deletion" name="psad_clean_on_deletion" />
						<?php _e('Check this box and if you ever delete this plugin it will completely remove all tables and data it created, leaving no trace it was ever here.', 'wc_psad');?></label> <br>
				</td>
			</tr>
		</table>
    <?php
		echo '</div><div class="section" id="endless-scroll">';	
	}
	
	public function psad_endless_scroll_category_shop_end() {
		echo '<div class="pro_feature_fields">';
	}
	
	public function psad_endless_scroll_end() {
		echo '</div></div><div class="section" id="shop-page-scroll">';	
	}
	
	public function psad_shop_page_scroll_end() {
		echo '</div><div class="section" id="cat-pages-scroll"><div class="pro_feature_fields">';	
	}
	
	public function psad_es_category_scroll_end() {
		echo '</div></div><div class="section" id="view-all-products">';	
	}
	
	public function psad_es_category_item_end() {
		echo '</div><div class="section" id="parent-cat-product-scroll"><div class="pro_feature_fields">';
	}
	
	public function wcpsad_endless_scroll_product_style_end() {
		echo '</div></div><div class="section" id="visual-separator">';	
	}
	
	public function psad_seperator_settings_end() {
		echo '</div><div class="section" id="count-meta"><div class="pro_feature_fields">';
	}
	
	public function psad_count_meta_text_start() {
	?>
    		<tr valign="top" class="">
				<th class="titledesc" scope="row"><label for="psad_count_meta_text1"><?php _e('Count Meta Text', 'wc_psad');?></label></th>
				<td class="forminp">
					<input disabled="disabled" type="text" value="<?php _e('Currently viewing', 'wc_psad'); ?>" id="psad_count_meta_text1" name="psad_count_meta_text1" style="width:120px" /> %d - %d <input disabled="disabled" type="text" value="<?php _e('of', 'wc_psad'); ?>" name="psad_count_meta_text2" style="width:40px" /> %d <input disabled="disabled" type="text" value="<?php _e('products in this Category', 'wc_psad'); ?>" name="psad_count_meta_text3" style="width:160px" />
				</td>
			</tr>
    <?php
	}
	
	public function psad_tag_count_meta_text_start() {
	?>
    		<tr valign="top" class="">
				<th class="titledesc" scope="row"><label for="psad_tag_count_meta_text1"><?php _e('Count Meta Text', 'wc_psad');?></label></th>
				<td class="forminp">
					<input disabled="disabled" type="text" value="<?php echo _e('Currently viewing', 'wc_psad'); ?>" id="psad_tag_count_meta_text1" name="psad_tag_count_meta_text1" style="width:120px" /> %d - %d <input disabled="disabled" type="text" value="<?php _e('of', 'wc_psad'); ?>" name="psad_tag_count_meta_text2" style="width:40px" /> %d <input disabled="disabled" type="text" value="<?php _e('products in this Tag', 'wc_psad'); ?>" name="psad_tag_count_meta_text3" style="width:160px" />
				</td>
			</tr>
    <?php
	}
	
	public function psad_count_meta_styling_start() {
	?>
    		<tr valign="top" class="">
				<th class="titledesc" scope="row"><label for="psad_count_meta_padding_top"><?php _e('Padding', 'wc_psad');?></label></th>
				<td class="forminp">
					<label><span style="width:56px; display:inline-block"><?php _e('Top', 'wc_psad');?></span> <input disabled="disabled" type="text" value="10" id="psad_count_meta_padding_top" name="psad_count_meta_padding_top" style="width:60px" />px</label><br />
                    <label><span style="width:56px; display:inline-block"><?php _e('Bottom', 'wc_psad');?></span> <input disabled="disabled" type="text" value="10" id="psad_count_meta_padding_bottom" name="psad_count_meta_padding_bottom" style="width:60px" />px</label>
				</td>
			</tr>
    <?php
	}
	
	public function psad_count_meta_styling_end() {
		echo '</div>';
	}


    /**
     * settings_tab_action()
     *
     * Do this when viewing our custom settings tab(s). One function for all tabs.
    */
    public function settings_tab_action() {
    	global $woocommerce_settings;
		
		// Determine the current tab in effect.
        $current_tab = $this->get_tab_in_view(current_filter(), 'woocommerce_settings_tabs_');

        // Hook onto this from another function to keep things clean.
        // do_action( 'woocommerce_newsletter_settings' );

		if(isset($_REQUEST['saved']) && get_option("wc_psad_message") != ''){
			echo '<div id="message" class="updated fade"><p>'.get_option("wc_psad_message").'</p></div>';
			update_option('wc_psad_message', '');
		}
		?>
        <style type="text/css">
		.form-table { margin:0; }
		#a3_plugin_panel_container { position:relative; margin-top:10px;}
		#a3_plugin_panel_fields {width:65%; float:left; margin-top:10px;}
		#a3_plugin_panel_upgrade_area { position:relative; margin-left: 65%; padding-left:10px;}
		#a3_plugin_panel_extensions { border:2px solid #E6DB55;-webkit-border-radius:10px;-moz-border-radius:10px;-o-border-radius:10px; border-radius: 10px; color: #555555; margin: 0px; padding: 5px 10px; text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8); background:#FFFBCC; }
		.pro_feature_fields { margin-right: -12px; position: relative; z-index: 10; border:2px solid #E6DB55;-webkit-border-radius:10px 0 0 10px;-moz-border-radius:10px 0 0 10px;-o-border-radius:10px 0 0 10px; border-radius: 10px 0 0 10px; border-right: 2px solid #FFFFFF; }
		.pro_feature_fields h3 { margin:6px 5px; }
		.pro_feature_fields p { margin-left:5px; }
		.pro_feature_fields  .form-table td, .pro_feature_fields .form-table th { padding:4px 10px; }		
        </style>
        <div id="a3_plugin_panel_container">
            <div class="a3_subsubsub_section">
                <ul class="subsubsub">
                    <li><a href="#global-settings" class="current"><?php _e('Settings', 'wc_psad'); ?></a> | </li>
                    <li><a href="#endless-scroll"><?php _e('Endless Scroll', 'wc_psad'); ?></a> | </li>
                    <li><a href="#shop-page-scroll"><?php _e('Shop Scroll', 'wc_psad'); ?></a> | </li>
                    <li><a href="#cat-pages-scroll"><?php _e('Cat Scroll', 'wc_psad'); ?></a> | </li>
                    <li><a href="#view-all-products"><?php _e('View All Products', 'wc_psad'); ?></a> | </li>
                    <li><a href="#parent-cat-product-scroll"><?php _e('Parent Cat & Tag Scroll', 'wc_psad'); ?></a> | </li>
                    <li><a href="#visual-separator"><?php _e('Visual Separator', 'wc_psad'); ?></a> | </li>
                    <li><a href="#count-meta"><?php _e('Count Meta', 'wc_psad'); ?></a></li>
                </ul>
                <br class="clear">
                <div id="a3_plugin_panel_fields"> 
                    <div class="section" id="global-settings">
                    <div class="pro_feature_fields">
                    <?php
                    do_action('woocommerce_psad_settings');
                    // Display settings for this tab (make sure to add the settings to the tab).
                    woocommerce_admin_fields($woocommerce_settings[$current_tab]);
                    ?>
                    </div>
            	</div>
                <div id="a3_plugin_panel_upgrade_area"><?php echo WC_PSAD_Settings_Hook::plugin_extension(); ?></div>
            </div>
        </div>
        <div style="clear:both;"></div>
        	<script type="text/javascript">
				jQuery(window).load(function(){
					// Subsubsub tabs
					jQuery('div.a3_subsubsub_section ul.subsubsub li a:eq(0)').addClass('current');
					jQuery('div.a3_subsubsub_section .section:gt(0)').hide();

					jQuery('div.a3_subsubsub_section ul.subsubsub li a').click(function(){
						var $clicked = jQuery(this);
						var $section = $clicked.closest('.a3_subsubsub_section');
						var $target  = $clicked.attr('href');

						$section.find('a').removeClass('current');

						if ( $section.find('.section:visible').size() > 0 ) {
							$section.find('.section:visible').fadeOut( 100, function() {
								$section.find( $target ).fadeIn('fast');
							});
						} else {
							$section.find( $target ).fadeIn('fast');
						}

						$clicked.addClass('current');
						jQuery('#last_tab').val( $target );

						return false;
					});

					<?php if (isset($_GET['subtab']) && $_GET['subtab']) echo 'jQuery("div.a3_subsubsub_section ul.subsubsub li a[href=#'.$_GET['subtab'].']").click();'; ?>
				});
				(function($){
					$(function(){
						$("#psad_category_page_enable").attr('disabled', 'disabled');
						$("#psad_category_product_nosub_per_page").attr('disabled', 'disabled');
						$("#psad_top_product_per_page").attr('disabled', 'disabled');
						$("#psad_category_per_page").attr('disabled', 'disabled');
						$("#psad_product_per_page").attr('disabled', 'disabled');
						$("#psad_category_page_enable").attr('disabled', 'disabled');
						$("#psad_tag_page_enable").attr('disabled', 'disabled');
						$("#psad_tag_product_per_page").attr('disabled', 'disabled');
						$("#psad_endless_scroll_tag").attr('disabled', 'disabled');
						$("#psad_global_category_reset").attr('disabled', 'disabled');
						$("#psad_endless_scroll_category").attr('disabled', 'disabled');
						$("#psad_es_category_bt_text").attr('disabled', 'disabled');
						$("#psad_es_category_bt_rounded").attr('disabled', 'disabled');
						$("#psad_es_category_bt_class").attr('disabled', 'disabled');
						$("#psad_es_category_link_text").attr('disabled', 'disabled');
						$("#psad_es_products_bt_text").attr('disabled', 'disabled');
						$("#psad_es_products_bt_rounded").attr('disabled', 'disabled');
						$("#psad_es_products_bt_class").attr('disabled', 'disabled');
						$("#psad_es_products_link_text").attr('disabled', 'disabled');
						$("#psad_es_tag_products_link_text").attr('disabled', 'disabled');
						$("#psad_es_tag_products_bt_text").attr('disabled', 'disabled');
					});
				})(jQuery);
			</script>
        <?php
		add_action('admin_footer', array(&$this, 'add_scripts'), 10);
	}

	/**
     * add_settings_fields()
     *
     * Add settings fields for each tab.
    */
    public function add_settings_fields() {
    	global $woocommerce_settings;

        // Load the prepared form fields.
        $this->init_form_fields();

        if ( is_array($this->fields) ) :
        	foreach ( $this->fields as $k => $v ) :
                $woocommerce_settings[$k] = $v;
            endforeach;
        endif;
	}

    /**
    * get_tab_in_view()
    *
    * Get the tab current in view/processing.
    */
    public function get_tab_in_view($current_filter, $filter_base) {
    	return str_replace($filter_base, '', $current_filter);
    }
	

    /**
     * init_form_fields()
     *
     * Prepare form fields to be used in the various tabs.
     */
	public function init_form_fields() {
		global $wpdb;
		
  		// Define settings			
     	$this->fields['psad_settings'] = apply_filters('woocommerce_psad_settings_fields', array(
		
			array(
            	'name' => __( 'Parent / Child Category Page Settings', 'wc_psad' ),
                'type' => 'title',
                'desc' => sprintf( __("Please Go to the <a target='_blank' href='%s'>Catalog Tab</a> and set the 'Default Category Display'. Select 'Show Both' to show Parent Cat products and Child Cats with Products. Can over ride on a category by category basis from each category edit page. Use the settings below to configure the product display.", 'wc_psad'), admin_url( 'admin.php?page=woocommerce_settings&tab=catalog', 'relative' ) ),
           	),
			array(  
				'name' 		=> __( 'Enable/Disable', 'wc_psad' ),
				'desc' 		=> __("Check to activate sort and show products by sub categories on Product category pages.", 'wc_psad'),
				'id' 		=> 'psad_category_page_enable',
				'type' 		=> 'checkbox',
				'std' 		=> 0,
				'default'	=> 'no'
			),
			array(  
				'name' => __( 'Category Products (No Sub Cats)', 'wc_psad' ),
				'desc' 		=> __("The number of products to show per Endless Scroll or pagination.", 'wc_psad'). ' '. __('Default is 12.', 'wc_psad'),
				'id' 		=> 'psad_category_product_nosub_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:120px;',
				'std' 		=> '12',
				'default'	=> '12'
			),
			array(  
				'name' => __( 'Parent Category Products', 'wc_psad' ),
				'desc' 		=> __("Sets the number of Parent Category Products to show before Child Cat Product Groups.", 'wc_psad'). ' '. __('Default is 3.', 'wc_psad'),
				'id' 		=> 'psad_top_product_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:120px;',
				'std' 		=> '3',
				'default'	=> '3'
			),
			array(  
				'name' => __( 'Sub Categories Per Page', 'wc_psad' ),
				'desc' 		=> __('Set the number of Sub Category product groups to show per pagination or endless scroll event.', 'wc_psad'). ' '. __('Default is 3.', 'wc_psad'),
				'id' 		=> 'psad_category_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:120px;',
				'std' 		=> '3',
				'default'	=> '3'
			),
			array(  
				'name' => __( 'Products per Sub Category', 'wc_psad' ),
				'desc' 		=> __('Set the number of products to show per sub Category.', 'wc_psad'). ' '. __('Default is 3.', 'wc_psad'),
				'id' 		=> 'psad_product_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:120px;',
				'std' 		=> '3',
				'default'	=> '3'
			),
			array(  
				'name' 		=> __( "Product Sort", 'wc_psad' ),
				'desc' 		=> __('Product type can be set on a Category by category basis with the Pro version', 'wc_psad'),
				'id' 		=> 'psad_product_show_type',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'none',
				'default'	=> 'none',
				'options'	=> array(
						'none'			=> __( 'Default (Recent)', 'wc_psad' ) ,							
						'onsale'		=> __( 'On Sale', 'wc_psad' ) ,
						'featured'		=> __( 'Featured', 'wc_psad' ) ,
					),
			),
			array(  
				'name' 		=> __( 'Enable/Disable', 'wc_psad' ),
				'desc' 		=> __("Show Product count under category Title.", 'wc_psad'),
				'id' 		=> 'psad_cat_enable_product_showing_count',
				'type' 		=> 'checkbox',
				'std' 		=> 0,
				'default'	=> 'no'
			),
			array('type' => 'sectionend', 'id' => 'psad_global_settings_end'),
			
			array(
            	'name' => __( 'Tag Page Settings', 'wc_psad' ),
                'type' => 'title',
           	),
			array(  
				'name' 		=> __( 'Enable/Disable', 'wc_psad' ),
				'desc' 		=> __("Check to activate sort Product tag pages.", 'wc_psad'),
				'id' 		=> 'psad_tag_page_enable',
				'type' 		=> 'checkbox',
				'std' 		=> 0,
				'default'	=> 'no'
			),
			array(  
				'name' => __( 'Tag Products', 'wc_psad' ),
				'desc' 		=> __("The number of products to show per Endless Scroll or pagination.", 'wc_psad'). ' '. __('Default is 12.', 'wc_psad'),
				'id' 		=> 'psad_tag_product_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:120px;',
				'std' 		=> '12',
				'default'	=> '12'
			),
			array(  
				'name' 		=> __( "Product Sort", 'wc_psad' ),
				'id' 		=> 'psad_tag_product_show_type',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'none',
				'default'	=> 'none',
				'options'	=> array(
						'none'			=> __( 'Default (Recent)', 'wc_psad' ) ,							
						'onsale'		=> __( 'On Sale', 'wc_psad' ) ,
						'featured'		=> __( 'Featured', 'wc_psad' ) ,
					),
			),
			array('type' => 'sectionend', 'id' => 'psad_tag_page_settings_end'),
			
			array(
            	'name' => __( 'Shop Page Show Products by Category', 'wc_psad' ),
                'type' => 'title',
                'desc' => sprintf( __("These settings when activated over ride the WooCommerce <a target='_blank' href='%s'>Catalog Options</a> shop page settings.", 'wc_psad'), admin_url( 'admin.php?page=woocommerce_settings&tab=catalog', 'relative' ) ),
           	),
			array(  
				'name' 		=> __( 'Enable/Disable', 'wc_psad' ),
				'desc' 		=> sprintf( __("Check to activate sort and show products by category on Shop pages. Sort categories by drop and drag at <a target='_blank' href='%s'>Product Categories</a>.", 'wc_psad'), admin_url( 'edit-tags.php?taxonomy=product_cat&post_type=product', 'relative' ) ),
				'id' 		=> 'psad_shop_page_enable',
				'type' 		=> 'checkbox',
				'std' 		=> 1,
				'default'	=> 'yes'
			),
			array(  
				'name' => __( 'Categories Per Page', 'wc_psad' ),
				'desc' 		=> __('Set the number of Category product groups to show per pagination or endless scroll event.', 'wc_psad'). ' '. __('Default is 3.', 'wc_psad'),
				'id' 		=> 'psad_shop_category_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:120px;',
				'std' 		=> '3',
				'default'	=> '3'
			),
			array(  
				'name' => __( 'Products per Category', 'wc_psad' ),
				'desc' 		=> __('Set the number of products to show per Category on Shop pages. Can over ride on a category by category basis from each category edit page.', 'wc_psad'). ' '. __('Default is 3.', 'wc_psad'),
				'id' 		=> 'psad_shop_product_per_page',
				'type' 		=> 'text',
				'css' 		=> 'width:120px;',
				'std' 		=> '3',
				'default'	=> '3'
			),
			array(  
				'name' 		=> __( "Product Sort", 'wc_psad' ),
				'desc' 		=> __('Product type can be set on a Category by category basis with the Pro version', 'wc_psad'),
				'id' 		=> 'psad_shop_product_show_type',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'none',
				'default'	=> 'none',
				'options'	=> array(
						'none'			=> __( 'Default (Recent)', 'wc_psad' ) ,							
						'onsale'		=> __( 'On Sale', 'wc_psad' ) ,
						'featured'		=> __( 'Featured', 'wc_psad' ) ,
					),
			),
			array(  
				'name' 		=> __( 'Enable/Disable', 'wc_psad' ),
				'desc' 		=> __("Show Product count under category Title.", 'wc_psad'),
				'id' 		=> 'psad_shop_enable_product_showing_count',
				'type' 		=> 'checkbox',
				'std' 		=> 1,
				'default'	=> 'yes'
			),
			array('type' => 'sectionend', 'id' => 'psad_shop_global_settings_end'),
			
			array(
            	'name' => __( 'Visual Content Separator', 'wc_psad' ),
                'type' => 'title',
                'desc' => '',
           	),
			array(  
				'name' 		=> __( 'Visual Separator', 'wc_psad' ),
				'desc' 		=> __("Check to show a separator between each category group of products on Shop Page. Add custom Style under the Visual Content Separator sub nav.", 'wc_psad'),
				'id' 		=> 'psad_seperator_enable',
				'type' 		=> 'checkbox',
				'std' 		=> 0,
				'default'	=> 'no'
			),
			array('type' => 'sectionend', 'id' => 'psad_shop_category_end'),
			
			array(
            	'name' => __( 'Shop Page', 'wc_psad' ),
                'type' => 'title',
                'desc' => '',
          		'id' => 'wcpsad_endless_scroll_shop_start'
           	),
			array(  
				'name' 		=> __( 'Enable/Disable', 'wc_psad' ),
				'desc' 		=> __( "Check to activate the Endless Scroll feature for Category groups on Shop page.", 'wc_psad' ),
				'id' 		=> 'psad_endless_scroll_category_shop',
				'type' 		=> 'checkbox',
				'std' 		=> 1,
				'default'	=> 'yes'
			),
			array(  
				'name' 		=> __( 'Scroll Type', 'wc_psad' ),
				'desc' 		=> __( "Add custom style for 'Click more' type from the Shop Page Scroll Sub Nav at top of page.", 'wc_psad'),
				'id' 		=> 'psad_endless_scroll_category_shop_tyle',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'click',
				'default'	=> 'click',
				'options'	=> array(
						'click'						=> __( 'Click more...', 'wc_psad' ) ,	
						'auto'						=> __( 'Auto Scroll', 'wc_psad' ) ,	
					),
			),
			array('type' => 'sectionend', 'id' => 'psad_endless_scroll_category_shop_end'),
			
			array(
            	'name' => __( 'Category Page', 'wc_psad' ),
                'type' => 'title',
          		'id' => 'wcpsad_endless_scroll_category_start'
           	),
			array(  
				'name' 		=> __( 'Enable/Disable', 'wc_psad' ),
				'desc' 		=> __("Check to activate the Endless Scroll feature for Sub Category groups on Category page.", 'wc_psad'),
				'id' 		=> 'psad_endless_scroll_category',
				'type' 		=> 'checkbox',
				'std' 		=> 0,
				'default'	=> 'no'
			),
			array(  
				'name' 		=> __( 'Scroll Type', 'wc_psad' ),
				'desc' 		=> __( "Add custom style for 'Click more' type from the Category Page Scroll Sub Nav at top of page.", 'wc_psad'),
				'id' 		=> 'psad_endless_scroll_category_tyle',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'click',
				'default'	=> 'click',
				'options'	=> array(
						'click'						=> __( 'Click more...', 'wc_psad' ) ,	
						'auto'						=> __( 'Auto Scroll', 'wc_psad' ) ,	
					),
			),
			array('type' => 'sectionend'),
			array(
                'type' => 'title',
                'desc' => __( "Note: To show a Parent Categories products and Sub cats with Products on a Parent Category URL you must have the Categories endless scroll feature activated. Also you must set the WooCommerce Display type to 'Show Both'. Once set Parent Category 'View More products' is Endless Scroll mode 'Click More' and can't be changed. Sub Categories of the Parent Category will show on the parent category page under the Parent Cat products and will use the global 'Scroll Type' mode you set here on this page." , 'wc_psad' ),
           	),
			array('type' => 'sectionend'),
			
			array(
            	'name' => __( 'Tag Page', 'wc_psad' ),
                'type' => 'title',
           	),
			array(  
				'name' 		=> __( 'Enable/Disable', 'wc_psad' ),
				'desc' 		=> __("Check to activate the Endless Scroll feature for Products on Tag page.", 'wc_psad'),
				'id' 		=> 'psad_endless_scroll_tag',
				'type' 		=> 'checkbox',
				'std' 		=> 0,
				'default'	=> 'no'
			),
			array(  
				'name' 		=> __( 'Scroll Type', 'wc_psad' ),
				'desc' 		=> __( "Add custom style for 'Click more' type from the Tag Page Scroll Sub Nav at top of page.", 'wc_psad'),
				'id' 		=> 'psad_endless_scroll_tag_tyle',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'click',
				'default'	=> 'click',
				'options'	=> array(
						'click'						=> __( 'Click more...', 'wc_psad' ) ,	
						'auto'						=> __( 'Auto Scroll', 'wc_psad' ) ,	
					),
			),
			array('type' => 'sectionend', 'id' => 'psad_endless_scroll_end'),
			
			// Endless Scroll Style For Shop Page
			array(
            	'name' => __( 'Shop Page Categories Endless Scroll on Click style', 'wc_psad' ),
                'type' => 'title',
           	),
			array(  
				'name' 		=> __( 'Button or Hyperlink Text', 'wc_psad' ),
				'id' 		=> 'psad_es_shop_bt_type',
				'class'		=> 'psad_es_shop_bt_type',
				'type' 		=> 'radio',
				'std' 		=> 'link',
				'default'	=> 'link',
				'options'	=> array(
						'link'			=> __( 'Linked Text', 'wc_psad' ) ,	
						'button'		=> __( 'Button', 'wc_psad' ) ,	
						),
			),
			array('type' => 'sectionend'),
			
			array( 'type' 	=> 'title', 'desc'	=> '<div class="psad_es_shop_bt_styling">' ),
			array('type' => 'sectionend'),
			array(
            	'name' 	=> __( 'Button Styling', 'wc_psad' ),
                'type' 	=> 'title',
           	),
			array(  
				'name' => __( 'Button Text', 'wc_psad' ),
				'desc' 		=> __('Text for Endless Scroll on shop page', 'wc_psad'),
				'id' 		=> 'psad_es_shop_bt_text',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> __( 'Click More Categories', 'wc_psad' ),
				'default'	=> __( 'Click More Categories', 'wc_psad' ),
			),
			array(  
				'name' 		=> __( 'Button Align', 'wc_psad' ),
				'id' 		=> 'psad_es_shop_bt_align',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'center',
				'default'	=> 'center',
				'options'	=> array(
						'center'		=> __( 'Center', 'wc_psad' ) ,	
						'left'			=> __( 'Left', 'wc_psad' ) ,	
						'right'			=> __( 'Right', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' => __( 'Background Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_shop_bt_bg',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Background Colour Gradient From', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_shop_bt_bg_from',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Background Colour Gradient From', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #4b6E90',
				'id' 		=> 'psad_es_shop_bt_bg_to',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#4b6E90',
				'default'	=> '#4b6E90'
			),
			array(  
				'name' 		=> __( 'Border Weight', 'wc_psad' ),
				'id' 		=> 'psad_es_shop_bt_border_width',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '1',
				'default'	=> '1',
				'options'	=> $this->get_border(),
			),
			array(  
				'name' 		=> __( 'Border Style', 'wc_psad' ),
				'id' 		=> 'psad_es_shop_bt_border_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'solid',
				'default'	=> 'solid',
				'options'	=> array(
						'solid'			=> __( 'Solid', 'wc_psad' ) ,	
						'dotted'		=> __( 'Dotted', 'wc_psad' ) ,							
						'dashed'		=> __( 'Dashed', 'wc_psad' ) ,
						'double'		=> __( 'Double', 'wc_psad' ) ,
					),
			),
			array(  
				'name' => __( 'Border Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_shop_bt_border_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Border Rounded', 'wc_psad' ),
				'desc' 		=> 'px',
				'id' 		=> 'psad_es_shop_bt_rounded',
				'type' 		=> 'text',
				'css' 		=> 'width:120px;',
				'std' 		=> '3',
				'default'	=> '3'
			),
			array(  
				'name' 		=> __( 'Button Font', 'wc_psad' ),
				'desc' 		=> '',
				'id' 		=> 'psad_es_shop_bt_font_family',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'Arial, sans-serif',
				'default'	=> 'Arial, sans-serif',
				'options'	=> $this->get_font(),
			),
			array(  
				'name' 		=> __( 'Button Font Size', 'wc_psad' ),
				'id' 		=> 'psad_es_shop_bt_font_size',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '12',
				'default'	=> '12',
				'options'	=> $this->get_font_size(),
			),
			array(  
				'name' 		=> __( 'Button Font Style', 'wc_psad' ),
				'id' 		=> 'psad_es_shop_bt_font_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'bold',
				'default'	=> 'bold',
				'options'	=> array(
						'normal'			=> __( 'Normal', 'wc_psad' ),	
						'italic'			=> __( 'Italic', 'wc_psad' ),	
						'bold'				=> __( 'Bold', 'wc_psad' ),
						'bold_italic'		=> __( 'Bold/Italic', 'wc_psad' ),
					),
			),
			array(  
				'name' => __( 'Button Font Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #FFFFFF',
				'id' 		=> 'psad_es_shop_bt_font_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#FFFFFF',
				'default'	=> '#FFFFFF'
			),
			array(  
				'name' => __( 'CSS Class', 'wc_psad' ),
				'desc' 		=> __('Enter your own button CSS class', 'wc_psad'),
				'id' 		=> 'psad_es_shop_bt_class',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> '',
				'default'	=> ''
			),
			array('type' => 'sectionend'),
			
			array( 'type' 	=> 'title', 'desc'	=> '</div><div class="psad_es_shop_link_styling">' ),
			array('type' => 'sectionend'),
			
			array(
            	'name' 	=> __( 'Linked Text Styling', 'wc_psad' ),
                'type' 	=> 'title',
           	),
			array(  
				'name' => __( 'Linked Text', 'wc_psad' ),
				'desc' 		=> __('Text for Endless Scroll on shop page', 'wc_psad'),
				'id' 		=> 'psad_es_shop_link_text',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> __( 'Click More Categories', 'wc_psad' ),
				'default'	=> __( 'Click More Categories', 'wc_psad' ),
			),
			array(  
				'name' 		=> __( 'Linked Text Align', 'wc_psad' ),
				'id' 		=> 'psad_es_shop_link_align',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'center',
				'default'	=> 'center',
				'options'	=> array(
						'center'		=> __( 'Center', 'wc_psad' ) ,	
						'left'			=> __( 'Left', 'wc_psad' ) ,	
						'right'			=> __( 'Right', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' 		=> __( 'Font', 'wc_psad' ),
				'id' 		=> 'psad_es_shop_link_font_family',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'Arial, sans-serif',
				'default'	=> 'Arial, sans-serif',
				'options'	=> $this->get_font(),
			),
			array(  
				'name' 		=> __( 'Font Size', 'wc_psad' ),
				'id' 		=> 'psad_es_shop_link_font_size',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '12',
				'default'	=> '12',
				'options'	=> $this->get_font_size(),
			),
			array(  
				'name' 		=> __( 'Font Style', 'wc_psad' ),
				'id' 		=> 'psad_es_shop_link_font_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'bold',
				'default'	=> 'bold',
				'options'	=> array(
						'normal'			=> __( 'Normal', 'wc_psad' ),	
						'italic'			=> __( 'Italic', 'wc_psad' ),	
						'bold'				=> __( 'Bold', 'wc_psad' ),
						'bold_italic'		=> __( 'Bold/Italic', 'wc_psad' ),
					),
			),
			array(  
				'name' => __( 'Font Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_shop_link_font_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Font Hover Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #4b6E90',
				'id' 		=> 'psad_es_shop_link_font_hover_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#4b6E90',
				'default'	=> '#4b6E90'
			),
			array('type' => 'sectionend'),
			array( 'type' 	=> 'title', 'desc'	=> '</div>' ),
			array('type' => 'sectionend', 'id' => 'psad_shop_page_scroll_end'),
			
			// Endless Scroll Style For Category Page
			array(
            	'name' => __( 'Categories Endless Scroll on Click Style', 'wc_psad' ),
                'type' => 'title',
           	),
			array(  
				'name' 		=> __( 'Button or Hyperlink Text', 'wc_psad' ),
				'id' 		=> 'psad_es_category_bt_type',
				'class'		=> 'psad_es_category_bt_type',
				'type' 		=> 'radio',
				'std' 		=> 'link',
				'default'	=> 'link',
				'options'	=> array(
						'link'			=> __( 'Linked Text', 'wc_psad' ) ,	
						'button'		=> __( 'Button', 'wc_psad' ) ,	
					),
			),
			array('type' => 'sectionend'),
			
			array( 'type' 	=> 'title', 'desc'	=> '<div class="psad_es_category_bt_styling">' ),
			array('type' => 'sectionend'),
			array(
            	'name' 	=> __( 'Button Styling', 'wc_psad' ),
                'type' 	=> 'title',
           	),
			array(  
				'name' => __( 'Button Text', 'wc_psad' ),
				'desc' 		=> __('Text for Endless Scroll on Category page', 'wc_psad'),
				'id' 		=> 'psad_es_category_bt_text',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> __( 'Click More Categories', 'wc_psad' ),
				'default'	=> __( 'Click More Categories', 'wc_psad' )
			),
			array(  
				'name' 		=> __( 'Button Align', 'wc_psad' ),
				'id' 		=> 'psad_es_category_bt_align',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'center',
				'default'	=> 'center',
				'options'	=> array(
						'center'		=> __( 'Center', 'wc_psad' ) ,	
						'left'			=> __( 'Left', 'wc_psad' ) ,	
						'right'			=> __( 'Right', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' => __( 'Background Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad'). ' #7497B9',
				'id' 		=> 'psad_es_category_bt_bg',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Background Colour Gradient From', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_category_bt_bg_from',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Background Colour Gradient From', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #4b6E90',
				'id' 		=> 'psad_es_category_bt_bg_to',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#4b6E90',
				'default'	=> '#4b6E90'
			),
			array(  
				'name' 		=> __( 'Border Weight', 'wc_psad' ),
				'id' 		=> 'psad_es_category_bt_border_width',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '1',
				'default'	=> '1',
				'options'	=> $this->get_border(),
			),
			array(  
				'name' 		=> __( 'Border Style', 'wc_psad' ),
				'id' 		=> 'psad_es_category_bt_border_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'solid',
				'default'	=> 'solid',
				'options'	=> array(
						'solid'			=> __( 'Solid', 'wc_psad' ) ,	
						'dotted'		=> __( 'Dotted', 'wc_psad' ) ,							
						'dashed'		=> __( 'Dashed', 'wc_psad' ) ,
						'double'		=> __( 'Double', 'wc_psad' ) ,
					),
			),
			array(  
				'name' => __( 'Border Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_category_bt_border_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Border Rounded', 'wc_psad' ),
				'desc' 		=> 'px',
				'id' 		=> 'psad_es_category_bt_rounded',
				'type' 		=> 'text',
				'css' 		=> 'width:120px;',
				'std' 		=> '3',
				'default'	=> '3'
			),
			array(  
				'name' 		=> __( 'Button Font', 'wc_psad' ),
				'id' 		=> 'psad_es_category_bt_font_family',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'Arial, sans-serif',
				'default'	=> 'Arial, sans-serif',
				'options'	=> $this->get_font(),
			),
			array(  
				'name' 		=> __( 'Button Font Size', 'wc_psad' ),
				'id' 		=> 'psad_es_category_bt_font_size',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '12',
				'default'	=> '12',
				'options'	=> $this->get_font_size(),
			),
			array(  
				'name' 		=> __( 'Button Font Style', 'wc_psad' ),
				'id' 		=> 'psad_es_category_bt_font_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'bold',
				'default'	=> 'bold',
				'options'	=> array(
						'normal'		=> __( 'Normal', 'wc_psad' ) ,	
						'italic'		=> __( 'Italic', 'wc_psad' ) ,	
						'bold'			=> __( 'Bold', 'wc_psad' ) ,
						'bold_italic'	=> __( 'Bold/Italic', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' => __( 'Button Font Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #FFFFFF',
				'id' 		=> 'psad_es_category_bt_font_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#FFFFFF',
				'default'	=> '#FFFFFF'
			),
			array(  
				'name' => __( 'CSS Class', 'wc_psad' ),
				'desc' 		=> __('Enter your own button CSS class', 'wc_psad'),
				'id' 		=> 'psad_es_category_bt_class',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> '',
				'default'	=> ''
			),
			array('type' => 'sectionend'),
			
			array( 'type' 	=> 'title', 'desc'	=> '</div><div class="psad_es_category_link_styling">' ),
			array('type' => 'sectionend'),
			
			array(
            	'name' 	=> __( 'Linked Text Styling', 'wc_psad' ),
                'type' 	=> 'title',
           	),
			array(  
				'name' => __( 'Linked Text', 'wc_psad' ),
				'desc' 		=> __('Text for Endless Scroll on Category page', 'wc_psad'),
				'id' 		=> 'psad_es_category_link_text',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> __( 'Click More Categories', 'wc_psad' ),
				'default'	=> __( 'Click More Categories', 'wc_psad' ),
			),
			array(  
				'name' 		=> __( 'Linked Text Align', 'wc_psad' ),
				'id' 		=> 'psad_es_category_link_align',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'center',
				'default'	=> 'center',
				'options'	=> array(
						'center'		=> __( 'Center', 'wc_psad' ) ,	
						'left'			=> __( 'Left', 'wc_psad' ) ,	
						'right'			=> __( 'Right', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' 		=> __( 'Font', 'wc_psad' ),
				'id' 		=> 'psad_es_category_link_font_family',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'Arial, sans-serif',
				'default'	=> 'Arial, sans-serif',
				'options'	=> $this->get_font(),
			),
			array(  
				'name' 		=> __( 'Font Size', 'wc_psad' ),
				'id' 		=> 'psad_es_category_link_font_size',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '12',
				'default'	=> '12',
				'options'	=> $this->get_font_size(),
			),
			array(  
				'name' 		=> __( 'Font Style', 'wc_psad' ),
				'id' 		=> 'psad_es_category_link_font_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'bold',
				'default'	=> 'bold',
				'options'	=> array(
						'normal'			=> __( 'Normal', 'wc_psad' ),	
						'italic'			=> __( 'Italic', 'wc_psad' ),	
						'bold'				=> __( 'Bold', 'wc_psad' ),
						'bold_italic'		=> __( 'Bold/Italic', 'wc_psad' ),
					),
			),
			array(  
				'name' => __( 'Font Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_category_link_font_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Font Hover Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #4b6E90',
				'id' 		=> 'psad_es_category_link_font_hover_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#4b6E90',
				'default'	=> '#4b6E90'
			),
			array('type' => 'sectionend'),
			array( 'type' 	=> 'title', 'desc'	=> '</div>' ),
			array('type' => 'sectionend', 'id' => 'psad_es_category_scroll_end'),
			
			// View All Products Styling
			array(
            	'name' => __( 'Style for View all Products link in each Category', 'wc_psad' ),
                'type' => 'title',
           	),
			array(  
				'name' 		=> __( 'Button or Hyperlink Text', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_bt_type',
				'class'		=> 'psad_es_category_item_bt_type',
				'type' 		=> 'radio',
				'std' 		=> 'link',
				'default'	=> 'link',
				'options'	=> array(
						'link'			=> __( 'Linked Text', 'wc_psad' ) ,	
						'button'		=> __( 'Button', 'wc_psad' ) ,	
					),
			),
			array('type' => 'sectionend'),
			
			array(
            	'name' => __( 'View All Position', 'wc_psad' ),
                'type' => 'title',
           	),
			array(  
				'name' 		=> __( 'Show at', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_bt_position',
				'type' 		=> 'radio',
				'std' 		=> 'bottom',
				'default'	=> 'bottom',
				'options'	=> array(
						'top'			=> __( 'At top After Category product count meta', 'wc_psad' ) ,	
						'bottom'		=> __( 'At Bottom under category products', 'wc_psad' ) ,	
					),
			),
			array('type' => 'sectionend'),
			
			array( 'type' 	=> 'title', 'desc'	=> '<div class="psad_es_category_item_bt_styling">' ),
			array('type' => 'sectionend'),
			array(
            	'name' 	=> __( 'Button Styling', 'wc_psad' ),
                'type' 	=> 'title',
           	),
			array(  
				'name' => __( 'Button Text', 'wc_psad' ),
				'desc' 		=> __('Text for link in each category', 'wc_psad'),
				'id' 		=> 'psad_es_category_item_bt_text',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> __( 'See more...', 'wc_psad' ),
				'default'	=> __( 'See more...', 'wc_psad' ),
			),
			array(  
				'name' 		=> __( 'Button Align', 'wc_psad' ),
				'desc' 		=> '',
				'id' 		=> 'psad_es_category_item_bt_align',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'center',
				'default'	=> 'center',
				'options'	=> array(
						'center'		=> __( 'Center', 'wc_psad' ) ,	
						'left'			=> __( 'Left', 'wc_psad' ) ,	
						'right'			=> __( 'Right', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' => __( 'Background Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_category_item_bt_bg',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Background Colour Gradient From', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_category_item_bt_bg_from',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Background Colour Gradient From', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #4b6E90',
				'id' 		=> 'psad_es_category_item_bt_bg_to',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#4b6E90',
				'default'	=> '#4b6E90'
			),
			array(  
				'name' 		=> __( 'Border Weight', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_bt_border_width',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '1',
				'default'	=> '1',
				'options'	=> $this->get_border(),
			),
			array(  
				'name' 		=> __( 'Border Style', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_bt_border_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'solid',
				'default'	=> 'solid',
				'options'	=> array(
						'solid'			=> __( 'Solid', 'wc_psad' ) ,	
						'dotted'		=> __( 'Dotted', 'wc_psad' ) ,							
						'dashed'		=> __( 'Dashed', 'wc_psad' ) ,
						'double'		=> __( 'Double', 'wc_psad' ) ,
					),
			),
			array(  
				'name' => __( 'Border Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_category_item_bt_border_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Border Rounded', 'wc_psad' ),
				'desc' 		=> 'px',
				'id' 		=> 'psad_es_category_item_bt_rounded',
				'type' 		=> 'text',
				'css' 		=> 'width:120px;',
				'std' 		=> '3',
				'default'	=> '3'
			),
			array(  
				'name' 		=> __( 'Button Font', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_bt_font_family',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'Arial, sans-serif',
				'default'	=> 'Arial, sans-serif',
				'options'	=> $this->get_font(),
			),
			array(  
				'name' 		=> __( 'Button Font Size', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_bt_font_size',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '12',
				'default'	=> '12',
				'options'	=> $this->get_font_size(),
			),
			array(  
				'name' 		=> __( 'Button Font Style', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_bt_font_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'bold',
				'default'	=> 'bold',
				'options'	=> array(
						'normal'		=> __( 'Normal', 'wc_psad' ) ,	
						'italic'		=> __( 'Italic', 'wc_psad' ) ,	
						'bold'			=> __( 'Bold', 'wc_psad' ) ,
						'bold_italic'	=> __( 'Bold/Italic', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' => __( 'Button Font Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #FFFFFF',
				'id' 		=> 'psad_es_category_item_bt_font_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#FFFFFF',
				'default'	=> '#FFFFFF'
			),
			array(  
				'name' => __( 'CSS Class', 'wc_psad' ),
				'desc' 		=> __('Enter your own button CSS class', 'wc_psad'),
				'id' 		=> 'psad_es_category_item_bt_class',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> '',
				'default'	=> ''
			),
			array('type' => 'sectionend'),
			
			array( 'type' 	=> 'title', 'desc'	=> '</div><div class="psad_es_category_item_link_styling">' ),
			array('type' => 'sectionend'),
			
			array(
            	'name' 	=> __( 'Linked Text Styling', 'wc_psad' ),
                'type' 	=> 'title',
           	),
			array(  
				'name' => __( 'Linked Text', 'wc_psad' ),
				'desc' 		=> __('Text for link in each category', 'wc_psad'),
				'id' 		=> 'psad_es_category_item_link_text',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> __( 'See more...', 'wc_psad' ),
				'default'	=> __( 'See more...', 'wc_psad' ),
			),
			array(  
				'name' 		=> __( 'Linked Text Align', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_link_align',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'center',
				'default'	=> 'center',
				'options'	=> array(
						'center'		=> __( 'Center', 'wc_psad' ) ,	
						'left'			=> __( 'Left', 'wc_psad' ) ,	
						'right'			=> __( 'Right', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' 		=> __( 'Font', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_link_font_family',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'Arial, sans-serif',
				'default'	=> 'Arial, sans-serif',
				'options'	=> $this->get_font(),
			),
			array(  
				'name' 		=> __( 'Font Size', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_link_font_size',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '12',
				'default'	=> '12',
				'options'	=> $this->get_font_size(),
			),
			array(  
				'name' 		=> __( 'Font Style', 'wc_psad' ),
				'id' 		=> 'psad_es_category_item_link_font_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'bold',
				'default'	=> 'bold',
				'options'	=> array(
						'normal'			=> __( 'Normal', 'wc_psad' ),	
						'italic'			=> __( 'Italic', 'wc_psad' ),	
						'bold'				=> __( 'Bold', 'wc_psad' ),
						'bold_italic'		=> __( 'Bold/Italic', 'wc_psad' ),
					),
			),
			array(  
				'name' => __( 'Font Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_category_item_link_font_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Font Hover Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #4b6E90',
				'id' 		=> 'psad_es_category_item_link_font_hover_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#4b6E90',
				'default'	=> '#4b6E90'
			),
			array('type' => 'sectionend'),
			array( 'type' 	=> 'title', 'desc'	=> '</div>' ),
			array('type' => 'sectionend', 'id' => 'psad_es_category_item_end'),
			
			// Endless Scroll Style for Products
			array(
            	'name' => __( 'Parent Cat & Tag Products Endless Scroll on Click Style', 'wc_psad' ),
                'type' => 'title',
           	),
			array(  
				'name' 		=> __( 'Button or Hyperlink Text', 'wc_psad' ),
				'id' 		=> 'psad_es_products_bt_type',
				'class'		=> 'psad_es_products_bt_type',
				'type' 		=> 'radio',
				'std' 		=> 'link',
				'default'	=> 'link',
				'options'	=> array(
						'link'			=> __( 'Linked Text', 'wc_psad' ) ,	
						'button'		=> __( 'Button', 'wc_psad' ) ,	
					),
			),
			array('type' => 'sectionend'),
			
			array( 'type' 	=> 'title', 'desc'	=> '<div class="psad_es_products_bt_styling">' ),
			array('type' => 'sectionend'),
			array(
            	'name' 	=> __( 'Button Styling', 'wc_psad' ),
                'type' 	=> 'title',
           	),
			array(  
				'name' => __( 'Parent Cat Button Text', 'wc_psad' ),
				'desc' 		=> __('Text for Endless Scroll for Products', 'wc_psad'),
				'id' 		=> 'psad_es_products_bt_text',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> __( 'Click More Products', 'wc_psad' ),
				'default'	=> __( 'Click More Products', 'wc_psad' ),
			),
			array(  
				'name' => __( 'Tag More Product Button Text', 'wc_psad' ),
				'desc' 		=> __('Text for Endless Scroll for Products', 'wc_psad'),
				'id' 		=> 'psad_es_tag_products_bt_text',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> __( 'Click More Products', 'wc_psad' ),
				'default'	=> __( 'Click More Products', 'wc_psad' ),
			),
			array(  
				'name' 		=> __( 'Button Align', 'wc_psad' ),
				'id' 		=> 'psad_es_products_bt_align',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'center',
				'default'	=> 'center',
				'options'	=> array(
						'center'		=> __( 'Center', 'wc_psad' ) ,	
						'left'			=> __( 'Left', 'wc_psad' ) ,	
						'right'			=> __( 'Right', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' => __( 'Background Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_products_bt_bg',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Background Colour Gradient From', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_products_bt_bg_from',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Background Colour Gradient From', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #4b6E90',
				'id' 		=> 'psad_es_products_bt_bg_to',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#4b6E90',
				'default'	=> '#4b6E90'
			),
			array(  
				'name' 		=> __( 'Border Weight', 'wc_psad' ),
				'id' 		=> 'psad_es_products_bt_border_width',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '1',
				'default'	=> '1',
				'options'	=> $this->get_border(),
			),
			array(  
				'name' 		=> __( 'Border Style', 'wc_psad' ),
				'id' 		=> 'psad_es_products_bt_border_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'solid',
				'default'	=> 'solid',
				'options'	=> array(
						'solid'			=> __( 'Solid', 'wc_psad' ) ,	
						'dotted'		=> __( 'Dotted', 'wc_psad' ) ,							
						'dashed'		=> __( 'Dashed', 'wc_psad' ) ,
						'double'		=> __( 'Double', 'wc_psad' ) ,
					),
			),
			array(  
				'name' => __( 'Border Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_products_bt_border_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Border Rounded', 'wc_psad' ),
				'desc' 		=> 'px',
				'id' 		=> 'psad_es_products_bt_rounded',
				'type' 		=> 'text',
				'css' 		=> 'width:120px;',
				'std' 		=> '3',
				'default'	=> '3'
			),
			array(  
				'name' 		=> __( 'Button Font', 'wc_psad' ),
				'id' 		=> 'psad_es_products_bt_font_family',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'Arial, sans-serif',
				'default'	=> 'Arial, sans-serif',
				'options'	=> $this->get_font(),
			),
			array(  
				'name' 		=> __( 'Button Font Size', 'wc_psad' ),
				'id' 		=> 'psad_es_products_bt_font_size',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '12',
				'default'	=> '12',
				'options'	=> $this->get_font_size(),
			),
			array(  
				'name' 		=> __( 'Button Font Style', 'wc_psad' ),
				'id' 		=> 'psad_es_products_bt_font_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'bold',
				'default'	=> 'bold',
				'options'	=> array(
						'normal'		=> __( 'Normal', 'wc_psad' ) ,	
						'italic'		=> __( 'Italic', 'wc_psad' ) ,	
						'bold'			=> __( 'Bold', 'wc_psad' ) ,
						'bold_italic'	=> __( 'Bold/Italic', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' => __( 'Button Font Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad').' #FFFFFF',
				'id' 		=> 'psad_es_products_bt_font_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#FFFFFF',
				'default'	=> '#FFFFFF'
			),
			array(  
				'name' => __( 'CSS Class', 'wc_psad' ),
				'desc' 		=> __('Enter your own button CSS class', 'wc_psad'),
				'id' 		=> 'psad_es_products_bt_class',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> '',
				'default'	=> ''
			),
			array('type' => 'sectionend'),
			
			array( 'type' 	=> 'title', 'desc'	=> '</div><div class="psad_es_products_link_styling">' ),
			array('type' => 'sectionend'),
			
			array(
            	'name' 	=> __( 'Linked Text Styling', 'wc_psad' ),
                'type' 	=> 'title',
           	),
			array(  
				'name' => __( 'Parent Cat Linked Text', 'wc_psad' ),
				'desc' 		=> __('Text for Endless Scroll for Products', 'wc_psad'),
				'id' 		=> 'psad_es_products_link_text',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> __( 'Click More Products', 'wc_psad' ),
				'default'	=> __( 'Click More Products', 'wc_psad' ),
			),
			array(  
				'name' => __( 'Tag More Product Linked Text', 'wc_psad' ),
				'desc' 		=> __('Text for Endless Scroll for Products', 'wc_psad'),
				'id' 		=> 'psad_es_tag_products_link_text',
				'type' 		=> 'text',
				'css' 		=> 'width:300px;',
				'std' 		=> __( 'Click More Products', 'wc_psad' ),
				'default'	=> __( 'Click More Products', 'wc_psad' ),
			),
			array(  
				'name' 		=> __( 'Linked Text Align', 'wc_psad' ),
				'id' 		=> 'psad_es_products_link_align',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'center',
				'default'	=> 'center',
				'options'	=> array(
						'center'		=> __( 'Center', 'wc_psad' ) ,	
						'left'			=> __( 'Left', 'wc_psad' ) ,	
						'right'			=> __( 'Right', 'wc_psad' ) ,	
					),
			),
			array(  
				'name' 		=> __( 'Font', 'wc_psad' ),
				'id' 		=> 'psad_es_products_link_font_family',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'Arial, sans-serif',
				'default'	=> 'Arial, sans-serif',
				'options'	=> $this->get_font(),
			),
			array(  
				'name' 		=> __( 'Font Size', 'wc_psad' ),
				'id' 		=> 'psad_es_products_link_font_size',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '12',
				'default'	=> '12',
				'options'	=> $this->get_font_size(),
			),
			array(  
				'name' 		=> __( 'Font Style', 'wc_psad' ),
				'id' 		=> 'psad_es_products_link_font_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'bold',
				'default'	=> 'bold',
				'options'	=> array(
						'normal'			=> __( 'Normal', 'wc_psad' ),	
						'italic'			=> __( 'Italic', 'wc_psad' ),	
						'bold'				=> __( 'Bold', 'wc_psad' ),
						'bold_italic'		=> __( 'Bold/Italic', 'wc_psad' ),
					),
			),
			array(  
				'name' => __( 'Font Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_es_products_link_font_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#7497B9',
				'default'	=> '#7497B9'
			),
			array(  
				'name' => __( 'Font Hover Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #4b6E90',
				'id' 		=> 'psad_es_products_link_font_hover_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#4b6E90',
				'default'	=> '#4b6E90'
			),
			array('type' => 'sectionend'),
			array( 'type' 	=> 'title', 'desc'	=> '</div>' ),
			array('type' => 'sectionend', 'id' => 'wcpsad_endless_scroll_product_style_end' ),
			
			// Visual Content Separator Style
			array(
            	'name' => __( 'Visual Content Separator', 'wc_psad' ),
                'type' => 'title',
           	),
			array(  
				'name' 		=> __( 'Seperator Weight', 'wc_psad' ),
				'id' 		=> 'psad_seperator_border_width',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '1',
				'default'	=> '1',
				'options'	=> $this->get_border(),
			),
			array(  
				'name' 		=> __( 'Seperator Style', 'wc_psad' ),
				'id' 		=> 'psad_seperator_border_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'solid',
				'default'	=> 'solid',
				'options'	=> array(
						'solid'			=> __( 'Solid', 'wc_psad' ) ,	
						'dotted'		=> __( 'Dotted', 'wc_psad' ) ,							
						'dashed'		=> __( 'Dashed', 'wc_psad' ) ,
						'double'		=> __( 'Double', 'wc_psad' ) ,
					),
			),
			array(  
				'name' => __( 'Seperator Color', 'wc_psad' ),
				'id' 		=> 'psad_seperator_border_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#000000',
				'default'	=> '#000000'
			),
			array(  
				'name' => __( 'Seperator Padding', 'wc_psad' ),
				'desc' 		=> 'px '.__('Above/Below', 'wc_psad'),
				'id' 		=> 'psad_seperator_padding_tb',
				'type' 		=> 'text',
				'css' 		=> 'width:120px;',
				'std' 		=> '5',
				'default'	=> '5'
			),
			array('type' => 'sectionend', 'id' => 'psad_seperator_settings_end' ),
			
			// Count Meta Styling
			array(
            	'name' 	=> __( 'Categories Count Meta Setup', 'wc_psad' ),
                'type' 	=> 'title',
				'id'	=> 'psad_count_meta_text_start'
           	),
			array('type' => 'sectionend'),
			
			array(
            	'name' 	=> __( 'Tags Count Meta Setup', 'wc_psad' ),
                'type' 	=> 'title',
				'id'	=> 'psad_tag_count_meta_text_start'
           	),
			array('type' => 'sectionend'),
			
			array(
            	'name' 	=> __( 'Count Meta Styling', 'wc_psad' ),
                'type' 	=> 'title',
				'id'	=> 'psad_count_meta_styling_start',
           	),
			array(  
				'name' 		=> __( 'Font', 'wc_psad' ),
				'id' 		=> 'psad_count_meta_font_family',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'Arial, sans-serif',
				'default'	=> 'Arial, sans-serif',
				'options'	=> $this->get_font(),
			),
			array(  
				'name' 		=> __( 'Font Size', 'wc_psad' ),
				'id' 		=> 'psad_count_meta_font_size',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> '11',
				'default'	=> '11',
				'options'	=> $this->get_font_size(),
			),
			array(  
				'name' 		=> __( 'Font Style', 'wc_psad' ),
				'id' 		=> 'psad_count_meta_font_style',
				'css' 		=> 'width:120px;',
				'class'		=> 'chzn-select',
				'type' 		=> 'select',
				'std' 		=> 'italic',
				'default'	=> 'italic',
				'options'	=> array(
						'normal'			=> __( 'Normal', 'wc_psad' ),	
						'italic'			=> __( 'Italic', 'wc_psad' ),	
						'bold'				=> __( 'Bold', 'wc_psad' ),
						'bold_italic'		=> __( 'Bold/Italic', 'wc_psad' ),
					),
			),
			array(  
				'name' => __( 'Font Colour', 'wc_psad' ),
				'desc' 		=> __('Default', 'wc_psad') . ' #7497B9',
				'id' 		=> 'psad_count_meta_font_color',
				'type' 		=> 'color',
				'css' 		=> 'width:120px;',
				'std' 		=> '#000000',
				'default'	=> '#000000'
			),
			array('type' => 'sectionend', 'id' => 'psad_count_meta_styling_end' ),
        ));
	}
	
	public static function get_font_size() {
		$font_size = array();
		for ( $i = 9 ; $i <= 40 ; $i ++ ){$font_size[$i] = $i.__( 'px', 'wc_psad' );}
		return $font_size;
	}
	public static function get_border() {
		$border_width = array();
		for ( $i = 0 ; $i <= 20 ; $i ++ ){$border_width[$i] = $i.__( 'px', 'wc_psad' );}
		return $border_width;
	}
	
	public static function get_font() {
		$fonts = array( 
			'Arial, sans-serif'													=> __( 'Arial', 'wc_psad' ),
			'Verdana, Geneva, sans-serif'										=> __( 'Verdana', 'wc_psad' ),
			'Trebuchet MS, Tahoma, sans-serif'								=> __( 'Trebuchet', 'wc_psad' ),
			'Georgia, serif'													=> __( 'Georgia', 'wc_psad' ),
			'Times New Roman, serif'											=> __( 'Times New Roman', 'wc_psad' ),
			'Tahoma, Geneva, Verdana, sans-serif'								=> __( 'Tahoma', 'wc_psad' ),
			'Palatino, Palatino Linotype, serif'								=> __( 'Palatino', 'wc_psad' ),
			'Helvetica Neue, Helvetica, sans-serif'							=> __( 'Helvetica*', 'wc_psad' ),
			'Calibri, Candara, Segoe, Optima, sans-serif'						=> __( 'Calibri*', 'wc_psad' ),
			'Myriad Pro, Myriad, sans-serif'									=> __( 'Myriad Pro*', 'wc_psad' ),
			'Lucida Grande, Lucida Sans Unicode, Lucida Sans, sans-serif'	=> __( 'Lucida', 'wc_psad' ),
			'Arial Black, sans-serif'											=> __( 'Arial Black', 'wc_psad' ),
			'Gill Sans, Gill Sans MT, Calibri, sans-serif'					=> __( 'Gill Sans*', 'wc_psad' ),
			'Geneva, Tahoma, Verdana, sans-serif'								=> __( 'Geneva*', 'wc_psad' ),
			'Impact, Charcoal, sans-serif'										=> __( 'Impact', 'wc_psad' ),
			'Courier, Courier New, monospace'									=> __( 'Courier', 'wc_psad' ),
			'Century Gothic, sans-serif'										=> __( 'Century Gothic', 'wc_psad' ),
		);
		
		return apply_filters('psad_fonts_support', $fonts );
	}

    /**
     * save_settings()
     *
     * Save settings in a single field in the database for each tab's fields (one field per tab).
     */
	public function save_settings() {
     	global $woocommerce_settings;

        // Make sure our settings fields are recognised.
        $this->add_settings_fields();

        $current_tab = $this->get_tab_in_view(current_filter(), 'woocommerce_update_options_');

		woocommerce_update_options($woocommerce_settings[$current_tab]);
		
		delete_option( 'psad_category_page_enable' );
		delete_option( 'psad_tag_page_enable' );
		delete_option( 'psad_cat_enable_product_showing_count' );
		delete_option( 'psad_category_per_page' );
		delete_option( 'psad_product_per_page' );
		delete_option( 'psad_category_product_nosub_per_page' );
		delete_option( 'psad_tag_product_per_page' );
		delete_option( 'psad_top_product_per_page' );
		delete_option( 'psad_product_show_type' );
		delete_option( 'psad_tag_product_show_type' );
		delete_option( 'psad_endless_scroll_category' );
		delete_option( 'psad_endless_scroll_category_tyle' );
		delete_option( 'psad_endless_scroll_tag' );
		delete_option( 'psad_endless_scroll_tag_tyle' );
		
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
		
		delete_option( 'psad_count_meta_font_family' );
		delete_option( 'psad_count_meta_font_size' );
		delete_option( 'psad_count_meta_font_style' );
		delete_option( 'psad_count_meta_font_color' );
		
		if ( isset($_REQUEST['psad_clean_on_deletion']) ) {
			update_option('psad_clean_on_deletion',  $_REQUEST['psad_clean_on_deletion']);
		} else { 
			update_option('psad_clean_on_deletion',  0);
			$uninstallable_plugins = (array) get_option('uninstall_plugins');
			unset($uninstallable_plugins[WC_PSAD_NAME]);
			update_option('uninstall_plugins', $uninstallable_plugins);
		}
	}

    /** Helper functions ***************************************************** */
         
    /**
     * Gets a setting
     */
    public function setting($key) {
		return get_option($key);
	}
	
	public function add_scripts(){
		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_script('jquery');
		
		wp_enqueue_style( 'a3rev-chosen-style', WC_PSAD_JS_URL . '/chosen/chosen.css' );
		wp_enqueue_script( 'chosen', WC_PSAD_JS_URL . '/chosen/chosen.jquery'.$suffix.'.js', array(), false, true );
		
		wp_enqueue_script( 'a3rev-chosen-script-init', WC_PSAD_JS_URL.'/init-chosen.js', array(), false, true );
		
		wp_enqueue_script( 'psad-admin', WC_PSAD_JS_URL . '/admin.js', array(), false, true );
	}
}
?>
