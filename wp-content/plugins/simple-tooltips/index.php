<?php

/*
Plugin Name: Simple Tooltips
Description: Easily add tooltips to your wordpress site. You can define tooltip color settings in <strong>Settings > Simple Tooltips</strong>
Version: 1.0
Author: Justin Saad
Author URI: http://www.clevelandwebdeveloper.com
License: GPL2
*/

$plugin_label = "Simple Tooltips";
$plugin_slug = "simple_tooltips";

class simple_tooltips {

    public function __construct(){
    	
		global $plugin_label, $plugin_slug;
		$this->plugin_slug = $plugin_slug;
		$this->plugin_label = $plugin_label;
		
		//enqueue color picker
		add_action( 'admin_enqueue_scripts', array($this, 'enqueue_color_picker') );
		
		//plugin row links
		add_filter( 'plugin_row_meta', array($this,'plugin_row_links'), 10, 2 );
		
        if(is_admin()){
		    add_action('admin_menu', array($this, 'add_plugin_page'));
		    add_action('admin_init', array($this, 'page_init'));
		}
		
    }
	
	function enqueue_color_picker( $hook_suffix ) {
		// first check that $hook_suffix is appropriate for your admin page
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'my-script-handle', plugins_url('motech-color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	}

    public function add_plugin_page(){
        // This page will be under "Settings"
		add_options_page('Settings Admin', $this->plugin_label, 'manage_options', $this->plugin_slug.'-setting-admin', array($this, 'create_admin_page'));
    }
	
    public function print_section_info(){ //section summary info goes here
		print 'Set the basic color settings for your tooltips';
    }
	
    public function get_donate_button(){ ?>
	<style type="text/css">
	.motechdonate{border: 1px solid #DADADA; background:white; font-family: tahoma,arial,helvetica,sans-serif;font-size: 12px;overflow: hidden;padding: 5px;position: absolute;right: 0;text-align: center;top: 0;width: 160px; box-shadow:0px 0px 8px rgba(153, 153, 153, 0.81);}
	.motechdonate form{display:block;}
	</style>
    <div class="motechdonate">
        <div style="overflow: hidden; width: 161px; text-align: center;">
        <div style="overflow: hidden; width: 161px; text-align: center; float: left;"><form action="https://www.paypal.com/cgi-bin/webscr" method="post"><input name="cmd" value="_s-xclick" type="hidden"><input name="hosted_button_id" value="9TL57UDBAB7LU" type="hidden"><input alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" type="image"> <img src="https://www.paypal.com/en_US/i/scr/pixel.gif" alt="" border="0" height="1" width="1"></form></div>
        If you enjoy or find any of my plugins useful, please donate a few dollars to my company The Motech Network to help with future development and updates. Thanks in advance.			</div>
	</div>    
    
    <?php

    }
	
    public function create_admin_page(){
        ?>
		<div class="wrap" style="position:relative;">
        	<?php $this->get_donate_button() ?>
		    <?php screen_icon(); ?>
		    <h2><?php echo $this->plugin_label ?></h2>			
		    <form method="post" action="options.php">
		        <?php
	            // This prints out all hidden setting fields
			    settings_fields($this->plugin_slug.'_option_group');	
			    do_settings_sections($this->plugin_slug.'-setting-admin');
			?>
		        <?php submit_button(); ?>
		    </form>
		</div>
	<?php
    }
    
    public function page_init(){
        	
		//create settings section
        add_settings_section(
		    $this->plugin_slug.'_setting_section',
		    'Configuration',
		    array($this, 'print_section_info'),
		    $this->plugin_slug.'-setting-admin'
		);	
		
		//add color picker text input field
		$field_slug = "background_color";
		$field_label = "Background Color:";
		$field_id = $this->plugin_slug.'_'.$field_slug;
		register_setting($this->plugin_slug.'_option_group', $field_id);
		add_settings_field(
		    $field_id,
		    $field_label, 
		    array($this, 'create_a_text_input'), //callback function for text input
		    $this->plugin_slug.'-setting-admin',
		    $this->plugin_slug.'_setting_section',
		    array(								// The array of arguments to pass to the callback.
				"id" => $field_id, //sends field id to callback
				"desc" => 'Choose your tooltip background color above', //description of the field (optional)
				"default" => '#000000', //sets the default field value (optional), when grabbing this option value later on remember to use get_option(option_name, default_value) so it will return default value if no value exists yet
				"class" => "motech-color-field" //designate this as color field
			)			
		);
		
		//add color picker text input field
		$field_slug = "text_color";
		$field_label = "Text Color:";
		$field_id = $this->plugin_slug.'_'.$field_slug;
		register_setting($this->plugin_slug.'_option_group', $field_id);
		add_settings_field(
		    $field_id,
		    $field_label, 
		    array($this, 'create_a_text_input'), //callback function for text input
		    $this->plugin_slug.'-setting-admin',
		    $this->plugin_slug.'_setting_section',
		    array(								// The array of arguments to pass to the callback.
				"id" => $field_id, //sends field id to callback
				"desc" => 'Choose your tooltip text color above', //description of the field (optional)
				"default" => '#ffffff', //sets the default field value (optional), when grabbing this option value later on remember to use get_option(option_name, default_value) so it will return default value if no value exists yet
				"class" => "motech-color-field" //designate this as color field
			)			
		);

	
    } //end of page_init function

    
	/**
	 * This following set of functions handle all input field creation
	 * 
	 */
	function create_a_checkbox($args) {
		$html = '<input type="checkbox" id="'  . $args[id] . '" name="'  . $args[id] . '" value="1" ' . checked(1, get_option($args[id], $args["default"]), false) . '/>'; 
		
		// Here, we will take the desc argument of the array and add it to a label next to the checkbox
		$html .= '<label for="'  . $args[id] . '">&nbsp;&nbsp;'  . $args[desc] . '</label>'; 
		
		echo $html;
		
	} // end create_a_checkbox
	
	function create_a_text_input($args) {
		//grab placeholder if there is one
		if($args[placeholder]) {
			$placeholder_html = "placeholder=\"".$args[placeholder]."\"";
		}
		// Render the output
		echo '<input type="text" '  . $placeholder_html . ' id="'  . $args[id] . '" class="'.$args["class"].'" name="'  . $args[id] . '" value="' . get_option($args[id], $args["default"]) . '" />';
		if($args[desc]) {
			echo "<p class='description'>".$args[desc]."</p>";
		}
		
	} // end create_a_text_input
	
	function create_a_textarea_input($args) {
		//grab placeholder if there is one
		if($args[placeholder]) {
			$placeholder_html = "placeholder=\"".$args[placeholder]."\"";
		}	
		// Render the output
		echo '<textarea '  . $placeholder_html . ' id="'  . $args[id] . '"  name="'  . $args[id] . '" rows="5" cols="50">' . get_option($args[id], $args["default"]) . '</textarea>';
		if($args[desc]) {
			echo "<p class='description'>".$args[desc]."</p>";
		}		
	}
	
	function create_a_radio_input($args) {
	
		$radio_options = $args[radio_options];
		$html = "";
		if($args[desc]) {
			$html .= $args[desc] . "<br>";
		}
		foreach($radio_options as $radio_option) {
			$html .= '<input type="radio" id="'  . $args[id] . '_' . $radio_option[value] . '" name="'  . $args[id] . '" value="'.$radio_option[value].'" ' . checked($radio_option[value], get_option($args[id], $args["default"]), false) . '/>';
			$html .= '<label for="'  . $args[id] . '_' . $radio_option[value] . '"> '.$radio_option[label].'</label><br>';
		}
		
		echo $html;
	
	} // end create_a_radio_input callback

	function create_a_select_input($args) {
	
		$select_options = $args[select_options];
		$html = "";
		if($args[desc]) {
			$html .= $args[desc] . "<br>";
		}
		$html .= '<select id="'  . $args[id] . '" name="'  . $args[id] . '">';
			foreach($select_options as $select_option) {
				$html .= '<option value="'.$select_option[value].'" ' . selected( $select_option[value], get_option($args[id], $args["default"]), false) . '>'.$select_option[label].'</option>';
			}
		$html .= '</select>';
		
		echo $html;
	
	} // end create_a_select_input callback
	
	//add plugin action links logic
	function add_plugin_action_links( $links ) {
	 
		return array_merge(
			array(
				'settings' => '<a href="' . get_bloginfo( 'wpurl' ) . '/wp-admin/options-general.php?page='.$this->plugin_slug.'-setting-admin">Settings</a>'
			),
			$links
		);
	 
	}


	function load_tooltips() {
		if (!is_admin()) {
			wp_enqueue_script('simple_tooltips_base', plugins_url( 'zebra_tooltips.js' , __FILE__ ), array('jquery'), false, true);
			wp_enqueue_style('simple_tooltips_style', plugins_url( 'zebra_tooltips.css' , __FILE__ ));
			add_action('wp_footer', array($this, 'tooltip_data'), 100);
		}
	} 
	
	function tooltip_data() {
		?>
			<script type="text/javascript">
				jQuery(function() {
					new jQuery.Zebra_Tooltips(jQuery('.tooltips'), {
						'background_color':     '<?php echo get_option('simple_tooltips_background_color', '#000000') ?>',
						'color':				'<?php echo get_option('simple_tooltips_text_color', '#ffffff') ?>'
					});
				});
            </script>        
        <?php
	}
	
	public function plugin_row_links($links, $file) {
		$plugin = plugin_basename(__FILE__); 
		if ($file == $plugin) // only for this plugin
				return array_merge( $links,
			array( '<a target="_blank" href="http://www.linkedin.com/in/ClevelandWebDeveloper/">' . __('Find me on LinkedIn' ) . '</a>' ),
			array( '<a target="_blank" href="http://twitter.com/ClevelandWebDev">' . __('Follow me on Twitter') . '</a>' )
		);
		return $links;
	}
		
} //end class

$class = new simple_tooltips();
add_action('init', array($class, 'load_tooltips')); //loads on wordpress init

//add Settings link to plugin page
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array($class, 'add_plugin_action_links') );
