// JavaScript Document
jQuery(document).ready(function() {
	// For Button or Hyperlink text of Endless Scroll for Shop Page
	if ( jQuery("input[name='psad_es_shop_bt_type']:checked").val() == 'link') {
		jQuery(".psad_es_shop_link_styling").show();
		jQuery(".psad_es_shop_bt_styling").hide();
	} else {
		jQuery(".psad_es_shop_link_styling").hide();
		jQuery(".psad_es_shop_bt_styling").show();
	}
	jQuery('.psad_es_shop_bt_type').click(function(){
		if ( jQuery("input[name='psad_es_shop_bt_type']:checked").val() == 'link') {
			jQuery(".psad_es_shop_link_styling").show();
			jQuery(".psad_es_shop_bt_styling").hide();
		} else {
			jQuery(".psad_es_shop_link_styling").hide();
			jQuery(".psad_es_shop_bt_styling").show();
		}
	});
	
	// For Button or Hyperlink text of Endless Scroll for Category Page
	if ( jQuery("input[name='psad_es_category_bt_type']:checked").val() == 'link') {
		jQuery(".psad_es_category_link_styling").show();
		jQuery(".psad_es_category_bt_styling").hide();
	} else {
		jQuery(".psad_es_category_link_styling").hide();
		jQuery(".psad_es_category_bt_styling").show();
	}
	jQuery('.psad_es_category_bt_type').click(function(){
		if ( jQuery("input[name='psad_es_category_bt_type']:checked").val() == 'link') {
			jQuery(".psad_es_category_link_styling").show();
			jQuery(".psad_es_category_bt_styling").hide();
		} else {
			jQuery(".psad_es_category_link_styling").hide();
			jQuery(".psad_es_category_bt_styling").show();
		}
	});
	
	// For View All Products on Shop Page and Category Page
	if ( jQuery("input[name='psad_es_category_item_bt_type']:checked").val() == 'link') {
		jQuery(".psad_es_category_item_link_styling").show();
		jQuery(".psad_es_category_item_bt_styling").hide();
	} else {
		jQuery(".psad_es_category_item_link_styling").hide();
		jQuery(".psad_es_category_item_bt_styling").show();
	}
	jQuery('.psad_es_category_item_bt_type').click(function(){
		if ( jQuery("input[name='psad_es_category_item_bt_type']:checked").val() == 'link') {
			jQuery(".psad_es_category_item_link_styling").show();
			jQuery(".psad_es_category_item_bt_styling").hide();
		} else {
			jQuery(".psad_es_category_item_link_styling").hide();
			jQuery(".psad_es_category_item_bt_styling").show();
		}
	});
	
	// For Button or Hyperlink text of Endless Scroll for Products
	if ( jQuery("input[name='psad_es_products_bt_type']:checked").val() == 'link') {
		jQuery(".psad_es_products_link_styling").show();
		jQuery(".psad_es_products_bt_styling").hide();
	} else {
		jQuery(".psad_es_products_link_styling").hide();
		jQuery(".psad_es_products_bt_styling").show();
	}
	jQuery('.psad_es_products_bt_type').click(function(){
		if ( jQuery("input[name='psad_es_products_bt_type']:checked").val() == 'link') {
			jQuery(".psad_es_products_link_styling").show();
			jQuery(".psad_es_products_bt_styling").hide();
		} else {
			jQuery(".psad_es_products_link_styling").hide();
			jQuery(".psad_es_products_bt_styling").show();
		}
	});
});	