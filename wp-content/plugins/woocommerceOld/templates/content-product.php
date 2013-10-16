<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;
//echo "hiiiii".$woocommerce_loop['loop'];
if($woocommerce_loop['loop']=="1")
{
	echo "<br/><br/>";	
}
// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
{
	
	$classes[] = 'first';
}	
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>

<li class="list_item grey_border clearfix">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	<div class="title">

		<h1 id="<?php the_title(); ?>"><?php the_title(); ?></h1>

		<h1 class="price"><?php
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		?></h1>
	</div>
	<div class="content">
	<div class="cb"></div>
	<div class="column1">
	
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
	
			
	</div>	
	<div class="column2">
	<div class="pdtdes_dis"><div class="show"><?php the_excerpt(); ?></div><a href="javascript:;" class="red_txt_normal td_n">Find out more..</a>
	<div class="pdtdes_hdn"><div class="cb"></div><?php the_content(); ?><a class="grey_txt_normal" href="javascript:;">Back Scroll Up</a></div>
	</div>
	
	</div>
	</div>
	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</li>