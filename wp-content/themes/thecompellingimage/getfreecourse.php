<?php
/**
 * Template Name: Get Free Course-Template
 */  
?>
<?php get_header(); ?>
<br/>       
<div class="row_black_wrapper overflow_fix clearfix ">
<div class="row_inner about_compelling clearfix overflow_fix">
<div class="title_red txt_center">Get Your Free Lessons Now</div>
</div>
</div>
<div class="row_black_wrapper clearfix grey_border">
<div class="row_inner  overflow_fix photography-sect">
  <?php  
global $wpdb;
  // List posts by a Custom Field's values
$meta_key = '_regular_price';  // The meta_key of the Custom Field
$sql = "
   SELECT p.*,m.meta_value
   FROM $wpdb->posts p
   LEFT JOIN $wpdb->postmeta m ON (p.ID = m.post_id)
   WHERE p.post_type = 'post'
      AND p.post_status = 'publish'
      AND m.meta_key = '$meta_key'
   ORDER BY m.meta_value, p.post_date DESC
";
//echo $sql;
$rows = $wpdb->get_results($sql);
if ($rows) {
   foreach ($rows as $post) {
      setup_postdata($post);
      echo $post->meta_value;
      if ($post->meta_value != $current_value) {
         echo "<h3>$post->meta_value</h3>";
         $current_value = $post->meta_value;
      }
      // Put code here to display the post
      the_title();
   }
}
?>
<ul class="list_course">
        
        
          <br><br>

 
 
<?php

$direct=ABSPATH;
require_once($direct."/wp-content/plugins/woocommerce/classes/wooclass.php");
$user_ID = get_current_user_id();
//$user_ID=wp_get_current_user(); 
echo $user_ID;

?>
</ul>
<?php get_footer(); ?>