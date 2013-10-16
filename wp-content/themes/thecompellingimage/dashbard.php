<?php
 /*
 Template Name: Dashboard Page
 */
 ?>

 <?php get_header(); 

global $wpdb;
            $result = $wpdb->get_results('select t1.order_item_id, t2.* FROM 
            wp_woocommerce_order_items as t1 JOIN wp_woocommerce_order_itemmeta as t2 ON t1.order_item_id = t2.order_item_id
            where t1.order_id='.$order->ID);
            echo '<pre>';
            print_r($result);
            echo '</pre>'; 


 get_footer(); ?>  