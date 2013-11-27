<?php
/**
 * Template Name: Photography Guides
 */  
?>
<?php get_header(); ?>
<div class="row_inner">  
<div>
<div class="entry">
    <div class="row_grey_wrapper">
<div class="row_inner">
<div class="row_pGuide">
<div class="clearfix">
<h1 class="title_white">Photography Guides</h1>
<?php $direct=ABSPATH; ?>
<p><a class="signup1" href="<?php get_site_url(); ?>/rails/my-account/">Sign Up for a free Course</a>
</p></div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row_black_wrapper">
<div class="row_inner">
  <ul class="guide_list clearfix">
    <?php 
 global $wpdb;
    $cat_id = 22; // The category id to select guides in local
    //$cat_id = 38; // The category id to select guides in online
  $sql = "SELECT p.* FROM $wpdb->posts p
JOIN $wpdb->term_relationships tr ON (p.ID = tr.object_id)
JOIN $wpdb->term_taxonomy tt ON (tr.term_taxonomy_id = tt.term_taxonomy_id)
JOIN $wpdb->terms t ON (tt.term_id = t.term_id)
WHERE p.post_type='post'
AND p.post_status = 'publish'
AND tt.taxonomy = 'category'
AND t.term_id = $cat_id
ORDER BY ID DESC";
$mypages = $wpdb->get_results($sql);

if ($mypages) :
   $limit = 22;  // The number of posts per page
   $range = 5;   // The number of page links to show in the middle
   $mypage = (isset($_GET['mypage'])) ? $mypage = $_GET['mypage'] : 1;
   $start = ($mypage - 1) * $limit;
   for ($i=$start;$i<($start + $limit);++$i) {
      if ($i < sizeof($mypages)) {
        // Process each element of the result array here
        $post = $mypages[$i];
        setup_postdata($post);
        
    ?>    
    <li>  
       <?php if ( has_post_thumbnail()) : ?>
         <div title="<?php echo the_title(); ?>" class="tooltips">
         <?php the_post_thumbnail(array(229,296) ); ?>
         </div>
       <?php endif; ?>
      <div class="details" style="text-overflow:ellipsis;white-space:nowrap;width:13em;overflow:hidden; ">
<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></div>
    </li>
    <?php }
    }
    ?>
    <?php endif; ?>
    
  </ul>
</div>
</div>

<div class="row_black_wrapper overflow_fix">
<div class="row_inner clearfix">
<?php   if ( function_exists(dynamic_sidebar('Text_Above_Footer')) ) :
            dynamic_sidebar('Text_Above_Footer'); endif; ?>	
</div>
</div>
<?php get_footer(); ?>