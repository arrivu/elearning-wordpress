<?php
/*
 * Plugin Name: 	Featured Users
 * Plugin URI: 		http://www.reactivedevelopment.net/featured-users
 * Description: 	Adds the ability to set using jQuery a user's custom meta filed called "jsfeatured_user". 
 * Version: 		1.0
 * Author:        	Reactive Development LLC
 * Author URI:   	http://www.reactivedevelopment.net/
 *
 * License:       	GNU General Public License, v2 (or newer)
 * License URI:  	http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * This program was modified from MaxBlogPress Favicon plugin, version 2.2.5, 
 * Copyright (C) 2007 www.maxblogpress.com, released under the GNU General Public License.
 *
 * Image Credit:
 * Star image is from: http://www.iconfinder.com/icondetails/9662/24/bookmark_star_icon and http://www.iconfinder.com/icondetails/9604/24/star_icon
*/
	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/// when we activate the plugin do this		
		
		function install_js_featured_user() {			
			$currentJSoption = unserialize( get_option( "jsFeaturedUser" ) );			
			if ( empty( $currentJSoption ) ){				
				$js_featured_user_option = array( "installed" => "yes", "featuredUsers" => array( ) );
				add_option( "jsFeaturedUser", serialize( $js_featured_user_option ), '', 'yes' ); } 
		} register_activation_hook(__FILE__,'install_js_featured_user');
		
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/// plugin code below
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// add check box option to all users edit and view pages
		
			function add_jsfeatured_checkBox_to_profile( $user ){
				
				// get both this users meta and the main option to see if this user is featured
				$thisUsersID 			= $user->ID;
				$currentJSoption 		= unserialize( get_option( "jsFeaturedUser" ) );
				$thisUsersFeaturedMeta 	= get_user_meta( $thisUsersID, "jsIs_user_featured", true );
				
				$isTheUserFeatured 		= false;
				// first step: check plugin option
				if ( !empty( $currentJSoption["featuredUsers"] ) ){ 			
					foreach( $currentJSoption["featuredUsers"] as $featuredUser ){				
						if ( (int)$featuredUser == $thisUsersID ){ $isTheUserFeatured = true; } } }
				
				// second step: check user meta
				if( $thisUsersFeaturedMeta == "yes" && $isTheUserFeatured == true ){ $isTheUserFeatured = true; }
				
				?>
				
				<h3>Featured Setting</h3>
				
                <?
                	/*
                   echo "<strong>Users Meta</strong><br />";
					echo "value: " . $thisUsersFeaturedMeta . "<br /><br />";
					
					echo "<strong>jsFeaturedUser Option | ".sizeof( $currentJSoption["featuredUsers"] )."</strong><br />";
					
					echo "<pre>";
					print_r( $currentJSoption );
					echo "</pre>";
					*/ ?>
                
				<table class="form-table">
			
					<tr>
						<td>
							<input id="jsIs_user_featured" name="jsIs_user_featured" type="checkbox" value="yes"<? if ( $isTheUserFeatured == true ){ ?> checked="checked"<? } ?>>
							Check if Featured (<span class="description">Checked == This user is featured</span>)
						</td>
					</tr>
			
				</table><br />
				
				<?
				
			} add_action( 'show_user_profile', 'add_jsfeatured_checkBox_to_profile' );
			  add_action( 'edit_user_profile', 'add_jsfeatured_checkBox_to_profile' );
			  
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// add function that updates users meta
		
			function save_jsfeatured( $user_id, $setMetaTo, $redirect ){
				update_usermeta( $user_id, 'jsIs_user_featured', $setMetaTo );					
				// update the plugin option
				$isTheUserFeatured = false;
				$currentJSoption = unserialize( get_option( "jsFeaturedUser" ) );
				$newFeaturesUserOption = array();
				// check to see if option is empty in not
				$daArryI=0;
				if ( sizeof( $currentJSoption["featuredUsers"] ) > 0 ){ 					
					for( $usersI=0; $usersI < sizeof( $currentJSoption["featuredUsers"] ); $usersI++  ){					
						// if featuredUser = this user then add him
						if ( (int)$currentJSoption["featuredUsers"][$usersI] == $user_id ){							
							//if we need to add him them add him
							if ( $setMetaTo == "yes" ){ $newFeaturesUserOption[$daArryI] = $user_id; $daArryI++; } }
						else { if ( $setMetaTo == "yes" ){ $newFeaturesUserOption[$daArryI] = $user_id; $daArryI++; }
							$newFeaturesUserOption[$daArryI] = $currentJSoption["featuredUsers"][$usersI]; $daArryI++; } }
					// remove duplicates if present	
					$currentJSoption["featuredUsers"] = array_unique( $newFeaturesUserOption );
					// update the option with the new array
					update_option( "jsFeaturedUser", serialize( $currentJSoption ) ); }					
				// the array is empty so add user if needed
				else { if ( $setMetaTo == "yes" ){ $newFeaturesUserOption[0] = $user_id; 
					// update the option with the new array
					$currentJSoption["featuredUsers"] = array_unique( $newFeaturesUserOption ); 
					// update the option with the new array
					update_option( "jsFeaturedUser", serialize( $currentJSoption ) ); } }				
			}
			
			function save_jsfeatured_checkBox_in_profile( $user_id ){			
				if ( !current_user_can( 'edit_user', $user_id ) ){ return false; }
				// update this users meta
				if ( isset( $_POST['jsIs_user_featured'] ) && $_POST['jsIs_user_featured'] == "yes" ){ $setMetaTo = "yes"; } 
				else { $setMetaTo = ""; } save_jsfeatured( $user_id, $setMetaTo, false );				
			} add_action( 'personal_options_update', 'save_jsfeatured_checkBox_in_profile' );
			  add_action( 'edit_user_profile_update', 'save_jsfeatured_checkBox_in_profile' );
			  
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// add featured colum to users table functions(2)
			
			// add column to users table
			function jsfeatured_add_users_column( $columns ){			
				$columns['featured_user'] = 'Featured'; return $columns;				
			} add_filter('manage_users_columns', 'jsfeatured_add_users_column');
			
			// add this rows content for the new column
			function jsfeatured_manage_users_column( $empty, $column_name, $user_id ){
				if( $column_name == 'featured_user' ) {	
					$changeStat = true; $stat = "enable"; $class = "";
					// get current user stat
					$currentJSoption 		= unserialize( get_option( "jsFeaturedUser" ) );
					$thisUsersFeaturedMeta 	= get_user_meta( $user_id, "jsIs_user_featured", true );					
					for( $usersI=0; $usersI < sizeof( $currentJSoption["featuredUsers"] ); $usersI++  ){
						if ( (int)$currentJSoption["featuredUsers"][$usersI] == $user_id ){ $changeStat = false; } }
					if ( $thisUsersFeaturedMeta == "yes" && $changeStat == false ){ $stat = "disable"; $class = " selected"; }					
					return  '<a id="userFeatured_'.$user_id.'" href="'.get_bloginfo( "url" ).'/wp-admin/users.php?page=jsAddToFeatured&'.
							'featuredUser='.$user_id.'&stat='.$stat.'" class="featuredStar'.$class.'"></a>'; }					
			} add_filter('manage_users_custom_column', 'jsfeatured_manage_users_column', 10, 3);		
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// add page under users for us to post to
			
			function save_jsfeatured_star_in_users_list(){
				
				$screen = $_GET['page'];
				$isAjax = $_GET['ajax'];
				
				$featuredUser = (int)$_GET['featuredUser']; // get url param
				$featuredStep = $_GET['stat']; // get url param for direction
				
				// if we have all values save the setting now	
				if ( $screen == "jsAddToFeatured" && !empty( $featuredUser ) && !empty( $featuredStep ) ){
				
					if( $featuredStep == "enable" ){ save_jsfeatured( $featuredUser, "yes", true ); }
					else if ( $featuredStep == "disable" ) { save_jsfeatured( $featuredUser, "", true ); }
					
					if ( $isAjax == "yes" ){ echo $featuredStep; exit;  }
					else{ wp_redirect( $_SERVER['HTTP_REFERER'] ); exit; }
					
				}
							
			} add_action( 'admin_init', 'save_jsfeatured_star_in_users_list' );
			
			function jsfeatured_add_page_to_post_too(){ /* noting needed here yet */ }
			
			function jsfeatured_add_to_admin_menu() {
				//add_users_page('Featured Users', 'Featured Users', 'administrator', 'jsAddToFeatured', 'jsfeatured_add_page_to_post_too');
				add_users_page('', '', 'administrator', 'jsAddToFeatured', 'jsfeatured_add_page_to_post_too');
			} add_action('admin_menu', 'jsfeatured_add_to_admin_menu');
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// add jquery functions to admin head for users table
		
			function jsfeatured_add_jquery_to_head(){
			
			?>
					
				<script type="text/javascript" language="javascript">				
					jQuery(document).ready(function(){						
						function change_star( data, daID ){	
							if ( data == "disable" ){ 							
								jQuery(daID).removeClass("selected");
								var thisURL = jQuery(daID).attr("href");
									thisURL = thisURL.split("stat");								
								var newURL  = thisURL[0] + "stat=enable";
									jQuery(daID).attr("href", newURL); }								
							else if ( data == "enable" ){ 							
								jQuery(daID).addClass("selected"); 
								var thisURL = jQuery(daID).attr("href");
									thisURL = thisURL.split("stat");									
								var newURL  = thisURL[0] + "stat=disable";
									jQuery(daID).attr("href", newURL); } }						
						jQuery('.featuredStar').click(function() {	
							var thisID = "#" + jQuery(this).attr("id");
							var thisFeaturedURL = jQuery(this).attr("href") + "&ajax=yes";
							jQuery.get(thisFeaturedURL, function(data) { change_star( data.trim(), thisID ); }); return false;							
						}); });				
				</script>
					
			<?
				
			} add_action( 'admin_head', 'jsfeatured_add_jquery_to_head' );
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		// add css to admin head for users table
		
			function jsfeatured_add_css_to_head(){
			
				$imgSrc = plugins_url( 'img/star.png' , __FILE__ );
			
			?>
					
				<style type="text/css">
                	
					#featured_user{ text-align:center; }
                    .featuredStar{ display:block; height:24px; width:24px; margin:0 auto 0 auto; border:none; background-color:transparent; 
						background-image:url(<? echo $imgSrc; ?>); background-repeat:no-repeat; background-position:0 -24px; cursor:pointer; }
                    .featuredStar.selected, #featuredStar:active{ background-position:0 0; }
                
                </style>
					
			<?
				
			} add_action( 'admin_head', 'jsfeatured_add_css_to_head' );
		
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/// when we deactivate the plugin do this 
		
		function remove_js_featured_user() { delete_option('jsFeaturedUser');  } 
		register_deactivation_hook( __FILE__, 'remove_js_featured_user' );
	
	/// end function code
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>