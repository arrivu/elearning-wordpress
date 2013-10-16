<?php get_header(); ?>
<div class="row_inner details_page">   
<!--Here's where the loop starts-->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div><!-- Styles container for each post -->
 <h1 class="heading_grey"><?php the_title(); ?></h1>
 <?php
$category = get_the_category(); 
if($category[0]->cat_name!='Instructors')
{ ?>
  <p class="grey_text"><span >Posted on <?php the_time('F j, Y'); ?> by <?php the_author_posts_link(); ?></span></p>
<?php } ?>  
  <div class="grey_text">
    <?php the_content('<p>Continue reading…</p>');?>
  </div>
<?php
$category = get_the_category(); 
if($category[0]->cat_name!='Instructors')
{
 comments_template(); 
}
else
{?>
  <?php /* ?>
	<div class="row_black_wrapper overflow_fix">
	<div class="row_inner clearfix grey_border ">
	<h1 class="about_compelling">Still not sure? <span style="color:#cccccc">Give a </span>free <span style="color:#cccccc">introductory lesson and assignment a try</span></h1>
	<p class="intro_lesson">Sign up for a no-strings-attached account and we'll send you an abbreviated sample lesson &ndash; complete with related assignment to go out and try &ndash; wherever you live. When you've finished, upload your work to the TCI website and you'll receive a timely critique of your photos &ndash; all for free!  </p>
	<div><a class="signup2 tdn" href="<?php echo bloginfo('url'); ?>/?page_id=7"> Sign Up for Course</a></div>
	</div>
	</div>
  <?php */ ?>
<?php } ?>  
  </div><!-- Close post box -->
  <?php endwhile; else: ?>
  <div>
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  </div>
  <?php endif; ?>
</div><!-- Close Content -->
<?php echo do_shortcode( '[featured_products per_page="12" columns="4"]' ); ?>            

<?php get_footer(); ?>
