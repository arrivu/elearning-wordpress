<?php
/**
 * Review order form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

$available_methods = $woocommerce->shipping->get_available_shipping_methods();
?>
<div id="order_review">
<?php /* ?>
	<table class="shop_table">
		<thead>
			<tr>
				<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr class="cart-subtotal">
				<th><?php _e( 'Cart Subtotal', 'woocommerce' ); ?></th>
				<td><?php echo $woocommerce->cart->get_cart_subtotal(); ?></td>
			</tr>

			<?php if ( $woocommerce->cart->get_discounts_before_tax() ) : ?>

			<tr class="discount">
				<th><?php _e( 'Cart Discount', 'woocommerce' ); ?></th>
				<td>-<?php echo $woocommerce->cart->get_discounts_before_tax(); ?></td>
			</tr>

			<?php endif; ?>

			<?php if ( $woocommerce->cart->needs_shipping() && $woocommerce->cart->show_shipping() ) : ?>

				<?php do_action('woocommerce_review_order_before_shipping'); ?>

				<tr class="shipping">
					<th><?php _e( 'Shipping', 'woocommerce' ); ?></th>
					<td><?php woocommerce_get_template( 'cart/shipping-methods.php', array( 'available_methods' => $available_methods ) ); ?></td>
				</tr>

				<?php do_action('woocommerce_review_order_after_shipping'); ?>

			<?php endif; ?>

			<?php foreach ( $woocommerce->cart->get_fees() as $fee ) : ?>

				<tr class="fee fee-<?php echo $fee->id ?>">
					<th><?php echo $fee->name ?></th>
					<td><?php
						if ( $woocommerce->cart->tax_display_cart == 'excl' )
							echo woocommerce_price( $fee->amount );
						else
							echo woocommerce_price( $fee->amount + $fee->tax );
					?></td>
				</tr>

			<?php endforeach; ?>

			<?php
				// Show the tax row if showing prices exlcusive of tax only
				if ( $woocommerce->cart->tax_display_cart == 'excl' ) {
					foreach ( $woocommerce->cart->get_tax_totals() as $code => $tax ) {
						echo '<tr class="tax-rate tax-rate-' . $code . '">
							<th>' . $tax->label . '</th>
							<td>' . $tax->formatted_amount . '</td>
						</tr>';
					}
				}
			?>

			<?php if ( $woocommerce->cart->get_discounts_after_tax() ) : ?>

			<tr class="discount">
				<th><?php _e( 'Order Discount', 'woocommerce' ); ?></th>
				<td>-<?php echo $woocommerce->cart->get_discounts_after_tax(); ?></td>
			</tr>

			<?php endif; ?>

			<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

			<tr class="total">
				<th><strong><?php _e( 'Order Total', 'woocommerce' ); ?></strong></th>
				<td>
					<strong><?php echo $woocommerce->cart->get_total(); ?></strong>
					<?php
						// If prices are tax inclusive, show taxes here
						if ( $woocommerce->cart->tax_display_cart == 'incl' ) {
							$tax_string_array = array();

							foreach ( $woocommerce->cart->get_tax_totals() as $code => $tax ) {
								$tax_string_array[] = sprintf( '%s %s', $tax->formatted_amount, $tax->label );
							}

							if ( ! empty( $tax_string_array ) ) {
								?><small class="includes_tax"><?php printf( __( '(Includes %s)', 'woocommerce' ), implode( ', ', $tax_string_array ) ); ?></small><?php
							}
						}
					?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

		</tfoot>
		<tbody>
			<?php
				do_action( 'woocommerce_review_order_before_cart_contents' );

				if (sizeof($woocommerce->cart->get_cart())>0) :
					foreach ($woocommerce->cart->get_cart() as $cart_item_key => $values) :
						$_product = $values['data'];
						if ($_product->exists() && $values['quantity']>0) :
							echo '
								<tr class="' . esc_attr( apply_filters('woocommerce_checkout_table_item_class', 'checkout_table_item', $values, $cart_item_key ) ) . '">
									<td class="product-name">' .
										apply_filters( 'woocommerce_checkout_product_title', $_product->get_title(), $_product ) . ' ' .
										apply_filters( 'woocommerce_checkout_item_quantity', '<strong class="product-quantity">&times; ' . $values['quantity'] . '</strong>', $values, $cart_item_key ) .
										$woocommerce->cart->get_item_data( $values ) .
									'</td>
									<td class="product-total">' . apply_filters( 'woocommerce_checkout_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key ) . '</td>
								</tr>';
						endif;
					endforeach;
				endif;

				do_action( 'woocommerce_review_order_after_cart_contents' );
			?>
		</tbody>
	</table>
<?php */ ?>


<?php if ($woocommerce->cart->needs_payment()){
	
	$styleq='id="payment"';
}
else{
	$styleq="";
} ?>

	<div <?php echo $styleq; ?> >
		
		<div class="form place-order">

			<noscript><?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ); ?><br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php _e( 'Update totals', 'woocommerce' ); ?>" /></noscript>

			<?php $woocommerce->nonce_field('process_checkout')?>

			<?php do_action( 'woocommerce_review_order_before_submit' ); ?>
<?php if ($woocommerce->cart->needs_payment()) : ?>			
<div id="creditss">			
<p class="credit_head">Enter your credit card information in our secure payment form.</p>
<div class="credit_form">
<ul class="credit_container">
<li>
<div class="card_info">
<input type="text" class="credit" value="" placeholder="Credit Card Number" />
</div>
</li>

<li>
<div class="card_info">
 <SELECT NAME="CCExpiresMonth" class="credithalf combogrey	" style="float:left !important;width:150px !important;height:40px !important;margin: 0px 10px 0px 0px;" >
        <OPTION VALUE="" SELECTED>Month
        <OPTION VALUE="01">January (01)
        <OPTION VALUE="02">February (02)
        <OPTION VALUE="03">March (03)
        <OPTION VALUE="04">April (04)
        <OPTION VALUE="05">May (05)
        <OPTION VALUE="06">June (06)
        <OPTION VALUE="07">July (07)
        <OPTION VALUE="08">August (08)
        <OPTION VALUE="09">September (09)
        <OPTION VALUE="10">October (10)
        <OPTION VALUE="11">November (11)
        <OPTION VALUE="12">December (12)
      </SELECT> 
 <SELECT NAME="CCExpiresYear" class="credithalf combogrey	" style="float:left !important;width:150px !important;height:40px !important;margin: 0px 10px 0px 0px;">
        <OPTION VALUE="" SELECTED>Year
        <OPTION VALUE="04">2004
        <OPTION VALUE="05">2005
        <OPTION VALUE="06">2006
        <OPTION VALUE="07">2007
        <OPTION VALUE="08">2008
        <OPTION VALUE="09">2009
        <OPTION VALUE="10">2010
        <OPTION VALUE="11">2011
        <OPTION VALUE="12">2012
        <OPTION VALUE="13">2013
        <OPTION VALUE="14">2014
        <OPTION VALUE="15">2015
      </SELECT>
<input type="text" class="credithalf" value="" placeholder="Sce/CVV Code" style="float:left !important;width:110px !important;height:40px !important;"/>
</div>
</li>

</ul>

</div>

<div class="credit_right">
<img src="<?php echo get_site_url(); ?>/wp-content/plugins/woocommerce/assets/images/img_creditcard.png" />

</div>
</div>
</div>
<?php endif; ?>
<div class="clear"></div>
		
<p class="form-row terms" style="height:42px;font-size:19px;">
	<?php
			$order_button_text = apply_filters('woocommerce_order_button_text', __( 'Place order', 'woocommerce' ));

			echo apply_filters('woocommerce_order_button_html', '<input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="' . $order_button_text . '" />' );
			?>
</p>



			<?php if (woocommerce_get_page_id('terms')>0) : ?>
			<p class="form-row terms">
				<label for="terms" class="checkbox"><?php _e( 'I have read and accept the', 'woocommerce' ); ?> <a href="<?php echo esc_url( get_permalink(woocommerce_get_page_id('terms')) ); ?>" target="_blank"><?php _e( 'terms &amp; conditions', 'woocommerce' ); ?></a></label>
				<input type="checkbox" class="input-checkbox" name="terms" <?php checked( isset( $_POST['terms'] ), true ); ?> id="terms" />
			</p>
			<?php endif; ?>

			<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		</div>

		<div class="clear"></div>

	</div>

</div>
