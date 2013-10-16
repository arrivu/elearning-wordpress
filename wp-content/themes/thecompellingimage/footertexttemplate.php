<?php
/**
 * Template Name: FooterText-Template
 */  
?>
<?php get_header(); ?>
<div class="row_inner">   
<!--Here's where the loop starts-->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div><!-- Styles container for each post -->
  <!--<h1><?php //the_title(); ?></h1>-->
  <div class="entry">
    <?php the_content('<p>Continue reading…</p>');?>
  </div>
  </div><!-- Close post box -->
  <?php endwhile; else: ?>
  <div >
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  </div>
  <?php endif; ?>
</div><!-- Close Content -->
<div class="row_black_wrapper overflow_fix">
<div class="row_inner clearfix">
<?php   if ( function_exists(dynamic_sidebar('Text_Above_Footer')) ) :
            dynamic_sidebar('Text_Above_Footer'); endif; ?>	
</div>
</div>
<?php get_footer(); ?>