<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( ! $woocommerce->cart->coupons_enabled() )
	return;

//$info_message = apply_filters('woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ));
?>

<?php /* ?><p class="woocommerce-info"><?php echo $info_message; ?> <a href="#" class="showcoupon"><?php _e( 'Click here to enter your code', 'woocommerce' ); ?></a></p><?php */ ?>
<br/>

<h1 class="about_compelling" style="text-align:center; color: #d03423;">You're only one minute away from enrolling!</h1>				
<form method="post" class="checkout">
<h3>Course selection - Choose two or more courses for a discount</h3>
<h2>Payment options ($USD)</h2>
<div style="float:left;width:500px;border-right-width:1px;border-right-style:solid;border-right-color:lightgrey;">
	<div style="float:left">
	<input type="checkbox" name="period" value="1">7 Day Trial?<br>
	<input type="checkbox" name="period" value="2">Full Payment?<br>
	<input type="checkbox" name="period" value="3">Installments?<br>
	</div>
	<div style="float:right;width:200px;">
		<p>Save $25 per course when you pay in full.<span style="color:red;">No trail period.</span>You will not be allowed to cancel your account.</p>
	</div>
	<p class="form-row form-row-first">
		<input type="text" name="coupon_code" class="input-text" style="width:120px;" placeholder="<?php _e( 'Promo code', 'woocommerce' ); ?>" id="coupon_code" value="" />
		<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Use Promo', 'woocommerce' ); ?>" />
	</p>
</div>
	<div class="clear"></div>
</form>
<br/>
	
