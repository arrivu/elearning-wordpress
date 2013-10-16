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

$woocommerce->show_messages(); 
//print_r($courses);
	$config = parse_ini_file("config.ini");
    	$url = $config["casurl"];
    	//echo $url;
    	$cookie_set_url = $config["cookieurl"];

	$data = array('username'=> 'testme@gmail.com','password'=> '$P$BeyKKgqcQCjY28XqSvdamJFpi36l3M/');
      	$handle = curl_init();
      	curl_setopt($handle, CURLOPT_URL, $url);
      	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
      	curl_setopt($handle, CURLOPT_POST, true);
      	curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
      	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
      	$response = json_decode(curl_exec($handle),TRUE);
    	print_r($response);
    	//echo $response['type'];
    	if($response['type']=="confirmation"){
	    	//echo "hiiii";
	      setcookie("tgt",$response['tgt'],time()+3600*24,'/',$cookie_set_url);
	      
	    }


?>

<p class="myaccount_user">
	<?php
	/*printf(
		__( 'Hello, <strong>%s</strong>. From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">change your password</a>.', 'woocommerce' ),
		$current_user->display_name,
		get_permalink( woocommerce_get_page_id( 'change_password' ) )
	);
	*/

	printf(
		__( 'Hello, <strong>%s</strong>. ', 'woocommerce' ),
		$current_user->display_name,
		get_permalink( woocommerce_get_page_id( 'change_password' ) )
	);
	?>
</p>

<?php do_action( 'woocommerce_before_my_account' ); ?>

<?php woocommerce_get_template( 'myaccount/my-downloads.php' ); ?>

<?php woocommerce_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

<?php woocommerce_get_template( 'myaccount/my-address.php' ); ?>

<?php do_action( 'woocommerce_after_my_account' ); ?>