<?php
/**
 * Template Name: Photography Guides
 */  
?>
<?php get_header(); ?>
<div class="row_black_wrapper overflow_fix clearfix ">
<div class="row_inner about_compelling clearfix overflow_fix">
<h1 class="about_compelling">Photography Guides</h1>
<ul class="menu_course clearfix" id="instructors">
<li><a class="photography-select">photography <span class="indicator"></span></a></li>
<li><a class="multimedia-select">multimedia <span class="indicator"></span></a></li>
</ul>
</div>
</div>
<div class="row_black_wrapper clearfix grey_border">
<div class="row_inner  overflow_fix photography-sect">
<ul class="instructor_list clearfix" id="instructor_team_greybottom">
  <?php $cat_id = 22; // The category id to select
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
        //echo '<h2>';the_title();echo '</h2>';		
		?>		
		<li><h2> <?php the_title(); ?></h2>		
			 <?php if ( has_post_thumbnail()) : ?>
			   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
			   <?php the_post_thumbnail(array(135,141) ); ?>
			   </a>
			 <?php endif; ?>
			<div class="share">
				<a class="more" href="<?php the_permalink(); ?>">more</a>
				<a target="_blank" class="twitter" href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>"></a>
				<a target="_blank" class="linked" href="http://www.linkedin.com/sharer.php?u=<?php the_permalink(); ?>"></a>
				<a target="_blank" class="web" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"></a>
			</div>
		</li>
		<?php
      }
   }?>
   <li style="padding:22px 0 0 0;"><img src="<?php echo bloginfo('template_url'); ?>/source/images/ins_Qmark.jpg" alt="next" title="next"><img src="<?php echo bloginfo('template_url'); ?>/source/images/ins_arrow.jpg" alt="nextyou" title="nextyou"></li>
<?php else:
   echo '<h2>Sorry, There are no instructors to list</h2>';
endif;?>
</ul>
<?php echo '<div class="pnavigation2">	'._mam_paginate(sizeof($mypages),$limit,$range).'</div>';

?>
</div>

<div class="row_inner  overflow_fix multimedia-sect">
<ul class="instructor_list clearfix" id="instructor_team_greybottom">
  <?php $cat_id = 15; // The category id of multimedia category
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
        //echo '<h2>';the_title();echo '</h2>';		
		?>		
		<li><h2> <?php the_title(); ?></h2>		
			 <?php if ( has_post_thumbnail()) : ?>
			   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
			   <?php the_post_thumbnail(array(135,141) ); ?>
			   </a>
			 <?php endif; ?>
			<div class="share">
				<a class="more" href="<?php the_permalink(); ?>">more</a>
				<a target="_blank" class="twitter" href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>"></a>
				<a target="_blank" class="linked" href="http://www.linkedin.com/sharer.php?u=<?php the_permalink(); ?>"></a>
				<a target="_blank" class="web" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"></a>
			</div>
		</li>
		<?php
      }
   }?>
   <li style="padding:22px 0 0 0;"><img src="<?php echo bloginfo('template_url'); ?>/source/images/ins_Qmark.jpg" alt="next" title="next"><img src="<?php echo bloginfo('template_url'); ?>/source/images/ins_arrow.jpg" alt="nextyou" title="nextyou"></li>
<?php else:
   echo '<h2>Sorry, There are no instructors to list</h2>';
endif;?>
</ul>
<?php echo '<div class="pnavigation2">	'._mam_paginate(sizeof($mypages),$limit,$range).'</div>';?>
</div>
</div>
<div class="row_black_wrapper overflow_fix">
<div class="row_inner clearfix">
<?php   if ( function_exists(dynamic_sidebar('Text_Above_Footer')) ) :
            dynamic_sidebar('Text_Above_Footer'); endif; ?>	
</div>
</div>
<?php get_footer(); ?>