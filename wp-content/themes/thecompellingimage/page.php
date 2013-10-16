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
<?php get_footer(); ?>