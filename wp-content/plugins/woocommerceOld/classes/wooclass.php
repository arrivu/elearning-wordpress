<?php

class Wooclass{

 public function fused_get_all_user_orders($user_id,$status='completed'){
    if(!$user_id)
        return false;
    
    $orders=array();//order ids
     
    $args = array(
        'numberposts'     => -1,
        'meta_key'        => '_customer_user',
        'meta_value'      => $user_id,
        'post_type'       => 'shop_order',
        'post_status'     => 'publish',
        'tax_query'=>array(
                array(
                    'taxonomy'  =>'shop_order_status',
                    'field'     => 'slug',
                    'terms'     =>$status
                    )
        )  
    );
    
    $posts=get_posts($args);
    //get the post ids as order ids
    $orders=wp_list_pluck( $posts, 'ID' );
    //print_r($orders);
    //exit();
    return $orders;
 
  }
  //$order_ids=fused_get_all_user_orders(6, 'completed');
public function fused_get_all_products_ordered_by_user($user_id=false,$status='completed'){
  //echo "hiiiii".$user_id;
  //exit();
   $orders=Wooclass::fused_get_all_user_orders($user_id,$status);
   //print_r($orders);
   if(empty($orders))
     return false;
   
   $order_list='('.join(',', $orders).')';//let us make a list for query
   
   global $wpdb;
   $query_select_order_items="SELECT order_item_id as id FROM {$wpdb->prefix}woocommerce_order_items WHERE order_id IN {$order_list}";
   
   $query_select_product_ids="SELECT meta_value as product_id FROM {$wpdb->prefix}woocommerce_order_itemmeta WHERE meta_key=%s AND order_item_id IN ($query_select_order_items)";
   //echo "SELECT meta_value as product_id FROM {$wpdb->prefix}woocommerce_order_itemmeta WHERE meta_key=%s AND order_item_id IN ($query_select_order_items)";
   //echo "hiiiiiiii".$query_select_product_ids;
   $products=$wpdb->get_col($wpdb->prepare($query_select_product_ids,'_product_id'));
   //print_r($products);
   return $products;
  }
  //$order_userids=fused_get_all_products_ordered_by_user(6, 'completed');
  //print_r($order_userids);  
  public function fused_has_user_bought($user_id,$product_id){
   $ordered_products=Wooclass::fused_get_all_products_ordered_by_user($user_id);
   //print_r($ordered_products);
   if(in_array($product_id, (array)$ordered_products))
     return true;
   return false;
   
  }

}
