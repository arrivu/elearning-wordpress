<script type='text/javascript' src='<?php echo get_site_url(); ?>/jquery.min.js'></script> 
<script type='text/javascript' src='<?php echo get_site_url(); ?>/jquery-ui.min.js'></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
   <script type="text/javascript">
   
$(document).ready(function () {
		var url = document.referrer;
 
 if (url=="http://wordpress.com/rails/checkout/")
{
 	window.location.reload(); 
}
 
});

</script>
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
		
		?>
	<style>
	
	.selectsubclass{color:red !important;}
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
<?php /* ?>
<br/><br/><br/>
<?php
$taxonomy = 'product_cat';
$orderby = 'name';
$show_count = 0; // 1 for yes, 0 for no
$pad_counts = 0; // 1 for yes, 0 for no
$hierarchical = 1; // 1 for yes, 0 for no
$title = '';
$empty = 0;

$args = array(
'taxonomy' => $taxonomy,
'orderby' => $orderby,
'show_count' => $show_count,
'pad_counts' => $pad_counts,
'hierarchical' => $hierarchical,
'title_li' => $title,
'hide_empty' => $empty
);
?>

<?php
$all_categories = get_categories( $args );
foreach ($all_categories as $cat)
{

if($cat->category_parent == 0)
{
$category_id = $cat->term_id;
$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
$image = wp_get_attachment_url( $thumbnail_id );
$args2 = array(
'taxonomy' => $taxonomy,
'child_of' => 0,
'parent' => $category_id,
'orderby' => $orderby,
'show_count' => $show_count,
'pad_counts' => $pad_counts,
'hierarchical' => $hierarchical,
'title_li' => $title,
'hide_empty' => $empty

);

$sub_cats = get_categories( $args2 );
if($sub_cats)
{
$cnt=0;
$count=count($sub_cats);
$totalcount=$count-1;
foreach($sub_cats as $sub_category)
{
echo '<div style="float:left;padding:5px;font: bold 14px/20px Arial, Helvetica, sans-serif;">';
if($sub_cats->$sub_category == 0)
{
echo '<a href="' . get_term_link( (int) $sub_category->term_id, 'product_cat' ) . '" style="text-decoration:none;color:#999999 !important;">' .$sub_category->name. ' </a>';
if($cnt<=$totalcount-1)
		echo "|";

$cnt++;	
?>
<?php

$args = array( 'post_type' => 'product','product_cat' => $sub_category->slug);
$loop = new WP_Query( $args );
?>
<?php wp_reset_query(); ?>

<?php
echo "</div>";
}
else
{

}

}
}

}
else
{
}
}
?>
<?php */ ?>
	<?php	
global $wp_query;
$cat = $wp_query->get_queried_object();
$permalink = $_SERVER['REQUEST_URI'];

global $post;
global $wpdb;

if($cat->parent>0)
{
	$product_cat_id=$cat->parent;
}
elseif($cat->term_id>0)
{
	$product_cat_id=$cat->term_id;
}
else
{
	$product_cat_id="13";
}
/*
$terms = get_the_terms( $post->ID, 'product_cat' );
foreach ($terms as $term) {
    $product_cat_idsss = $term->term_id;
    break;
}
*/
$qry='select wpt.*,wptax.* from wp_terms as wpt,wp_term_taxonomy as wptax where wptax.taxonomy="product_cat"  and  wpt.term_id=wptax.term_id and wptax.parent="'.$product_cat_id.'" order by wpt.name asc';

$ss=$wpdb->get_results($qry);
//print_r($ss);
echo '<br/><br/><br/>';
$cnt=0;
$count=count($ss);
$totalcount=$count-1;
foreach($ss as $cats)
{
	echo '<div class="subid" style="float:left;padding:5px;font: bold 14px/20px Arial, Helvetica, sans-serif;"><a id="atag" href="' . get_term_link( (int) $cats->term_id, 'product_cat' ) . '" style="padding:5px;text-decoration:none;color:#999999;" >';
	if ((strpos($permalink,$cats->slug) !== false) && ($cats->slug="all-courses"))
	 	echo '<span style="color:#d03423;">';
	echo  __( $cats->name, 'woocommerce' );
	if ((strpos($permalink,$cats->slug) !== false) && ($cats->slug="all-courses"))
	 	echo '</span>';
	echo '</a>';
	if($cnt<=$totalcount-1)
		echo "&nbsp;&nbsp;|";	
	echo "</div>";
	$cnt++;
}
?>
		<?php
		
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