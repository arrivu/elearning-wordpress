<style>
/* Default Plugin CSS */
.woocommerce nav.woocommerce-pagination, .woocommerce-page nav.woocommerce-pagination, .woocommerce #content nav.woocommerce-pagination, .woocommerce-page #content nav.woocommerce-pagination {
	text-align:center;
	margin-bottom:1.5em;
}
.woocommerce nav.woocommerce-pagination ul, .woocommerce-page nav.woocommerce-pagination ul, .woocommerce #content nav.woocommerce-pagination ul, .woocommerce-page #content nav.woocommerce-pagination ul {
	display:inline-block;
	white-space:nowrap;
	padding:0;
	clear:both;
	border:1px solid #e0dadf;
	border-right:0;
	margin:1px
}
.woocommerce nav.woocommerce-pagination ul li, .woocommerce-page nav.woocommerce-pagination ul li, .woocommerce #content nav.woocommerce-pagination ul li, .woocommerce-page #content nav.woocommerce-pagination ul li {
	border-right:1px solid #e0dadf;
	padding:0;
	margin:0;
	float:left;
	display:inline;
	overflow:hidden
}
.woocommerce nav.woocommerce-pagination ul li a, .woocommerce-page nav.woocommerce-pagination ul li a, .woocommerce #content nav.woocommerce-pagination ul li a, .woocommerce-page #content nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span, .woocommerce-page nav.woocommerce-pagination ul li span, .woocommerce #content nav.woocommerce-pagination ul li span, .woocommerce-page #content nav.woocommerce-pagination ul li span {
	margin:0;
	text-decoration:none;
	padding:0;
	line-height:1em;
	font-size:1em;
	font-weight:normal;
	padding:.5em;
	min-width:1em;
	display:block
}
.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:focus, .woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus {
	background:#f7f6f7;
	color:#998896
}

nav.woo-pagination a:link, nav.woo-pagination a:visited, nav.woo-pagination a:active{
	background:#FFFFFF !important;
	border:none !important;
}

.woocommerce-result-count {
	display:none;
}
.psad_more_product_disable {
	width:100000px;
	height:100000px;
	position:absolute;
	max-width:100%;
	max-height:100%;
	left:0;
	top:0;
	z-index:1000000;
	display:none;
}
.pbc_container {
	margin-top:1.5em;
}
.pbc_title {
	margin-bottom:0.5em;
}
.wc_content .woocommerce-pagination, .pbc_content .woocommerce-pagination {
	display:block;
}
.wc_content, .pbc_content, .products_categories_row {
	position:relative;
}
#infscr-loading img {
	width:auto !important;
}
#infscr-loading, .infscr-loading {
	background: none repeat scroll 0 0 #000000;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	bottom: 0px !important;
	color: #FFFFFF;
	left: 25% !important;
	opacity: 0.8;
	padding: 2%;
	position: absolute;
	text-align: center;
	width:46%;
	z-index: 1000000;
	margin:0;
}

.click_more_button{
	white-space: nowrap;
	text-decoration:none !important;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	display: inline-block;
	padding: 4px 14px 4px;
	color: #fff;
	text-decoration: none;
	border:none;
	position: relative;
	cursor: pointer;
	padding: 4px 14px 4px;
	border: 1px solid #4e7aa6;
	background: #ffffff;
	background: -webkit-gradient(linear, left top, left bottom, from(#7497b9), to(#4b6e90));
	background: -webkit-linear-gradient(#7497b9, #4b6e90);
	background: -moz-linear-gradient(center top, #7497b9 0%, #4b6e90 100%);
	background: -moz-gradient(center top, #7497b9 0%, #4b6e90 100%);
	border-radius: 3px;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1);
	-moz-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1);
	-webkit-box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

/* Endless Scroll Style for Shop Page */
<?php
$psad_es_shop_bt_type = get_option( 'psad_es_shop_bt_type' );
// Button Style
$psad_es_shop_bt_align = get_option( 'psad_es_shop_bt_align' );
$psad_es_shop_bt_bg = get_option( 'psad_es_shop_bt_bg' );
$psad_es_shop_bt_bg_from = get_option( 'psad_es_shop_bt_bg_from' );
$psad_es_shop_bt_bg_to = get_option( 'psad_es_shop_bt_bg_to' );
$psad_es_shop_bt_border_width = get_option( 'psad_es_shop_bt_border_width' );
$psad_es_shop_bt_border_style = get_option( 'psad_es_shop_bt_border_style' );
$psad_es_shop_bt_border_color = get_option( 'psad_es_shop_bt_border_color' );
$psad_es_shop_bt_rounded = get_option( 'psad_es_shop_bt_rounded' );
$psad_es_shop_bt_font_family = get_option( 'psad_es_shop_bt_font_family' );
$psad_es_shop_bt_font_size = get_option( 'psad_es_shop_bt_font_size' );
$psad_es_shop_bt_font_style = get_option( 'psad_es_shop_bt_font_style' );
$psad_es_shop_bt_font_color = get_option( 'psad_es_shop_bt_font_color' );
// Link Style
$psad_es_shop_link_align = get_option( 'psad_es_shop_link_align' );
$psad_es_shop_link_font_family = get_option( 'psad_es_shop_link_font_family' );
$psad_es_shop_link_font_size = get_option( 'psad_es_shop_link_font_size' );
$psad_es_shop_link_font_style = get_option( 'psad_es_shop_link_font_style' );
$psad_es_shop_link_font_color = get_option( 'psad_es_shop_link_font_color' );
$psad_es_shop_link_font_hover_color = get_option( 'psad_es_shop_link_font_hover_color' );
?>
.endless_click_shop {
<?php if ( $psad_es_shop_bt_type == 'button' ) { ?>
	text-align:<?php echo $psad_es_shop_bt_align;?> !important;
<?php } else { ?>
	text-align:<?php echo $psad_es_shop_link_align;?> !important;
<?php } ?>
}
.endless_click_shop a.click_more_button {
	/*Background*/
	background-color: <?php echo $psad_es_shop_bt_bg; ?> !important;
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $psad_es_shop_bt_bg_from;?>), to(<?php echo $psad_es_shop_bt_bg_to;?>)) !important;
	background: -webkit-linear-gradient(<?php echo $psad_es_shop_bt_bg_from;?>, <?php echo $psad_es_shop_bt_bg_to;?>) !important;
	background: -moz-linear-gradient(center top, <?php echo $psad_es_shop_bt_bg_from;?> 0%, <?php echo $psad_es_shop_bt_bg_to;?> 100%) !important;
	background: -moz-gradient(center top, <?php echo $psad_es_shop_bt_bg_from;?> 0%, <?php echo $psad_es_shop_bt_bg_to;?> 100%) !important;
	
		
	/*Border*/
	border: <?php echo $psad_es_shop_bt_border_width; ?>px <?php echo $psad_es_shop_bt_border_style; ?> <?php echo $psad_es_shop_bt_border_color; ?> !important;
	-webkit-border-radius: <?php echo $psad_es_shop_bt_rounded; ?>px !important;
	-moz-border-radius: <?php echo $psad_es_shop_bt_rounded; ?>px !important;
	border-radius: <?php echo $psad_es_shop_bt_rounded; ?>px !important;

	/* Font */
	font-family: <?php echo $psad_es_shop_bt_font_family; ?> !important;
	font-size: <?php echo $psad_es_shop_bt_font_size; ?>px !important;
	color: <?php echo $psad_es_shop_bt_font_color; ?> !important;
<?php if ( stristr($psad_es_shop_bt_font_style, 'bold') !== FALSE) { ?>
	font-weight: bold !important;
<?php } ?>
<?php if ( stristr($psad_es_shop_bt_font_style, 'italic') !== FALSE) { ?>
	font-style:italic !important;
<?php } ?>
<?php if ( $psad_es_shop_bt_font_style == 'normal') { ?>
	font-weight: normal !important;
	font-style: normal !important;
<?php } ?>

	text-align:<?php echo $psad_es_shop_bt_align;?> !important;
	padding: 7px 10px !important;
	text-decoration: none !important;
}
.endless_click_shop a.click_more_link {
	/* Font */
	font-family: <?php echo $psad_es_shop_link_font_family; ?> !important;
	font-size: <?php echo $psad_es_shop_link_font_size; ?>px !important;
	color: <?php echo $psad_es_shop_link_font_color; ?> !important;
<?php if ( stristr($psad_es_shop_link_font_style, 'bold') !== FALSE) { ?>
	font-weight: bold !important;
<?php } ?>
<?php if ( stristr($psad_es_shop_link_font_style, 'italic') !== FALSE) { ?>
	font-style:italic !important;
<?php } ?>
<?php if ( $psad_es_shop_link_font_style == 'normal') { ?>
	font-weight: normal !important;
	font-style: normal !important;
<?php } ?>

	text-align:<?php echo $psad_es_shop_link_align;?> !important;
}
.endless_click_shop a.click_more_link:hover{
	color: <?php echo $psad_es_shop_link_font_hover_color; ?> !important;
}

/* View All Products Style for Shop Page and Category Page */
<?php
$psad_es_category_item_bt_type = get_option( 'psad_es_category_item_bt_type' );
// Button Style
$psad_es_category_item_bt_align = get_option( 'psad_es_category_item_bt_align' );
$psad_es_category_item_bt_bg = get_option( 'psad_es_category_item_bt_bg' );
$psad_es_category_item_bt_bg_from = get_option( 'psad_es_category_item_bt_bg_from' );
$psad_es_category_item_bt_bg_to = get_option( 'psad_es_category_item_bt_bg_to' );
$psad_es_category_item_bt_border_width = get_option( 'psad_es_category_item_bt_border_width' );
$psad_es_category_item_bt_border_style = get_option( 'psad_es_category_item_bt_border_style' );
$psad_es_category_item_bt_border_color = get_option( 'psad_es_category_item_bt_border_color' );
$psad_es_category_item_bt_rounded = get_option( 'psad_es_category_item_bt_rounded' );
$psad_es_category_item_bt_font_family = get_option( 'psad_es_category_item_bt_font_family' );
$psad_es_category_item_bt_font_size = get_option( 'psad_es_category_item_bt_font_size' );
$psad_es_category_item_bt_font_style = get_option( 'psad_es_category_item_bt_font_style' );
$psad_es_category_item_bt_font_color = get_option( 'psad_es_category_item_bt_font_color' );
// Link Style
$psad_es_category_item_link_align = get_option( 'psad_es_category_item_link_align' );
$psad_es_category_item_link_font_family = get_option( 'psad_es_category_item_link_font_family' );
$psad_es_category_item_link_font_size = get_option( 'psad_es_category_item_link_font_size' );
$psad_es_category_item_link_font_style = get_option( 'psad_es_category_item_link_font_style' );
$psad_es_category_item_link_font_color = get_option( 'psad_es_category_item_link_font_color' );
$psad_es_category_item_link_font_hover_color = get_option( 'psad_es_category_item_link_font_hover_color' );
?>
.click_more_each_categories {
<?php if ( $psad_es_category_item_bt_type == 'button' ) { ?>
	text-align:<?php echo $psad_es_category_item_bt_align;?> !important;
<?php } else { ?>
	text-align:<?php echo $psad_es_category_item_link_align;?> !important;
<?php } ?>
}
.click_more_each_categories a.click_more_button, .click_more_each_categories span.click_more_button {
	/*Background*/
	background-color: <?php echo $psad_es_category_item_bt_bg; ?> !important;
	background: -webkit-gradient(linear, left top, left bottom, from(<?php echo $psad_es_category_item_bt_bg_from;?>), to(<?php echo $psad_es_category_item_bt_bg_to;?>)) !important;
	background: -webkit-linear-gradient(<?php echo $psad_es_category_item_bt_bg_from;?>, <?php echo $psad_es_category_item_bt_bg_to;?>) !important;
	background: -moz-linear-gradient(center top, <?php echo $psad_es_category_item_bt_bg_from;?> 0%, <?php echo $psad_es_category_item_bt_bg_to;?> 100%) !important;
	background: -moz-gradient(center top, <?php echo $psad_es_category_item_bt_bg_from;?> 0%, <?php echo $psad_es_category_item_bt_bg_to;?> 100%) !important;
	
		
	/*Border*/
	border: <?php echo $psad_es_category_item_bt_border_width; ?>px <?php echo $psad_es_category_item_bt_border_style; ?> <?php echo $psad_es_category_item_bt_border_color; ?> !important;
	-webkit-border-radius: <?php echo $psad_es_category_item_bt_rounded; ?>px !important;
	-moz-border-radius: <?php echo $psad_es_category_item_bt_rounded; ?>px !important;
	border-radius: <?php echo $psad_es_category_item_bt_rounded; ?>px !important;

	/* Font */
	font-family: <?php echo $psad_es_category_item_bt_font_family; ?> !important;
	font-size: <?php echo $psad_es_category_item_bt_font_size; ?>px !important;
	color: <?php echo $psad_es_category_item_bt_font_color; ?> !important;
<?php if ( stristr($psad_es_category_item_bt_font_style, 'bold') !== FALSE) { ?>
	font-weight: bold !important;
<?php } ?>
<?php if ( stristr($psad_es_category_item_bt_font_style, 'italic') !== FALSE) { ?>
	font-style:italic !important;
<?php } ?>
<?php if ( $psad_es_category_item_bt_font_style == 'normal') { ?>
	font-weight: normal !important;
	font-style: normal !important;
<?php } ?>

	text-align:<?php echo $psad_es_category_item_bt_align;?> !important;
	padding: 7px 10px !important;
	text-decoration: none !important;
}
.click_more_each_categories a.click_more_link, .click_more_each_categories span.click_more_link {
	/* Font */
	font-family: <?php echo $psad_es_category_item_link_font_family; ?> !important;
	font-size: <?php echo $psad_es_category_item_link_font_size; ?>px !important;
	color: <?php echo $psad_es_category_item_link_font_color; ?> !important;
<?php if ( stristr($psad_es_category_item_link_font_style, 'bold') !== FALSE) { ?>
	font-weight: bold !important;
<?php } ?>
<?php if ( stristr($psad_es_category_item_link_font_style, 'italic') !== FALSE) { ?>
	font-style:italic !important;
<?php } ?>
<?php if ( $psad_es_category_item_link_font_style == 'normal') { ?>
	font-weight: normal !important;
	font-style: normal !important;
<?php } ?>

	text-align:<?php echo $psad_es_category_item_link_align;?> !important;
}
.click_more_each_categories a.click_more_link:hover{
	color: <?php echo $psad_es_category_item_link_font_hover_color; ?> !important;
}

/* Separate Style */
<?php
$psad_seperator_enable = get_option('psad_seperator_enable');
$psad_seperator_border_style = get_option('psad_seperator_border_style');
$psad_seperator_border_width = get_option('psad_seperator_border_width');
$psad_seperator_border_color = get_option('psad_seperator_border_color');
$psad_seperator_padding_tb = get_option('psad_seperator_padding_tb');
if ( $psad_seperator_enable == 'yes' ){
?>
.psad_seperator {
	/*Border*/
	border-bottom: <?php echo $psad_seperator_border_width; ?>px <?php echo $psad_seperator_border_style; ?> <?php echo $psad_seperator_border_color; ?> !important;
	margin: <?php echo $psad_seperator_padding_tb; ?>px 0px !important;
}
.wc_content {
	/*Border*/
	border-bottom: <?php echo $psad_seperator_border_width; ?>px <?php echo $psad_seperator_border_style; ?> <?php echo $psad_seperator_border_color; ?> !important;
	padding-bottom:15px;
}
<?php } ?>

/* Count Meta Style */
.product_categories_showing_count_container {
	margin-top: 10px !important;
	margin-bottom: 10px !important;	
}
.product_categories_showing_count {
	/* Font */
	font-family: Arial, sans-serif !important;
	font-size: 11px !important;
	color: #000000 !important;
	font-style:italic !important;
}
.product_categories_showing_count {
	margin-right:10px;	
}

/* Hide Pagination of Shop Page */
<?php 
$psad_endless_scroll_category_shop = get_option('psad_endless_scroll_category_shop', '' );
if ( is_post_type_archive( 'product' ) && get_option('psad_shop_page_enable', '' ) == 'yes' && $psad_endless_scroll_category_shop == 'yes' ) { 
?>
.wc_content .woocommerce-pagination, .pbc_content .woocommerce-pagination,.wc_content nav, .woocommerce-pagination, .woo-pagination {display:none !important;}
<?php } ?>
</style>