<script type='text/javascript' src='<?php echo get_site_url(); ?>/jquery.min.js'></script> 
<script type='text/javascript' src='<?php echo get_site_url(); ?>/jquery-ui.min.js'></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>

<script language="javascript" type="text/javascript">

//jQuery(document).ready(function($) {

//  if (window.history && window.history.pushState) {

   // window.history.pushState('forward', null, './#forward');

//    $(window).on('popstate', function() {
      
 //   });
<?php 
//global $woocommerce;

//		$woocommerce->cart->empty_cart(); 
//	?>
 // }
//});

// $(document).ready(function (e) {
//   alert('hi');
 
//  window.history.back = function () {
//    window.location.replace('http://www.google.com');
//    return "This session is expired and the history altered.";
// }
  
//});
/*
$(document).ready(function () {

    if(window.event){

              if (window.event.clientX < 40 && window.event.clientY < 0) { 

                  alert("back button is clicked");    

              }else{

                  alert("refresh button is clicked");
              }

    }else{

        if (event.currentTarget.performance.navigation.type == 2) { 

            alert("back button is clicked");    

        }
        if (event.currentTarget.performance.navigation.type == 1){

            alert("refresh button is clicked");
         }             
    }
});
*/
// $(document).ready(function () {
// 	var url = document.referrer;
//  alert(url);
 

// });
</script>
<?php

/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$woocommerce->show_messages();
//$woocommerce->cart->empty_cart();
//echo "Items in cart: ".sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);
//echo "<br />";
//echo "Total: ".$woocommerce->cart->get_cart_total();
//do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}
//$woocommerce->cart->empty_cart();

//$ss=get_the_ID();
//echo "hiiiiiiii".$ss;
// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', $woocommerce->cart->get_checkout_url() ); ?>
<br/>
<script> 
jQuery(document).ready(function() { 
    
    $("input:radio[name=payment_method]").click(function() {	
    var payment;
	var value = $(this).val();
	
	if(value=="mijireh_checkout")
   {  
   	//alert(value); 
   $("#billenable").show();     
   $("#creditss").show();
   }
   else
   {  
   	//alert(value);
   $("#billenable").hide(); 
   $("#creditss").hide();   
   }	
    //$("#billenable").hide();
  });
  
  /*
    jQuery('#payment_method').live(function (event) {
	
	var payment;
	payment=jQuery("#payment_method:checked").val();
	if(payment=="mijireh_checkout")
   {  
   	
   jQuery("#billenable").show();         
   }
   elseif(payment=="paypal")
   {  
   	
   jQuery("#billenable").hide();    
   }
  
});
*/
});



$('#course_duration').live('change', function(e){
  
   var ss;
   ss=$("#price_code").val();
   //alert(ss);
   if($("#course_duration:checked").val()=="1")
   {
   //alert("hi");
   $("#price_code").val('25');      
   //$('#price_code').Text()="25";
   }
   elseif($("#course_duration:checked").val()=="2")
   {
   
   }
   alert($('#price_code').val());
   });
</script>
<h1 class="about_compelling" style="text-align:center; color: #d03423;">You're only one minute away from enrolling!</h1>				
<form method="post" class="checkout">
<?php global $woocommerce;
//print_r($woocommerce);
 ?>	
 
<div class="row_black_wrapper overflow_fix clearfix">
<div class="row_inner clearfix" >
<div class="row_grey ">
<img src="<?php echo get_site_url(); ?>/wp-content/plugins/woocommerce/assets/images/ico_one.png" class="img_numbers" />
<div class="course_head">
<span class="grey18">
Course selection - You can promo code to discount<br>
Payment Options ($USD)
</span>
</div>
<div class="clearfix"></div>
<div class="course_select">
<div class="promo_txt" style="background:transparent;border:0px;margin-top:16px;"><input type="text" name="coupon_code" style="width: 250px;height: 22px;color: #afafaf;font: normal 16px Arial,Helvetica, sans-serif;background: #666666;border: 1px solid #999999;clear: both;padding: 4px 0 0 3px;" placeholder="<?php _e( 'Promo code', 'woocommerce' ); ?>" id="coupon_code" value="" /></div>
<input type="submit" class="button" style="margin: -21px 25px 0 0px;float:right;" name="apply_coupon" value="<?php _e( 'Use Promo', 'woocommerce' ); ?>" />
</div>
<div class="slider"></div>
<div class="price_det">
<?php
if (sizeof($woocommerce->cart->get_cart())>0) :
foreach ($woocommerce->cart->get_cart() as $item_id => $values) :
$_product = $values['data'];
if ($_product->exists() && $values['quantity']>0) :
echo '<p style="font-weight:bold;">'.$_product->get_title().$woocommerce->cart->get_item_data( $values ).'</p>
<p><span>List price</span> <span>'. apply_filters( 'woocommerce_checkout_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $item_id ) .'</span></p>
<p><span class="white">Multi Discount</span><span class="white">   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $0.00</span></p>
<p style="border-top:1px solid #666666; padding-top:10px;"><span class="white"><strong>Total</strong></span><span class="white"><strong>'.$woocommerce->cart->get_cart_total().'</strong></span></p>
<p><span class="white">Due Today</span><span class="white">'.$woocommerce->cart->get_cart_total().'</span></p>	
';
endif;
endforeach;
endif;
//do_action( 'woocommerce_cart_contents_review_order' );
			?>	


</div>
</div>
</div>
</div>	
<?php /* ?>
<h3>Course selection - Choose two or more courses for a discount</h3>
<h2>Payment options ($USD)</h2>
<div style="float:left;width:500px;border-right-width:1px;border-right-style:solid;border-right-color:lightgrey;">
	<div style="float:left">
	<input type="radio" name="course_duration" value="1" id="course_duration" />7 Day Trial?<br>
	<input type="radio" name="course_duration" value="2" id="course_duration" />Full Payment?<br>
	<input type="radio" name="course_duration" value="3" id="course_duration" />Installments?<br>
	</div>
	<div style="float:right;width:200px;">
		<p>Save $25 per course when you pay in full.<span style="color:red;">No trail period.</span>You will not be allowed to cancel your account.</p>
	</div>
	<p class="form-row form-row-first">
		<input type="text" name="coupon_code" class="input-text" style="width:120px;" placeholder="<?php _e( 'Promo code', 'woocommerce' ); ?>" id="coupon_code" value="" />
		<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Use Promo', 'woocommerce' ); ?>" />
	</p>
</div>
<div style="float:right;width:300px;">
		<?php
    
		if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {
			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
			if($values['product_id']==$_GET['courseid'])
			{
				$_product = $values['data'];
				if ( $_product->exists() && $values['quantity'] > 0 ) {
					?>
					
					
					
						<td class="product-thumbnail">
							<?php
								$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );

								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo $thumbnail;
								else
									printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
							?>
						</td>
            
						<!-- Product Name -->
					
							<?php echo "Course:";
								if ( ! $_product->is_visible() || ( ! empty( $_product->variation_id ) && ! $_product->parent_is_visible() ) )
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
								else
									//printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );
									echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );

								// Meta data
								echo $woocommerce->cart->get_item_data( $values );
                echo "<br/>";
                   				// Backorder notification
                   				//if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
                   					//echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
							?>
					

						<!-- Product price -->
						
							<?php
								$product_price = get_option('woocommerce_tax_display_cart') == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();
                //$sessionuser = $this->session->userdata('courseid'); 
                //$this->session->set_userdata('courseid',$product_price);
								echo "Total:$";
							?>
			<p class="form-row" style="width:50px;height:10px;"> 				
			<input type="text" name="price_code" class="input-text" id="price_code" value="<?php echo $product_price; ?>" readonly />
			</p>
			<span><?php //echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key ); ?></span>
					<?php
				}
				}
			}
		}

		
		?>

	</div>
<?php */ ?>
	<div class="clear"></div>
</form>
<br/>

<form name="checkout" method="post" class="checkout" action="<?php echo esc_url( $get_checkout_url ); ?>">
	<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>
	<img src="<?php echo get_site_url(); ?>/wp-content/plugins/woocommerce/assets/images/ico_two.png" class="img_numbers" />
	<div class="course_head">
	<span class="grey18">
	Your Basic Information</span>
	</div>
<div style="background-color:black !important;">
	

	<?php if ( $checkout->enable_guest_checkout ) : ?>

		<p class="form-row form-row-wide">
			<input class="input-checkbox" id="createaccount" <?php checked($checkout->get_value('createaccount'), true) ?> type="checkbox" name="createaccount" value="1" /> <label for="createaccount" class="checkbox"><?php _e( 'Create an account?', 'woocommerce' ); ?></label>
		</p>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

	<div class="create-account" style="background-color:#333333;">

		

		<?php foreach ($checkout->checkout_fields['account'] as $key => $field) : ?>

			<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

		<?php endforeach; ?>

		<div class="clear"></div>

	</div>

	<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
</div>
<?php endif; ?>
<?php if ($woocommerce->cart->needs_payment()) : ?>
<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>
<img src="<?php echo get_site_url(); ?>/wp-content/plugins/woocommerce/assets/images/ico_three.png" class="img_numbers" />
<?php else: ?>
	<img src="<?php echo get_site_url(); ?>/wp-content/plugins/woocommerce/assets/images/ico_two.png" class="img_numbers" />
<?php endif; ?>

	<div class="course_head">
	<span class="grey18">
	Billing information</span>
	</div>
	<?php endif; ?>
	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>
		
		<?php if ($woocommerce->cart->needs_payment()) : ?>
		
			<?php
				$available_gateways = $woocommerce->payment_gateways->get_available_payment_gateways();
				if ( ! empty( $available_gateways ) ) {

					// Chosen Method
					if ( isset( $woocommerce->session->chosen_payment_method ) && isset( $available_gateways[ $woocommerce->session->chosen_payment_method ] ) ) {
						$available_gateways[ $woocommerce->session->chosen_payment_method ]->set_current();
					} elseif ( isset( $available_gateways[ get_option( 'woocommerce_default_gateway' ) ] ) ) {
						$available_gateways[ get_option( 'woocommerce_default_gateway' ) ]->set_current();
					} else {
						current( $available_gateways )->set_current();
					}

					foreach ( $available_gateways as $gateway ) {
						?>
						
							<input type="radio" id="payment_method" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> />
							<label for="payment_method_<?php echo $gateway->id; ?>"><?php echo $gateway->get_title(); ?> <?php //echo $gateway->get_icon(); ?></label>
							<?php
								if ( $gateway->has_fields() || $gateway->get_description() ) :
									//echo '<div class="payment_box payment_method_' . $gateway->id . '" ' . ( $gateway->chosen ? '' : 'style="display:none;"' ) . '>';
									//$gateway->payment_fields();
									//echo '</div>';
								endif;
							?>
						
						<?php
					}
				} else {

					if ( ! $woocommerce->customer->get_country() )
						echo '<p>' . __( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) . '</p>';
					else
						echo '<p>' . __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) . '</p>';

				}
			?>
		
		<?php endif; ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
		<div id="billenable">
		<div class="col2-set" id="customer_details">

	
			
	
			<div class="col-1">

				<?php do_action( 'woocommerce_checkout_billing' ); ?>

			</div>
			</div>	
			<div class="col-2">
			<?php do_action( 'woocommerce_checkout_shipping' ); ?>

				

			

		</div>
		</div>
		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php /* ?><h3 id="order_review_heading"><?php _e( 'Your order', 'woocommerce' ); ?></h3><?php */ ?>
<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	<?php endif; ?>

	

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>