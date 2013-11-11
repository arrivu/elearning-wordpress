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

				//print_r($post);
				$seturl=get_site_url();
			$instr=get_user_meta($post->instructor_type, 'first_name', true);	
			$duration_time=$post->duration;
			if($duration_time=="7")
				$duration="1 Week";
			elseif($duration_time=="14")
				$duration="2 Weeks";
			elseif($duration_time=="21")
				$duration="3 Weeks";
			elseif($duration_time=="1")
				$duration="1 Month";
			elseif($duration_time=="2")
				$duration="2 Months";
			elseif($duration_time=="3")
				$duration="3 Months";
			elseif($duration_time=="4")
				$duration="4 Months";
			elseif($duration_time=="5")
				$duration="5 Months";
			elseif($duration_time=="6")
				$duration="6 Months";
			elseif($duration_time=="12")
				$duration="1 Year";
			elseif($duration_time=="24")
				$duration="2 Years";
			elseif($duration_time=="36")
				$duration="3 Years";
			else
				$duration="";

			?>
			
			<div style="height: 26px;width: 150px;background: #333333;padding: 0;position: relative;margin: 0 0 10px 0;">
				<?php /* ?>
				Instructor:
				<?php if($instr): ?>	
				 <a style="color:white;font: bold 12px/20px Arial, Helvetica, sans-serif;" href="<?php echo $seturl.'/instructors/?user='.$post->instructor_type; ?>">
				<?php echo get_user_meta($post->instructor_type, 'first_name', true); ?></a>
				<?php endif; ?><br/><?php */ ?>
				Duration:
				<?php echo $duration; ?>
			</div>	
			
			
	</div>	
	<div class="column2">
	<div class="pdtdes_dis"><div class="show"><?php the_excerpt(); ?></div><a href="javascript:;" class="red_txt_normal td_n">Find out more..</a>

	<div class="pdtdes_hdn"><div class="cb"></div><?php the_content(); ?><a class="grey_txt_normal" href="javascript:;">Scroll Back Up</a><br/></div>
	
	
	
</div>	
<div style="right:15%;postion:absolute;margin-top:-20px;">
		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>
</div>
	</div>
</li>