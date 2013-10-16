<?php
/**
 * WC_PSAD Class
 *
 * Table Of Contents
 *
 * WC_PSAD()
 * init()
 * limit_posts_per_page()
 * remove_woocommerce_pagination()
 * woocommerce_pagination()
 * remove_responsi_action()
 * psad_endless_scroll_shop()
 * check_shop_page()
 * psad_wp_enqueue_script()
 * psad_wp_enqueue_style()
 * start_remove_orderby_shop()
 * end_remove_orderby_shop()
 * dont_show_product_on_shop()
 * rewrite_shop_page()
 */
class WC_PSAD
{
	
	public function WC_PSAD() {
		$this->init();
	}
	
	public function init () {
		add_filter('loop_shop_per_page', array( &$this, 'limit_posts_per_page'),99);
		
		//Fix Responsi Theme.
		add_action( 'woo_head', array( &$this, 'remove_responsi_action'), 11 );
		add_action( 'wp_head', array( &$this, 'remove_woocommerce_pagination'), 10 );
		add_action( 'woocommerce_after_shop_loop', array( &$this, 'woocommerce_pagination') );
		
		//Check if shop page
		add_action( 'woocommerce_before_shop_loop', array( &$this, 'check_shop_page'), 1 );
		
		// For Shop page
		add_action( 'woocommerce_before_shop_loop', array( &$this, 'start_remove_orderby_shop'), 2 );
		add_action( 'woocommerce_before_shop_loop', array( &$this, 'end_remove_orderby_shop'), 40 );
		add_action( 'woocommerce_before_shop_loop', array( &$this, 'dont_show_product_on_shop'), 41 );
		add_action( 'woocommerce_after_shop_loop', array( &$this, 'rewrite_shop_page'), 12 );
				
		//Enqueue Script
		add_action( 'woocommerce_after_shop_loop', array( &$this, 'psad_wp_enqueue_script'),12 );
		
		// Add Custom style on frontend
		add_action( 'wp_head', array( &$this, 'include_customized_style'), 11);
		//add_action( 'woocommerce_after_shop_loop', array( &$this, 'psad_wp_enqueue_style'), 12 );
		
	}
	
	public function limit_posts_per_page() {
		global $wp_query;
		if(!is_admin()){
			$per_page = get_option('posts_per_page');
			if( is_post_type_archive( 'product' ) && get_option('psad_shop_page_enable') == 'yes' ) $per_page = 1;
			return $per_page;
		}
	}
	
	public function remove_woocommerce_pagination(){
		
		global $wp_query;
		$is_shop = is_post_type_archive( 'product' );
		if( ($is_shop && get_option('psad_shop_page_enable') == 'yes') ){
			remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
		}
	}
	
	public function woocommerce_pagination(){
		global $wp_query;
		$is_shop = is_post_type_archive( 'product' );
		if( !$is_shop ){
		
		if ( $wp_query->max_num_pages <= 1 )
			return;
		?>
		<nav class="wc_pagination woo-pagination woocommerce-pagination">
			<?php
				echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
					'base' 			=> str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
					'format' 		=> '',
					'current' 		=> max( 1, get_query_var('paged') ),
					'total' 		=> $wp_query->max_num_pages,
					'prev_text' 	=> '&larr;',
					'next_text' 	=> '&rarr;',
					'type'			=> 'list',
					'end_size'		=> 3,
					'mid_size'		=> 3
				) ) );
			?>
		</nav>
        <?php
		}
	}
	
	public function remove_responsi_action(){
		global $wp_query;
		if(function_exists('add_responsi_pagination_theme')){
			global $wp_query;
			$is_shop = is_post_type_archive( 'product' );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
			if($is_shop && get_option('psad_shop_page_enable') == 'yes'){
				remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
				remove_action( 'woo_head', 'add_responsi_pagination_theme',11 );
				remove_action( 'woo_loop_after', 'responsi_pagination', 10, 0 );
				remove_action( 'responsi_catalog_ordering', 'woocommerce_catalog_ordering', 30 );
			}
		}
	}	
					
	public function psad_endless_scroll_shop($show_click_more = true){
		?>
		<script type="text/javascript">
			jQuery(window).load(function(){
				//pbc infinitescroll
				var pbc_nextPage;
				var pbc_currentPage = jQuery('.pbc_pagination span.current').html();
				jQuery('.pbc_pagination').find('a.page-numbers').each(function(index){
					if(jQuery(this).html() == (parseInt(pbc_currentPage) + 1)){
						pbc_nextPage = jQuery(this);
					}
				});
			
				if(pbc_nextPage){
					jQuery('.pbc_content').infinitescroll({
						navSelector  : 'nav.pbc_pagination',
						nextSelector : pbc_nextPage,
						itemSelector : '.products_categories_row',
						loading: {
							finishedMsg: '<?php _e( 'No more categories to load.', 'wc_psad');?>',
							msgText:"<em><?php _e( 'Loading the next set of Categories...', 'wc_psad');?></em>",
							img: '<?php echo WC_PSAD_JS_URL;?>/masonry/loading-black.gif'
						}
					},function( newElements ) {
						var $newElems = jQuery( newElements ).css({ opacity: 0 });
						$newElems.animate({ opacity: 1 });
						jQuery('.pbc_content').append( $newElems );
						jQuery('.pbc_content_click_more').show();
						<?php
						if(function_exists('add_responsi_pagination_theme')){
							global $content_column;
							?>
							var content_column = <?php echo $content_column;?>;

							jQuery('.box_content').imagesLoaded(function(){
								jQuery(this).masonry({
								  itemSelector: '.box_item',
								  columnWidth: jQuery('.box_content').width()/content_column,
								  isAnimated: !Modernizr.csstransitions
								});
								//Fix Display Table-Cell
								jQuery('body #main .box_item .entry-item .thumbnail a img').attr('width','').attr('height','');
								var thumbs = jQuery('.box_content').find('.thumbnail_container');
								jQuery.each( thumbs, function( key, value ) {
									jQuery(this).find('a img').css("max-width",jQuery(this).find(".thumbnail").width()+"px");
								});
							});
							<?php
						}
						?>
					});
					<?php if($show_click_more){?>
					jQuery(window).unbind('.infscr');
					<?php } ?>
					jQuery('.pbc_content_click_more a').click(function(){
						jQuery('.pbc_content_click_more').hide();
    					jQuery('.pbc_content').infinitescroll('retrieve');
					 	return false;
					});
				}
			});
        </script>
		<?php
	}
	
	public function check_shop_page(){
		global $is_shop;
		$is_shop = false;
		if( is_post_type_archive( 'product' ) ) $is_shop = true;
		return $is_shop;
	}
	
	public function psad_wp_enqueue_script(){
		global $is_shop;
		$enqueue_script = false;
		if( $is_shop && get_option('psad_shop_page_enable') == 'yes' ) $enqueue_script = true;
		if(!$enqueue_script) return;
		wp_enqueue_script('jquery');
		wp_register_script( 'jquery_infinitescroll', WC_PSAD_JS_URL.'/masonry/jquery.infinitescroll.min.js');
		wp_enqueue_script( 'jquery_infinitescroll' );
	}
	
	public function psad_wp_enqueue_style(){
		global $is_shop;
		$enqueue_style = false;
		if( $is_shop && get_option('psad_shop_page_enable') == 'yes' ) $enqueue_style = true;
		if(!$enqueue_style) return;
		wp_enqueue_style( 'psad-css', WC_PSAD_CSS_URL.'/style.css');
	}
	
	public function include_customized_style(){
		global $is_shop;
		$enqueue_style = false;
		if ( is_post_type_archive( 'product' ) && get_option('psad_shop_page_enable') == 'yes' ) $enqueue_style = true;
		if ( $enqueue_style) {
			include( WC_PSAD_TEMPLATE_PATH. '/customized_style.php' );
		}
	}
	
	public function start_remove_orderby_shop(){
		global $is_shop;
		if ( $is_shop && get_option('psad_shop_page_enable') == 'yes' ) {
			ob_start();
		}
	}
	public function end_remove_orderby_shop(){
		global $is_shop;
		if ( $is_shop && get_option('psad_shop_page_enable') == 'yes' ) {
			ob_end_clean();
		}
	}
	
	public function dont_show_product_on_shop() {
		global $is_shop;
		$wp_query->query_vars['offset'] = 0;
		if ( $is_shop && get_option('psad_shop_page_enable') == 'yes' ) {
			global $wp_query;
			$wp_query = new WP_Query( $wp_query->query_vars );
			$wp_query->post_count  =  0;
			$wp_query->max_num_pages =  0;
		}
	}
	public function rewrite_shop_page() {
		global $is_shop;
		
		//Check rewrite this for shop page
		if ( !$is_shop || get_option('psad_shop_page_enable') != 'yes' ) return;
		
		//Start Shop
		global $woocommerce, $wp_query, $wp_rewrite;
		
		$enable_product_showing_count = get_option('psad_shop_enable_product_showing_count');
		$product_ids_on_sale = woocommerce_get_product_ids_on_sale();
		$product_ids_on_sale[] = 0;
		$global_psad_shop_product_per_page = get_option('psad_shop_product_per_page', 0);
		$global_psad_shop_product_show_type = get_option('psad_shop_product_show_type', '');
		$global_display_type = get_option('woocommerce_category_archive_display', '');
		
		$term 			= get_queried_object();
		$parent_id 		= empty( $term->term_id ) ? 0 : $term->term_id;
		
		$page = 1;
	
		if ( get_query_var( 'paged' ) ) $page = get_query_var( 'paged' );
		$psad_shop_category_per_page = get_option('psad_shop_category_per_page', 0);
		if ( $psad_shop_category_per_page <= 0 ) $psad_shop_category_per_page = 3;
		$args = array(
			'parent' => $parent_id,
			'child_of'		=> $parent_id,
			'menu_order'	=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 1,
			'taxonomy'		=> 'product_cat',
			'pad_counts'	=> 1
		);
		
		$product_categories = get_categories( $args  );
		
		$numOfItems = $psad_shop_category_per_page;
		$to = $page * $numOfItems;
		$current = $to - $numOfItems;
		$total = sizeof($product_categories);		
		$orderby = 'date';
		$order = 'DESC';
						
		if ($to > count ($product_categories) ) $to = count($product_categories);
		
		$psad_es_category_item_bt_type = get_option( 'psad_es_category_item_bt_type' );
		$psad_es_category_item_bt_text = esc_attr( stripslashes( get_option( 'psad_es_category_item_link_text', '' ) ) );
		$psad_es_category_item_bt_position = get_option('psad_es_category_item_bt_position', 'bottom');
		
		$psad_es_category_item_class = '';
		$class = 'click_more_link';
		if ( $psad_es_category_item_bt_type == 'button' ) {
			$class = 'click_more_button';
			$psad_es_category_item_bt_text = esc_attr( stripslashes( get_option( 'psad_es_category_item_bt_text', '' ) ) );
			$psad_es_category_item_class = get_option( 'psad_es_category_item_class', '' );
		}
		if ( trim( $psad_es_category_item_bt_text ) == '' ) { $psad_es_category_item_bt_text = __('See more...', 'wc_psad'); }
		if ( trim( $psad_es_category_item_class ) != '' ) { $class .= ' '.trim($psad_es_category_item_class); }
		
		echo '<div style="clear:both;"></div>';
		echo '<div class="pbc_container">';
		echo '<div style="clear:both;"></div>';
		echo '<div class="pbc_content">';
		if ( $product_categories ) {
			
			for ( $i = $current ; $i < $to ; ++$i ) {
				
				$category = $product_categories[$i];
				
				$psad_shop_product_per_page	= get_woocommerce_term_meta( $category->term_id, 'psad_shop_product_per_page', true );
				if (!$psad_shop_product_per_page || $psad_shop_product_per_page <= 0)
					$psad_shop_product_per_page = $global_psad_shop_product_per_page;
				if ( $psad_shop_product_per_page <= 0 )
					$psad_shop_product_per_page = 3;
					
				$psad_shop_product_show_type	= get_woocommerce_term_meta( $category->term_id, 'psad_shop_product_show_type', true );
				if (!$psad_shop_product_show_type || $psad_shop_product_show_type == '')
					$psad_shop_product_show_type = $global_psad_shop_product_show_type;
					
				$display_type	= get_woocommerce_term_meta( $category->term_id, 'display_type', true );
				if (!$display_type || $display_type == '')
					$display_type = $global_display_type;
				
				if ($psad_shop_product_show_type == 'none') {
				} elseif ($psad_shop_product_show_type == 'recent') {
				} elseif ($psad_shop_product_show_type == 'onsale') {
					$wp_query->query_vars['post__in'] = $product_ids_on_sale;
				} elseif ($psad_shop_product_show_type == 'featured') {
					$wp_query->query_vars['no_found_rows'] = 1;
					$wp_query->query_vars['post_status'] = 'publish';
					$wp_query->query_vars['post_type'] = 'product';
					$wp_query->query_vars['meta_query'] = $woocommerce->query->get_meta_query();
					$wp_query->query_vars['meta_query'][] = array(
						'key' => '_featured',
						'value' => 'yes'
					);
				}
				$product_args = array(
					'post_type'				=> 'product',
					'post_status' 			=> 'publish',
					'ignore_sticky_posts'	=> 1,
					'orderby' 				=> $orderby,
					'order' 				=> $order,
					'posts_per_page' 		=> $psad_shop_product_per_page,		
					'meta_query' 			=> array(
						array(
							'key' 			=> '_visibility',
							'value' 		=> array('catalog', 'visible'),
							'compare' 		=> 'IN'
						)
					),
					'tax_query' 			=> array(
						array(
							'taxonomy' 		=> 'product_cat',
							'terms' => $category->slug ,
							'include_children' => false ,
							'field' 		=> 'slug',
							'operator' 		=> 'IN'
						)
					)
				);
				
				$ogrinal_product_args = $product_args;
				
				if ( $psad_shop_product_show_type == 'onsale' ) {
					$product_args['orderby']	= 'meta_value_num';
					$product_args['order']		= 'DESC';
					$product_args['meta_key']	= '_psad_onsale_order';
				} elseif ( $psad_shop_product_show_type == 'featured' ) {
					$product_args['orderby']	= 'meta_value_num';
					$product_args['order']		= 'DESC';
					$product_args['meta_key']	= '_psad_featured_order';
				}
				
				$products = query_posts( $product_args );
				if ( have_posts() ) {
					$total_posts = $wp_query->found_posts;
					$count_posts_get = count($products);
				
					$term_link_html = '';
					if ( $category->parent > 0 ) {
					$my_term = get_term($category->parent,'product_cat');
						$term_link = get_term_link( $my_term, 'product_cat' );
						if ( is_wp_error( $term_link ) )
							continue;
						$term_link_html = '<a href="'.$term_link.'">'. $my_term->name. '</a> / ';
					}
					$term_link_sub_html = get_term_link( $category->slug, 'product_cat' );
					echo '<div id="products_categories_row_'.$category->term_id.'" class="products_categories_row">';
					echo '<div class="custom_box responsi_title"><h1 class="title pbc_title">'.$term_link_html.'<a href="'.$term_link_sub_html.'">' .$category->name.'</a></h1>';
					if ( $enable_product_showing_count == 'yes' || ( $count_posts_get < $total_posts && $psad_es_category_item_bt_position == 'top' ) ) {
						echo '<div class="product_categories_showing_count_container">';
						if ( $enable_product_showing_count == 'yes' ) echo '<span class="product_categories_showing_count">'.__('Currently viewing', 'wc_psad'). ' 1 - ' .$count_posts_get.' '.__('of', 'wc_psad'). ' '. $total_posts .' '. __('products in this Category', 'wc_psad').'</span> ';
						if ( $count_posts_get < $total_posts && $psad_es_category_item_bt_position == 'top' ) echo '<span class="click_more_each_categories"><a class="categories_click '.$class.'" id="'.$category->term_id.'" href="'.$term_link_sub_html.'">'.$psad_es_category_item_bt_text.'</a></span>';
						echo '</div>';
					}
					if( trim($category->description) != '' ) echo '<blockquote class="term-description"><p>'.$category->description.'</p></blockquote>';
					echo '</div>';
					
					woocommerce_product_loop_start();
					while ( have_posts() ) : the_post();
						woocommerce_get_template( 'content-product.php' );
					endwhile; 
					woocommerce_product_loop_end();
					
					if ( $psad_es_category_item_bt_position != 'top' ) {
						if ( $count_posts_get < $total_posts ) {
							echo '<div class="click_more_each_categories" style="width:100%;clear:both;"><a class="categories_click '.$class.'" id="'.$category->term_id.'" href="'.$term_link_sub_html.'">'.$psad_es_category_item_bt_text.'</a></div>';
						} else {
							echo '<div class="click_more_each_categories" style="width:100%;clear:both;"><span class="categories_click">'.__('No more products to view in this category', 'wc_psad').'</span></div>';
						}
					}
					echo '</div>';
					echo '<div class="psad_seperator products_categories_row" style="clear:both;"></div>';
				}
			}
		}
		
		echo '<div style="clear:both;"></div>';
		
		$psad_endless_scroll_category_shop = get_option('psad_endless_scroll_category_shop');
		$psad_endless_scroll_category_shop_tyle = get_option('psad_endless_scroll_category_shop_tyle');
		
		$use_endless_scroll = false;
		$show_click_more = false;
		if( $is_shop && $psad_endless_scroll_category_shop == 'yes'){
			$use_endless_scroll = true;
			if( $psad_endless_scroll_category_shop_tyle == 'click'){
				$show_click_more = true;
			}
		}
		
		if ( ceil($total / $numOfItems) > 1 ){
			echo '<nav class="pagination woo-pagination woocommerce-pagination pbc_pagination">';
			$defaults = array(
				'base' => add_query_arg( 'paged', '%#%' ),
				'format' => '',
				'total' => ceil($total / $numOfItems),
				'current' => $page,
				'prev_text' 	=> '&larr;',
				'next_text' 	=> '&rarr;',
				'type'			=> 'list',
				'end_size'		=> 3,
				'mid_size'		=> 3
			);
			if( $wp_rewrite->using_permalinks() && ! is_search() )
				$defaults['base'] = user_trailingslashit( trailingslashit( add_query_arg( 'orderby', false, get_pagenum_link() ) ) . 'page/%#%' );
				
			echo paginate_links( $defaults );
			echo '</nav>';
		}
		echo '</div><!-- pbc_content -->';
		echo '<div style="clear:both;"></div>';
		if ($use_endless_scroll) {
			$this->psad_endless_scroll_shop($show_click_more);
		}
		if ( $use_endless_scroll && $show_click_more ) {
			if ( ceil($total / $numOfItems) > 1 ) {
				$psad_es_shop_bt_type = get_option( 'psad_es_shop_bt_type' );
				$psad_es_shop_bt_text = esc_attr( stripslashes( get_option( 'psad_es_shop_link_text', '' ) ) );
				$class = 'click_more_link';
				if ( $psad_es_shop_bt_type == 'button' ) { 
					$class = 'click_more_button';
					$psad_es_shop_bt_text = esc_attr( stripslashes( get_option( 'psad_es_shop_bt_text', '' ) ) );
					$psad_es_shop_bt_class = get_option( 'psad_es_shop_bt_class', '' );
				}
				if ( trim( $psad_es_shop_bt_text ) == '' ) { $psad_es_shop_bt_text = __('Click More Categories', 'wc_psad'); }
				if ( trim($psad_es_shop_bt_class) != '' ) { $class .= ' '.trim($psad_es_shop_bt_class); }
				echo '<div class="pbc_content_click_more custom_box endless_click_shop"><a href="#"><a class="categories_click '.$class.'" href="#">'.$psad_es_shop_bt_text.'</a></div>';
			}
		}
		echo '<div style="clear:both;"></div>';
		echo '</div><!-- pbc_container -->';
		echo '<div style="clear:both;"></div>';
		wp_reset_postdata();
		//End Shop
	}
	
}
$GLOBALS['wc_psad'] = new WC_PSAD();
?>