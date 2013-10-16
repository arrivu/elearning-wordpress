<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header('shop'); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>
	
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<?php /*?><h1 class="page-title"><?php woocommerce_page_title(); ?></h1><?php */ ?>

		<?php endif; ?>

		<?php do_action( 'woocommerce_archive_description' ); ?>
		<h1 class="about_compelling" style="text-align:center; color: #d03423;">Find the right course for you – select the type of course you are looking for:</h1>
		<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action('woocommerce_sidebar');
		//session_start();
		 $_SESSION['views']=1;
		 /*
		 $args = array(
    
    'show_count'         => 0,
    'use_desc_for_title' => 1,
    'child_of'           => 0,
    'title_li'           => __( '' ),
    'show_option_none'   => __('No Menu Items'),
    'number'             => null,
    'echo'               => 1,
    'depth'              => 2,
    'taxonomy'           => 'product_cat',
    
);
*/
		?>
	 <style>
      a:active {
  color:red !important;
}
    </style>
<?php 
global $woocommerce;

		$woocommerce->cart->empty_cart(); 
	?>
	<?php if((sizeof($woocommerce->cart->cart_contents_count)) == 0): 
    echo 'empty cart';
?>
<?php else: ?>
	<?php /* ?>
  <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" 
       title="<?php _e('View your shopping cart', 'woothemes'); ?>">

        <?php echo sprintf(_n('%d item', '%d items',
                $woocommerce->cart->cart_contents_count, 'woothemes'), 
                $woocommerce->cart->cart_contents_count);?> - 
        <?php echo $woocommerce->cart->get_cart_total(); ?>

    </a>
    <?php */
    ?>
<?php endif; ?>
	<?php	
global $post;
//echo "hiiiiii".$post->ID;
global $wpdb;
$cat_qry='select wpt.*,wptax.* from wp_terms as wpt,wp_term_taxonomy as wptax,wp_term_relationships as rr,wp_posts as ww  where taxonomy="product_cat"  and  wpt.term_id=wptax.term_id and wpt.term_id=rr.term_taxonomy_id and ww.ID=rr.object_id and wptax.parent="0" and rr.object_id='.$post->ID;
$get_catid=$wpdb->get_row($cat_qry);
//echo 'select wpt.*,wptax.* from wp_terms as wpt,wp_term_taxonomy as wptax,wp_term_relationships as rr,wp_posts as ww  where taxonomy="product_cat"  and  wpt.term_id=wptax.term_id and   wpt.term_id=rr.term_taxonomy_id and ww.ID=rr.object_id and rr.object_id="225" and wptax.parent="0"';
$product_cat_id = $get_catid->term_id;
$terms = get_the_terms( $post->ID, 'product_cat' );
foreach ($terms as $term) {
    $product_cat_idsss = $term->term_id;
    break;
}
//echo "hiiiii".$product_cat_id;

$qry='select wpt.*,wptax.* from wp_terms as wpt,wp_term_taxonomy as wptax where wptax.taxonomy="product_cat"  and  wpt.term_id=wptax.term_id and wptax.parent="'.$product_cat_id.'" order by wpt.name asc';
$ss=$wpdb->get_results($qry);
//print_r($ss);
echo '<br/><br/><br/>';
$cnt=0;
$count=count($ss);
$totalcount=$count-1;
//echo "hiiiii".$count;
foreach($ss as $cat)
{
	//echo $result->name;
	echo '<div style="float:left;padding:5px;font: bold 14px/20px Arial, Helvetica, sans-serif;"><a href="' . get_term_link( (int) $cat->term_id, 'product_cat' ) . '" style="text-decoration:none;color:#999999 !important;">' . __( $cat->name, 'woocommerce' ) . ' </a>';
	if($cnt<=$totalcount-1)
		echo "|";	
	echo "</div>";
	$cnt++;
}
//echo 'select wpt.*,wptax.* from wp_terms as wpt,wp_term_taxonomy as wptax where taxonomy="product_cat"  and  wpt.term_id=wptax.term_id and wptax.parent=13';
//$sub_cat=  '<div style="float:left;padding:5px;color:#999999 !important;font: bold 14px/20px Arial, Helvetica, sans-serif;"><a href="' . get_term_link( (int) $cat->term_id, 'product_cat' ) . '" style="text-decoration:none;">' . __( $cat->name, 'woocommerce' ) . ' </a> | </div>';
		
?>
		<?php

		//wc_origin_trail_ancestor(true);
		 if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				//do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php woocommerce_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php woocommerce_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>

	

<?php get_footer('shop'); ?>