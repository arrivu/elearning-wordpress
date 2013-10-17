
<?php
/*
Template Name: Display Authors
*/
// Get all users order by amount of posts

?>
<?php get_header(); ?>
<div class="row_black_wrapper overflow_fix clearfix ">
<div class="row_inner about_compelling clearfix overflow_fix">

<?php if($_REQUEST["user"]): ?>
<h1 class="about_compelling" style="text-align: center; color: #d03423;">Professional Photography Courses</h1>
<ul class="list_course">



<li class="list_item grey_border clearfix">
<div class="content">
<div class="column1">
<?php /*?><img src="images/img_akash.png" style="margin:0 0 15px 17px;" /><?php */ ?>
<?php echo get_avatar( $_REQUEST["user"], '128' ); ?>
</div>
<div class="column2">
<h4>G.M.B.Akash</h4>	
<p>
Akash's passion for photography began in 1996. He attended the World Press Photo seminar in Dhaka for 3 years and graduated with a BA in Photojournalism from Pathshala, Dhaka. He has received more than 40 international awards from all around the world and his work has been featured in over 50 major international publications including: Time, Sunday Times, Newsweek, Geo, Stern, Der Spiegel, Brand Ein, The Guardian, Marie Claire, Colors, The Economist, The New Internationalist, Kontinente, Amnesty Journal, Courier International, PDN, Die Zeit, Days Japan, Hello, and Sunday Telegraph of London.</p>

<p>In 2002 he became the first Bangladeshi to be selected for the World Press Photo Joop Swart Masterclass in the Netherlands. In 2004 he received the Young Reporters Award from the Scope Photo Festival in Paris, again being the first Bangladeshi to 
</p>
</div>
</div>
</li>

<li class="list_item grey_border clearfix">
<div class="title">
<h4>Contact</h4>
<a class="site_address">www.mywebsite.com  -  info@mywebsite.com</a><br>
<a class="site_address">000 0000 0000 (office)</a>
<h1 class="follow" >Follow me @ <a><img src="images/ico_fb.png"></a> <a><img src="images/ico_twitter1.png"></a></h1>
</div>
</li>
</ul>

<?php else: ?>	
<?php
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
<h1 class="about_compelling">Photography Training from Professional Instructors</h1>

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
	<?php foreach($users as $user)
		{
			$string = get_permalink(); ?>
	<li><h2><?php echo $user->display_name; ?></h2>		
			 	
			 			   <a href="<?php echo $string."?user=".$user->ID; ?>" title="<?php echo $user->display_name; ?>">
			 			   	<?php echo get_avatar( $user->user_email, '128' ); ?>
			      </a>
			 			<div class="share">
				<a class="more" href="<?php echo $string."?user=".$user->ID; ?>">more</a>
				<a target="_blank" class="twitter" href="http://twitter.com/share?url="></a>

				<a target="_blank" class="linked" href="http://www.linkedin.com/sharer.php?u="></a>
				<?php /* ?>
				<a target="_blank" class="web" href="http://www.facebook.com/sharer.php?u=http://wordpress.com/rails/tester/"></a>
				<?php */ ?>
			</div>
		</li>
			<?php
		}
	?>
</ul>
</div>

<br/>
<?php endif; ?>
</div>
</div>
<?php get_footer(); ?>