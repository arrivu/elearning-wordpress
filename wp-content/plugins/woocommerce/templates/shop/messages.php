<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
$string = get_permalink();
$checkout = strpos($string, "checkout");
?>

<?php foreach ( $messages as $message ) : ?>
<?php 	
if ($checkout == true)
{
?>
	
	<?php }
else
{
	?>
		<div class="woocommerce-message"><?php echo wp_kses_post( $message ); ?></div>
	<?php
}
	?>
<?php endforeach; ?>
