<?php get_header(); ?>
<div class="row_inner">    
      <!--Here's where the loop starts-->
<?php if (have_posts()) : ?>
      <?php /* If this is a category archive */ if (is_category()) { ?>
      <h1><?php single_cat_title(); ?> Archives</h1>
      <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
      <h1>Archive for <?php the_time('F, Y'); ?></h1>
      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
      <h1>Archive for <?php the_time('Y'); ?></h1>
      <?php /* If this is an author archive */ } elseif (is_author()) { ?>
      <h1>Author Archive</h1>
      <?php /* If this is a tag archive */ } elseif (is_tag()) { ?>
      <h1>Posts tagged with <?php single_tag_title(); ?></h1>
      <?php } ?>
<?php while (have_posts()) : the_post(); ?>
<div ><!-- Styles container for each post -->
  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  <p ><span class="meta">Posted on <?php the_time('F j, Y'); ?> by <?php the_author_posts_link(); ?></span><span class="postcomments"><?php comments_popup_link('Leave a comment', '1 Comment', '% Comments', '', 'Comments are off'); ?></span></p>
  <div >
    <?php the_content('<p>Continue reading…</p>');?>
    <?php the_tags('<p>Tags:&nbsp;', ', ', '</p>'); ?>
  </div>
  <!--<?php trackback_rdf(); ?>-->
  </div><!-- Close post box -->
  <?php endwhile; else: ?>
  <div >
    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
  </div>
  <?php endif; ?>
</div><!-- Close content -->
<?php get_footer(); ?>
