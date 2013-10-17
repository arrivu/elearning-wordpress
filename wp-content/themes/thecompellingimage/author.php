
<?php
/*
Template Name: Display Authors
*/
// Get all users order by amount of posts
$allUsers = get_users('orderby=post_count&order=DESC');
$users = array();
// Remove subscribers from the list as they won't write any articles
foreach($allUsers as $currentUser)
{
	if(in_array( 'author', $currentUser->roles ))
	{
		$users[] = $currentUser;
	}
}
?>
<?php get_header(); ?>
<div class="row_black_wrapper overflow_fix clearfix ">
<div class="row_inner about_compelling clearfix overflow_fix">

<?php if($_REQUEST["user"]): ?>
<h1 class="about_compelling">Photography Training from Professional Instructors</h1>
<?php else: ?>	
<!-- 	<ul class="instructor_list clearfix" id="instructor_team_greybottom">
<li>
<h1 class="about_compelling">Photography Training from Professional Instructors</h1>
<div style="width:100%;height:200px;">
	<?php
	
		foreach($users as $user)
		{
			?>
<div style="float:left;">
	<h2><?php echo $user->display_name; ?></h2>
<div class="authorAvatar">
					<?php echo get_avatar( $user->user_email, '128' ); 
					$string = get_permalink();
	
					?>
					<a href="<?php echo $string."?user=".$user->ID; ?>">more</a>
				</div>

<div class="authorInfo">
<?php /* ?>
<p class="authorDescrption"><?php echo get_user_meta($user->ID, 'description', true); ?>
<p class="authorLinks"><a href="<?php echo get_author_posts_url( $user->ID ); ?>">View Author Links</a><?php */ ?>
</div>
<div class="share">
			
							<?php
								$website = $user->user_url;
								if($user->user_url != '')
								{
									printf('<a href="%s">%s</a>', $user->user_url, 'Website');
								}
								$twitter = get_user_meta($user->ID, 'twitter_profile', true);
								if($twitter != '')
								{
									printf('
<a href="%s">%s</a>
', $twitter, 'Twitter');
								}
								$facebook = get_user_meta($user->ID, 'facebook_profile', true);
								if($facebook != '')
								{
									printf('
<a href="%s">%s</a>
', $facebook, 'Facebook');
								}
								$google = get_user_meta($user->ID, 'google_profile', true);
								if($google != '')
								{
									printf('
<a href="%s">%s</a>
', $google, 'Google');
								}
								$linkedin = get_user_meta($user->ID, 'linkedin_profile', true);
								if($linkedin != '')
								{
									printf('
<a href="%s">%s</a>
', $linkedin, 'LinkedIn');
								}
							?>
						</div>

</div></li>

			<?php
		}
	?></ul> -->
<ul class="instructor_list clearfix" id="instructor_team_greybottom">
	<li><h2> Robert</h2>		
			 			   <a href="http://wordpress.com/rails/robert/" title="Robert">
			   <img width="134" height="141" src="http://wordpress.com/rails/wp-content/uploads/2013/08/ins_shawnknox.jpg" class="attachment-135x141 wp-post-image" alt="ins_shawnknox">			   </a>
			 			<div class="share">
				<a class="more" href="http://wordpress.com/rails/robert/">more</a>
				<a target="_blank" class="twitter" href="http://twitter.com/share?url=http://wordpress.com/rails/robert/&amp;text=Robert"></a>
				<a target="_blank" class="linked" href="http://www.linkedin.com/sharer.php?u=http://wordpress.com/rails/robert/"></a>
				<a target="_blank" class="web" href="http://www.facebook.com/sharer.php?u=http://wordpress.com/rails/robert/"></a>
			</div>
		</li>>
</div>

<br/>
<?php endif; ?>
</div>
</div>
<?php get_footer(); ?>