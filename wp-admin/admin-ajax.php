<?php
/**
 * WordPress AJAX Process Execution.
 *
 * @package WordPress
 * @subpackage Administration
 *
 * @link http://codex.wordpress.org/AJAX_in_Plugins
 */

/**
 * Executing AJAX process.
 *
 * @since 2.1.0
 */
define( 'DOING_AJAX', true );
define( 'WP_ADMIN', true );

/** Load WordPress Bootstrap */
require_once( dirname( dirname( __FILE__ ) ) . '/wp-load.php' );

/** Allow for cross-domain requests (from the frontend). */
send_origin_headers();

// Require an action parameter
if ( empty( $_REQUEST['action'] ) )
	die( '0' );

/** Load WordPress Administration APIs */
require_once( ABSPATH . 'wp-admin/includes/admin.php' );

/** Load Ajax Handlers for WordPress Core */
require_once( ABSPATH . 'wp-admin/includes/ajax-actions.php' );

@header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
@header( 'X-Robots-Tag: noindex' );

send_nosniff_header();
nocache_headers();

do_action( 'admin_init' );

$core_actions_get = array(
	'fetch-list', 'ajax-tag-search', 'wp-compression-test', 'imgedit-preview', 'oembed-cache',
	'autocomplete-user', 'dashboard-widgets', 'logged-in',
);

$core_actions_post = array(
	'oembed-cache', 'image-editor', 'delete-comment', 'delete-tag', 'delete-link',
	'delete-meta', 'delete-post', 'trash-post', 'untrash-post', 'delete-page', 'dim-comment',
	'add-link-category', 'add-tag', 'get-tagcloud', 'get-comments', 'replyto-comment',
	'edit-comment', 'add-menu-item', 'add-meta', 'add-user', 'autosave', 'closed-postboxes',
	'hidden-columns', 'update-welcome-panel', 'menu-get-metabox', 'wp-link-ajax',
	'menu-locations-save', 'menu-quick-search', 'meta-box-order', 'get-permalink',
	'sample-permalink', 'inline-save', 'inline-save-tax', 'find_posts', 'widgets-order',
	'save-widget', 'set-post-thumbnail', 'date_format', 'time_format', 'wp-fullscreen-save-post',
	'wp-remove-post-lock', 'dismiss-wp-pointer', 'upload-attachment', 'get-attachment',
	'query-attachments', 'save-attachment', 'save-attachment-compat', 'send-link-to-editor',
	'send-attachment-to-editor', 'save-attachment-order', 'heartbeat', 'get-revision-diffs',
);

// Register core Ajax calls.

//echo "hiiiiiii".$post_id;
//exit();
if ($_GET['action']=="woocommerce-mark-order-complete")
{
$direct=ABSPATH;
global $wpdb;
require_once($direct."/course.php");
$course=new Course();	
$order_item_id="select order_item_id from wp_woocommerce_order_items where order_id=".$_GET['order_id'];
$get_order_item_id=$wpdb->get_row($order_item_id);	

$product_ids="select meta_value from wp_woocommerce_order_itemmeta where meta_key='_product_id' and order_item_id=".$get_order_item_id->order_item_id;

$get_product_ids=$wpdb->get_row($product_ids);

$get_lmsid="select lms_id from wp_posts where ID=".$get_product_ids->meta_value;
$getlms=$wpdb->get_row($get_lmsid);
$get_userlmsid="select user_lms from wp_users where ID=".$_GET['user_id'];
$get_userlms=$wpdb->get_row($get_userlmsid);
$courses=$course->enroll_user($getlms->lms_id,$get_userlms->user_lms);
//echo "hiiiiiiiiiiiiii".$getlms->lms_id."----".$get_userlms->user_lms;
//print_r($courses);
//exit();
}
if ( ! empty( $_GET['action'] ) && in_array( $_GET['action'], $core_actions_get ) )
	add_action( 'wp_ajax_' . $_GET['action'], 'wp_ajax_' . str_replace( '-', '_', $_GET['action'] ), 1 );

if ( ! empty( $_POST['action'] ) && in_array( $_POST['action'], $core_actions_post ) )
	add_action( 'wp_ajax_' . $_POST['action'], 'wp_ajax_' . str_replace( '-', '_', $_POST['action'] ), 1 );

add_action( 'wp_ajax_nopriv_heartbeat', 'wp_ajax_nopriv_heartbeat', 1 );

if ( is_user_logged_in() )
	do_action( 'wp_ajax_' . $_REQUEST['action'] ); // Authenticated actions
else
	do_action( 'wp_ajax_nopriv_' . $_REQUEST['action'] ); // Non-admin actions

// Default status
die( '0' );
