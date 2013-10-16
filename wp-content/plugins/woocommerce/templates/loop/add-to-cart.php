<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
global $wpdb;
global $woocommerce;
$woocommerce->cart->empty_cart();
?>
<?php
		$config = parse_ini_file("config.ini");
    	$course_url = $config["canvasurl"];
    	//echo $course_url;

    	//print_r($product);
$user_ID=wp_get_current_user();	
$woo_class=new Wooclass();
$result=$woo_class->fused_has_user_bought($user_ID->ID,$product->id);
$get_lmsid="select lms_id from wp_posts where ID=".$product->id;

$getlms=$wpdb->get_row($get_lmsid);
	//echo $getlms->lms_id;
if ( ! $product->is_in_stock() && !$result ) : ?>

	<a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ); ?>" class="button"><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Read More', 'woocommerce' ) ); ?></a>

<?php else : ?>

	<?php
		$link = array(
			'url'   => '',
			'label' => '',
			'class' => ''
		);

		$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );
		//echo $handler;
		switch ( $handler ) {
			case "variable" :
				$link['url'] 	= apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
				$link['label'] 	= apply_filters( 'variable_add_to_cart_text', __( 'Select options', 'woocommerce' ) );
			break;
			case "grouped" :
				$link['url'] 	= apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
				$link['label'] 	= apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'woocommerce' ) );
			break;
			case "external" :
				$link['url'] 	= apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
				//$link['label'] 	= apply_filters( 'external_add_to_cart_text', __( 'Read More', 'woocommerce' ) );
			break;
			default :
				if ( $product->is_purchasable() && !$result ) {
						$link['url'] 	= apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
						//$link['url'] 	= apply_filters( 'add_to_cart_url', esc_url('http://wordpress.com/rails/?page_id=6') );
						
						//$link['url'] 	= apply_filters( 'add_to_cart_url', esc_url($woocommerce->cart->get_checkout_url()) );
						$link['label'] 	= apply_filters( 'add_to_cart_text', __( 'Enroll This Course', 'woocommerce' ) );
						$link['class']  = apply_filters( 'add_to_cart_class', 'red_txt_normal' );
					
						
				}else{
					$link['url'] 	= apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
					//$link['label'] 	= apply_filters( 'not_purchasable_text', __( 'Read More', 'woocommerce' ) );
				}
				if($result)
				{

						$canvas_url= $course_url.'/courses/'.$getlms->lms_id .'/modules';
						$link['url'] 	= apply_filters( 'add_to_cart_url', esc_url($canvas_url) );
						$link['label'] 	= apply_filters( 'add_to_car', __( 'Take This Course', 'woocommerce' ) );
						$link['class']  = apply_filters( 'add_to_cart_class', 'red_txt_normal' );
				}	
			break;
		}

		echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="%s button product_type_%s">%s</a>', esc_url( $link['url'] ), esc_attr( $product->id ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_attr( $product->product_type ), esc_html( $link['label'] ) ), $product, $link );

	?>

<?php endif; ?>

