<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$woocommerce->show_messages(); ?>

<p class="myaccount_user">
	<?php
	/*
	printf(
		__( 'Hello, <strong>%s</strong>. From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">change your password</a>.', 'woocommerce' ),
		$current_user->display_name,
		get_permalink( woocommerce_get_page_id( 'change_password' ) )
	);
	*/
printf(
		__( 'Hello, <strong>%s</strong>.You are entered into your dashboard.', 'woocommerce' ),
		$current_user->display_name,
		get_permalink( woocommerce_get_page_id( 'change_password' ) )
	);
global $woocommerce;

$customer_orders = get_posts( array(
    'numberposts' => $order_count,
    'meta_key'    => '_customer_user',
    'meta_value'  => get_current_user_id(),
    'post_type'   => 'shop_order',
    'post_status' => 'publish'
) );
$direct=ABSPATH;
require_once($direct."/wp-content/plugins/woocommerce/classes/wooclass.php");
$woo_class=new Wooclass();
//$user_ID=wp_get_current_user();	
$user_ID=$current_user->ID;
//echo $user_ID;
global $wpdb;
$config = parse_ini_file("config.ini");
    	$course_url = $config["canvasurl"];
    	//echo $course_url;

    	//print_r($product);
    	//echo $current_user->ID;
//$user_ID=wp_get_current_user();	



if ( $customer_orders ) : ?>

	<h2><?php echo apply_filters( 'woocommerce_my_account_my_orders_title', __( 'My Course', 'woocommerce' ) ); ?></h2>

	<?php
		
			foreach ( $customer_orders as $customer_order ) {
				$order = new WC_Order();
					
				$order->populate( $customer_order );

				$status     = get_term_by( 'slug', 'completed', 'shop_order_status' );
				$item_count = $order->get_item_count();

				?><tr class="order">
					<?php
		if (sizeof($order->get_items())>0) {
			foreach($order->get_items() as $item) {
				$result=$woo_class->fused_has_user_bought($user_ID,$item['product_id']);
				if($result)
				{	
				$_product = get_product( $item['variation_id'] ? $item['variation_id'] : $item['product_id'] );
				$get_lmsid="select lms_id from wp_posts where ID=".$item['product_id'];

				$getlms=$wpdb->get_row($get_lmsid);
				$canvas_url= $course_url.'/courses/'.$getlms->lms_id .'/modules';
				echo '<h3>' .$item['name'].'</h3>';
					
					
					//$re1="select * from wp_postmeta where meta_key ='_wp_attached_file' and post_id=".$item['product_id'];
					//echo $re1;	
					//$getpost_img=$wpdb->get_row($re1);	
					//$img=$getpost_img->meta_value;
					//echo '<img src="'.$direct.'/wp-content/uploads/'.$img.'" width="200" height="250" alt="image" />'."<br/>";
					$get_post_content="select * from wp_posts where ID=".$item['product_id'];
					$getpost_content=$wpdb->get_row($get_post_content);	
					echo "<br/>".$getpost_content->post_content;
					?>
					<a href="<?php echo $canvas_url; ?>"  rel="nofollow" class="red_txt_normal button product_type_simple">Take This Course</a>
					<?php

				}
					//echo '<a href="'.$canvas_url.'">Take This Course</a>';

				/*			
				$item_meta = new WC_Order_Item_Meta( $item['item_meta'] );
				$item_meta->display();

				if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

					$download_file_urls = $order->get_downloadable_file_urls( $item['product_id'], $item['variation_id'], $item );

					$i     = 0;
					$links = array();

					foreach ( $download_file_urls as $file_url => $download_file_url ) {

						$filename = woocommerce_get_filename_from_url( $file_url );

						$links[] = '<small><a href="' . $download_file_url . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_file_urls ) > 1 ? ' ' . ( $i + 1 ) . ': ' : ': ' ) ) . $filename . '</a></small>';

						$i++;
					}

					echo implode( '<br/>', $links );
				}

				echo '</td><td class="product-total">' . $order->get_formatted_line_subtotal( $item ) . '</td></tr>';

				// Show any purchase notes
				if ($order->status=='completed' || $order->status=='processing') {
					if ($purchase_note = get_post_meta( $_product->id, '_purchase_note', true))
						echo '<tr class="product-purchase-note"><td colspan="3">' . apply_filters('the_content', $purchase_note) . '</td></tr>';
				}
				*/

			}
		}
?>

				
					
				<?php
			}
		?>
<div class="order-number">
	<h2>
<?php else:
//echo "No Orders";
?>
</h2>
</div>
<?php endif; ?>

</p>

<?php do_action( 'woocommerce_before_my_account' ); ?>

<?php woocommerce_get_template( 'myaccount/my-downloads.php' ); ?>

<?php woocommerce_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

<?php woocommerce_get_template( 'myaccount/my-address.php' ); ?>

<?php do_action( 'woocommerce_after_my_account' ); ?>