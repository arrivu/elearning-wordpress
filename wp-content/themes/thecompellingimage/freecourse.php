<?php
/**
 * Template Name: Free Course-Template
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
$woo_class=new Wooclass();

   $args = array('post_type' => 'product');
   $category_posts = new WP_Query($args);
   $category_posts->query('showposts=10000&post_type=product');
   //print_r($category_posts);
   if($category_posts->have_posts()) : 
      while($category_posts->have_posts()) : 
         $category_posts->the_post();
       //print_r($values);
       $regularprice=get_post_meta( get_the_ID(), '_regular_price', true ); 
       if($regularprice=="" || $regularprice=="0"){
?>
<li class="list_item grey_border clearfix">

    <div class="title">

    <h1 id="<?php echo the_title(); ?>"><?php echo the_title(); ?></h1>

    <h1 class="price">
      <?php echo "$0.00"; ?>
    </h1>
  </div>
  <div class="content">
  <div class="cb"></div>
  <div class="column1">
    
  <?php //echo "hiiiiiii".$category_posts->post->duration;
$duration_time=$category_posts->post->duration;
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
      <?php the_post_thumbnail(array(135,141) ); ?>
      <div style="height: 26px;width: 137px;text-align:center;background: #333333;padding: 0;position: relative;margin:-5px 0 10px 0;">
                Duration:
        <?php echo $duration; ?>      </div>  
      
      
  </div>  
 <div class="column2">
  <div><div><p><?php the_excerpt(); ?></p>
</div>
</div>  
<?php

$result=$woo_class->fused_has_user_bought($user_ID,get_the_ID());
$get_lmsid="select lms_id from wp_posts where ID=".get_the_ID();
$getlms=$wpdb->get_row($get_lmsid);
$config = parse_ini_file("config.ini");
$course_url = $config["canvasurl"];
$canvas_url= $course_url.'/courses/'.$getlms->lms_id .'/modules';
$siteurls=get_site_url();
$link = array(
      'url'   => '',
      'label' => '',
      'class' => ''
    );
?>
<div style="right:15%;postion:absolute;margin-top:5px;">
  <?php if($result): ?>
<a href="<?php echo $canvas_url; ?>"  rel="nofollow" data-product_id="225" data-product_sku="777" class="red_txt_normal button product_type_simple" style="margin:47px 0 15px 0">Take this course</a>
  <?php else: ?>
 
  <a href="<?php echo $siteurls; ?>/courses/?add-to-cart=<?php echo get_the_ID(); ?>" rel="nofollow" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="777" class="red_txt_normal button product_type_simple" style="margin:47px 0 15px 0">Enroll on this course</a>
  <br/>
 <?php endif; ?>


  
  </div>
</div>
<?php/* ?>
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
         <?php the_post_thumbnail(array(135,141) ); ?>
         </a>
         <?php         
         echo $regularprice;
         ?>
         <h1><?php echo the_title(); ?></h1>
         <div class='post-content'><?php the_excerpt(); ?></div>   
         <?php */ ?>   
    </div>
</li>   
<?php }
      endwhile;
   
?>
</ul>


<?php
   endif;
?>

</div>


</div>

<?php get_footer(); ?>