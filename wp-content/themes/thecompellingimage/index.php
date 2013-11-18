<?php get_header(); ?>
<div class="content_row">
<div class="row1">
<br/>    
<div class="title_red txt_center">Popular Courses</div>
<?php   //if ( function_exists(dynamic_sidebar('Popular courses Section')) ) :
            //dynamic_sidebar('Popular courses Section'); endif; ?>
<?php
// Setup your custom querytitle_red
$args = array( 'post_type' => 'product','meta_key' => 'Popular Course','posts_per_page' => 4,'product_cat' => 'Photography','orderby' => 'id', 'order' => 'DESC');
$loop = new WP_Query( $args );
?>

<div class="img_col1" style="margin-left:50px;">
<div class="col1txt">Photography</div>    
<?php $count=0; ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php $count++;
$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
$style="display:inline-block;text-decoration:none;color:#fff;font:bold 13px Arial, Helvetica, sans-serif;margin:8px 0 0 10px;";
if($count=="1")
{
    $rowclass="float:left;width:175px;height:100px;background:url('".$large_image_url[0]."') no-repeat;background-size:175px 100px;margin: 15px 20px 0 35px;";
}
elseif($count=="2")
{
     $rowclass="float:left;width:175px;height:100px;background:url('".$large_image_url[0]."') no-repeat;background-size:175px 100px;margin: 15px 0 0 0;";
}
elseif($count=="3")
{
     $rowclass="float:left;width:175px;height:100px;background:url('".$large_image_url[0]."') no-repeat;background-size:175px 100px;margin: 15px 20px 0 35px;";
}
elseif($count=="4")
{
     $rowclass="float:left;width:175px;height:100px;background:url('".$large_image_url[0]."') no-repeat;background-size:175px 100px;margin: 15px 0 0 0;";
}
?>

<div style="<?php echo $rowclass; ?>" title="<?php echo the_title(); ?>" class="tooltips"> 

<div style="float: left;vertical-align: bottom;width: 100%;height: 35%;margin-top: 65px; background-color: black;
opacity: 0.6;"  >
    <a style="<?php echo $style; ?>" href="<?php echo bloginfo('url'); ?>/?post_type=product">
<div style="text-overflow:ellipsis;white-space:nowrap;width:12em;overflow:hidden; ">
<?php the_title(); ?></div></a>
</div>    


</div>
<?php endwhile; wp_reset_query();  ?>
</div>




<?php
// Setup your custom query
$args = array( 'post_type' => 'product','meta_key' => 'Popular Course','posts_per_page' => 4,'product_cat' => 'Multimedia','orderby' => 'id', 'order' => 'DESC');
$loop = new WP_Query( $args );
?>
<div class="img_col2">
<div class="col1txt">Multimedia</div>
<?php $count=0; ?>
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
<?php $count++;
$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
$style="display:inline-block;text-decoration:none;color:#fff;font:bold 13px Arial, Helvetica, sans-serif;margin:8px 0 0 10px;";
if($count=="1")
{
    $rowclass="float:left;width:175px;height:100px;background:url('".$large_image_url[0]."') no-repeat;background-size:175px 100px;margin: 15px 20px 0 35px;";
}
elseif($count=="2")
{
     $rowclass="float:left;width:175px;height:100px;background:url('".$large_image_url[0]."') no-repeat;background-size:175px 100px;margin: 15px 0 0 0;";
}
elseif($count=="3")
{
     $rowclass="float:left;width:175px;height:100px;background:url('".$large_image_url[0]."') no-repeat;background-size:175px 100px;margin: 15px 20px 0 35px;";
}
elseif($count=="4")
{
     $rowclass="float:left;width:175px;height:100px;background:url('".$large_image_url[0]."') no-repeat;background-size:175px 100px;margin: 15px 0 0 0;";
}
?>

<div style="<?php echo $rowclass; ?>" title="<?php echo the_title(); ?>" class="tooltips"> 

<div style="float: left;vertical-align: bottom;width: 100%;height: 35%;margin-top: 65px; background-color: black;
opacity: 0.6;"  >
    <a style="<?php echo $style; ?>" href="<?php echo bloginfo('url'); ?>/?post_type=product">
<div style="text-overflow:ellipsis;white-space:nowrap;width:12em;overflow:hidden; ">
<?php the_title(); ?>
</div>
</a>
</div>    <?php /*?>		
<a href="<?php echo bloginfo('url'); ?>/programmes/#<?php the_title(); ?>" class="img_txt1">

<a href="<?php echo bloginfo('url'); ?>/?post_type=product" class="img_txt1">
<?php echo get_the_post_thumbnail($loop->post->ID,array(210,94)); ?>
<span><?php the_title(); ?></span>
</a>
<?php */ ?>
</div>
<?php endwhile; wp_reset_query(); // Remember to reset ?>
</div>
<br/><br/>
</div>
</div>
<?php //if ( function_exists(dynamic_sidebar('Free Lesson Section')) ) : ?>


<div class="get_start_black">
<div class="get_start_black_row">
<?php   if ( function_exists(dynamic_sidebar('Free Lesson Section')) ) :
            dynamic_sidebar('Free Lesson Section'); endif; ?>	
</div>
</div>
<?php // endif; ?>
<div class="findoffer_row">
<div class="findoffer_inner">
<h1 class="title">Find out more about this great offer!</h1>
<a class="signup tdn" href="<?php echo bloginfo('url'); ?>/?page_id=7"> Sign Up for Course</a>
</div>
</div>
<div class="row_black_wrapper overflow_fix">
<div class="row_inner">
<p class="title_red txt_center">Train with the World's Top Pro Photographers and Photoshop Experts!</p>
<p class="title_grey txt_center">Featured Instructors</p>
<style>
#imgInstructor li img {width:135px;height:121px;}
</style>

<?php //Featured Instructor
$allUsers = get_users('orderby=post_count&order=DESC');
$users = array();
$ct=0;
foreach($allUsers as $currentUser)
{
	if(in_array( 'author', $currentUser->roles ))
	{
		//echo $currentUser->ID;
		$all_meta_for_user = get_user_meta($currentUser->ID);
		//echo $all_meta_for_user['jsIs_user_featured'][0];
		
		if($all_meta_for_user['jsIs_user_featured'][0]=="yes")
		{
			if($ct<=5)
			{
			$users[] = $currentUser;
			}
			$ct++;
		}
	}
}
//print_r($users);

?>

<ul class="instructor_list" id="imgInstructor">
	<?php foreach($users as $user)
		{
			$string_site = get_site_url(); ?>
<li>   
			<a href="<?php echo $string_site."/instructors/?user=".$user->ID; ?>" title="<?php echo $user->display_name; ?>" style="text-decoration: none;color:#999"><?php echo get_avatar( $user->user_email); ?></a>
			      <h2><div style="text-overflow:ellipsis;white-space:nowrap;width:8em;overflow:hidden; "><?php echo $user->display_name; ?></div></h2>
</li>
</li>
			<?php
		}
	?>
</ul>

 <br/><br/><br/>





<?php

$args = array(
    'posts_per_page'   => 6,
    'offset'           => 0,
    'category'         => '21',
    'orderby'          => 'meta_id',
    'order'            => 'DESC',
    'include'          => '',
    'exclude'          => '',
    'meta_key'         => '_featured-post',
    'meta_value'       => '1',
    'post_type'        => 'post',
    'post_mime_type'   => '',
    'post_parent'      => '',
    'post_status'      => 'publish',
    'suppress_filters' => true );





    $featured = new WP_Query($args);
    
 ?>
<?php /* ?>
<?php

if ($featured->have_posts()):
?>
<ul class="instructor_list">
            <?php while($featured->have_posts()): $featured->the_post(); ?>
    
    <li>
     <?php if( has_post_thumbnail() ) { ?>    
    <a href="<?php the_permalink(); ?>">
       
         <?php 
          
            <?php the_post_thumbnail(array(550,225)); ?>
    </a>
    <h2><?php the_title(); ?></h2>
    <?php } ?>
    </li>
<?php endwhile;?>
<?php wp_reset_postdata(); ?>
<?php endif; ?>
</ul>

<br/><br/><br/><br/><br/><br/><br/>
<?php */?>

<?php  	

		if ( function_exists(dynamic_sidebar('Featured Instructors Section')) ) :
            dynamic_sidebar('Featured Instructors Section');
             endif; ?>	
<?php   if ( function_exists(dynamic_sidebar('Featured Instructors Bottom')) ) :
            dynamic_sidebar('Featured Instructors Bottom');
             endif; ?>	

</div>
</div>

<?php /* Set the name of the category and the number os posts to be displayed */?>
<?php /*?>
<?php $first_query = new WP_Query('category_name=Instructors&posts_per_page=6'); ?>
<div class="row_grey_wrapper overflow_fix">
<div class="row_inner">
<p class="title_red_small">Testimonials</p>

         <div class="textwidget">
<ul class="instructor_list">
            <?php while ($first_query->have_posts()) : $first_query->the_post(); ?>
    
    <li>
     <?php if ( has_post_thumbnail() ) { ?>    
    <a href="<?php the_permalink(); ?>">
        
         <?php 
          
            <?php the_post_thumbnail(); ?>
    </a>
    <h2><?php the_title(); ?></h2>
    <?php } ?>
    </li>
<?php endwhile; ?>

</ul>
</div>
</div>
</div>
<?php */ ?>
<div class="row_grey_wrapper overflow_fix">
<div class="row_inner">
<p class="title_red_small">Testimonials</p>
<?php   if ( function_exists(dynamic_sidebar('Testimonials')) ) :
            dynamic_sidebar('Testimonials'); endif; ?>	
</div>
</div>
<?php get_footer(); ?>			