<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>
<?php if ($woocommerce->cart->needs_payment()) : ?>
<?php if ( $woocommerce->cart->ship_to_billing_address_only() && $woocommerce->cart->needs_shipping() ) : ?>


<?php else : ?>

	

<?php endif; ?>

<?php do_action('woocommerce_before_checkout_billing_form', $checkout ); ?>

<?php foreach ($checkout->checkout_fields['billing'] as $key => $field) : ?>

	<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

<?php endforeach; ?>

<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>


<?php endif; ?>
