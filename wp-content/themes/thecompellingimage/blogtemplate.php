<?php
/**
 * Template Name: Blog-Template
 */  
?>
<?php get_header(); ?>
<div class="row_black_wrapper overflow_fix blog">
<div class="row_inner">
<div class="left_container">
<div class="widget_emailupdate">
<h1>Free Email Updates</h1>
<h2>Get the latest content first.</h2>
<?php   if ( function_exists(dynamic_sidebar('Blog Subcribe')) ) :
            dynamic_sidebar('Blog Subcribe'); endif; ?>	
<h1 class="seg2">More Free Content</h1>
<a href="<?php echo bloginfo('url'); ?>/photography-guides/" class="photo_guides">Photography Guides</a>
</div>

</div>
<div class="right_container">
<ul class="fresh_cont">
<li class="heading clearfix">
<div>
<h1>Fresh Content</h1>
<h2>Learn about online marketing and more..</h2>
</div>
<input type="text" value="Search">
</li>
  <?php $cat_id = 20; // The category id to select
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
   $limit = 10;  // The number of posts per page
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
						<li class="post excerpt <?php echo (++$j % 3 == 0) ? 'last' : ''; ?>">							
								<h2>
									<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>">
									  <?php the_title(); ?>
									  </a>
								</h2>
								<p><?php the_excerpt();?></p>
								<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">Continue Reading</a><span><?php comments_number('0','1','%'); ?> Comment(s)</span>
								<div class="like">
								<span class="liketw">
								<!--Twitter Script Starts-->	
							   <a class="twitter-share-button" data-count="horizontal" href="http://twitter.com/share">Tweet</a>
								<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
								<!--Twitter Script Ends-->	
								</span>
								<!--Facebook Like Script Starts-->								
								<script>(function(d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0];
								 if (d.getElementById(id)) {return;}
								js = d.createElement(s); js.id = id;
								js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
								fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>								
								<span class="faclike"><script src="http://connect.facebook.net/en_US/all.js#appId=251246474892776&amp;xfbml=1"></script>
									<fb:like href="<?php the_permalink() ?>" width="30" show_faces="true" layout="bubble_count" font=""></fb:like>
								</span>												
								<div id="fb-root"></div>
								<!--Facebook Like Script Ends-->												
								</div>
								</li>
		<?php
      }
   }
else:
   echo '<h2>Sorry, There are no posts to list</h2>';
endif;?>
</ul>
<?php echo '<div class="pnavigation2">	'._mam_paginate(sizeof($mypages),$limit,$range).'</div>';?>
</div>
</div>
</div>
<?php get_footer(); ?>