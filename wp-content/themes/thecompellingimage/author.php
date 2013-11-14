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
<?php foreach($users as $user)
		{
$img_src[] = get_wp_user_avatar_src($user->ID);
}
$ss=0;
$cntss=count($ss);

foreach ($img_src as $key) {
	
	$img_jqry .= $key.","; 
	
	$ss++;
}
$jcode=json_encode($img_jqry);

$comma= str_replace(',', '","', $jcode);
$slash=str_replace('\/', '/', $comma);
//echo $slash;

		 ?>	
 <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script type="text/javascript">
$(document).ready(function() {

		 var imgArray =[<?php echo $slash; ?>];
		  /*
var imgArray = ['http://wordpress.com/rails/wp-content/uploads/2013/08/ins_Bobsacha.jpg', 
                'http://wordpress.com/rails/wp-content/uploads/2013/08/ins_david.jpg', 
                'http://wordpress.com/rails/wp-content/uploads/2013/08/ins_Donmarr.jpg'
                
               ];
    alert(imgArray);    
    */      
 var nextBG = "url(" + imgArray[Math.floor(Math.random() * imgArray.length)] + ") no-repeat";
$('#slideshow').css("background", nextBG);    
//$('#slideshow').css("background-size","url('images/pic.jpg')");  
//$('#slideshow').css("background-image","url(" + imgArray[Math.floor(Math.random() * imgArray.length)] + ") no-repeat");        
//$("#slideshow").css("background-size":"100% 100%");
$('#slideshow').css({"background-size":"135px 141px","width":"135px","height":"141px"}); 
/*
$("#slideshow").css({
        'background-image' : +nextBG,
        'background-size'  : '50%'
    });
*/
setInterval(function(){
    nextBG = "url(" + imgArray[Math.floor(Math.random() * imgArray.length)] + ") no-repeat";
    $('#slideshow').fadeOut('slow', function() { 
    	//$(this).css("background-size":"100% 100%");
        $(this).css("background", nextBG).fadeIn('slow');
        $(this).css({"background-size":"135px 141px","width":"135px","height":"141px"}); 

 })                   
}, 3000); // 3 second interval


});
</script>
<?php $direct=get_site_url(); ?>
<?php get_header(); ?>
<style>
#instructor_team_greybottom li img {width:135px;height:141px;}

</style>
	<div style="margin:0px auto;background-color:#E9E9E9;padding:0px;margin-top:0px;margin-bottom:0px;height:470px;width:1280px;">

<div class="tp-caption big_white fade" style="margin: 9% 0% 0% 10%"
					 >Online-Interactive</div>
								
				<div class="tp-caption big_white fade"  
					  style="margin: 12.5% 0% 0% 10%"> Courses in Photography</div>
								
				<div class="tp-caption big_white fade"  
				
					 style="margin: 16% 0% 0% 10%">and Multimedia Storytelling - Taught</div>	
	 				
					<div class="tp-caption big_white fade"  
				
					 style="margin: 19.5% 0% 0% 10%">by the Professionals</div>
<?php if(!$_REQUEST["user"]): ?>
	<div  class="tp-caption big_white fade" style="margin: 10.5% 0% 0% 70%; ">
<?php //echo get_avatar( $users[0]->ID, '128' ); ?>
<?php /* ?><div id="slideshow" ></div><?php */ ?>
</div>

<div class="tp-caption big_white fade" id="test">
  <img id="myImage" src="<?php echo get_the_author_meta( 'user_custom_avatar', $users[0]->ID); ?>" />
 
</div>
<?php endif; ?>


					<div style="height:470px;width:1280px;">						
										
						<img src="<?php echo $direct; ?>/wp-content/uploads/2013/08/img_programme.jpg"  alt="img_photo11" >
														
		
														</div>
				</div>	


<div class="row_black_wrapper overflow_fix clearfix ">
<div class="row_inner about_compelling clearfix overflow_fix">

<?php if($_REQUEST["user"]):
$userid=$_REQUEST["user"];
 ?>
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/source/css/editor-style.css" /> 
<h1 style="text-align: center;font-weight: bold;display: block;font-size: 2em;font:normal 34px myrid, Arial, Helvetica, sans-serif; color: #d03423;">Instructor's Profile</h1>
<ul>
<style>
.thumb-wrapper {
position:relative;
}

</style>
<?php $hturl=get_site_url()."/wp-content/uploads/2013/play.png"; ?>

<?php $src_img=get_wp_user_avatar_src($userid);
//echo $userid;
//echo $src_img;
?>

<li class="list_item clearfix" style="color:#999999;">
<div class="content">
<div style="width:140px !important;float:left;padding:5px 20px 5px 5px;">
<?php /*?><img src="images/img_akash.png" style="margin:0 0 15px 17px;" /><?php */ ?>
<?php //echo get_avatar( $userid, '128' );
$youtubeurl=get_user_meta($userid, 'jabber', true);
 ?>
 <?php if($youtubeurl){ ?>
<div class="thumb-wrapper">
<a href="<?php echo get_user_meta($userid, 'jabber', true); ?>" class="thickbox">	
<img src="<?php echo $src_img?>" width="136" height="148"/><span style="opacity:0.5;background-color:#F2F2F2 !important;filter:Alpha(opacity=50);padding-left:42px;padding-right:10px;border:1px solid gray;position:absolute;top: 43px;left: 32px;width: 5%;height: 35%;z-index: 100;background: transparent url('<?php echo $hturl;?>') no-repeat;background-position:center;background-size:40px;40px;"></span>
</a>
</div>
<?php }else{ ?>
<div class="thumb-wrapper">	
<img src="<?php echo $src_img?>" width="122" height="128"/>

</div>
<?php } ?>
</div>
<div style="width:742px !important;float:left;padding:5px 5px 5px 5px;vertical-align: top;">
<?php global $wpdb;
$get_userid="select * from wp_users where ID=".$userid;
		$getuser_detail=$wpdb->get_row($get_userid);
?>	



	<div style="font: normal 18px Arial, Helvetica, sans-serif;color: #cccccc !important;"><?php echo $getuser_detail->display_name; ?>	</div>

<?php echo get_user_meta($userid, 'description', true); ?>

</div>
</div>

</li>

<li class="list_item grey_border clearfix">
<br/>
<br/>	
<div class="grey_border"></div>
<div class="title " style="padding-top:10px;">
<div style="font: normal 18px Arial, Helvetica, sans-serif;color: #cccccc !important;width: 75%;
float: left;">Connect<br><?php if($getuser_detail->user_url): ?>
<a class="site_address">
<?php echo $getuser_detail->user_url; ?>
</a>
<?php endif; ?>
</div>

<div style="float:right;padding-bottom:15px;">
	<a target="_blank" href="<?php echo get_user_meta($userid, 'facebook', true); ?>"><img src="<?php echo $direct; ?>/HTML/images/ico_fb.png"></a> 
	<a target="_blank" href="<?php echo get_user_meta($userid, 'twitter', true); ?>"><img src="<?php echo $direct; ?>/HTML/images/ico_twitter1.png"></a>
</div>
<?php /* ?><a class="site_address">000 0000 0000 (office)</a><?php */?>
</div>
	
</li>
<?php 
$today = date("Y-m-d");      
//echo $today;
$NewDate=Date('Y-m-d', strtotime("-15 days"));
//echo $NewDate;
$get_courseid="SELECT * FROM wp_posts WHERE  (enrollstart BETWEEN '".$NewDate."' AND '".$today."') and instructor_type='".$userid."'";
$getcourse_detail=$wpdb->get_results($get_courseid);
$direct=ABSPATH;
require_once($direct."/wp-content/plugins/woocommerce/classes/wooclass.php");
$user_ID=wp_get_current_user();	
$woo_class=new Wooclass();

?>

<li class="list_item clearfix">
<div class="content clearfix" style="text-align:center;">
<h1 class="txt_head">Currently Teaching</h1>

<p style="text-align:center";>The next session of the course starts on following dates - there are also other sessions to choose from to ensure you find the course that is most convenient for </p>
<p style="text-align:center";>To buy a place on this course, please select the session that you would like to enroll on:</p>
<ul class="enroll  overflow_fix">
	
	<?php foreach ($getcourse_detail as $res) { ?>
	<li style="list-style:none;">
<div class="enroll_column1">
<h3 style="text-align:center;"><?php echo $res->post_title; ?><!--<span class="grey_txt"> (Enroll before <?php echo Date('d-M-Y',strtotime($res->enrollstart)); ?>)</span>--></h3><?php 
$result=$woo_class->fused_has_user_bought($user_ID->ID,$res->ID);
$get_lmsid="select lms_id from wp_posts where ID=".$res->ID;
$getlms=$wpdb->get_row($get_lmsid);
$config = parse_ini_file("config.ini");
$course_url = $config["canvasurl"];
$canvas_url= $course_url.'/courses/'.$getlms->lms_id .'/modules';
$siteurls=get_site_url();
?>
<?php if($result): ?>
<a href="<?php echo $canvas_url; ?>" style="margin: 0 0 0 0px;">Take this course</a>
<?php else: ?>	
<a href="<?php echo $siteurls; ?>/courses/?add-to-cart=<?php echo $res->ID; ?>" style="margin: 0 0 0 0px;">Click here to enroll</a>
<?php endif; ?>
</div>
</li>
<?php } ?>

</ul>
</div>





</div>
</li>



</ul>

<?php else: ?>	
<h1 class="about_compelling" style="text-align: center; color: #d03423;">Photography Training from Professional Instructors</h1>

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
	<li><h2>

		<?php
		//echo "hiiiiiii".get_wp_user_avatar_src($user->ID);	
		 echo $user->display_name; ?></h2>		
			 	
			 			   <a href="<?php echo $string."?user=".$user->ID; ?>" title="<?php echo $user->display_name; ?>">
			 			   	<?php echo get_avatar( $user->user_email, '128' ); ?>
			      </a>
			 			<div class="share">
				<a class="more" href="<?php echo $string."?user=".$user->ID; ?>">more</a>
				<?php  
					$twitter = get_user_meta($user->ID, 'twitter', true);
								if($twitter != '')
								{
				?>
				<a target="_blank" class="twitter" href="<?php echo $twitter; ?>"></a>
				<?php }
					   else{						
				 ?>
				 <a target="_blank" class="twitter" href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>"></a>
				<?php } ?>				 
				<?php  
					$linkedin = get_user_meta($user->ID, 'linkedin', true);
								if($linkedin != '')
								{
				?>
				<a target="_blank" class="linked" href="<?php echo $linkedin; ?>"></a>
				<?php }
					   else{						
				 ?>
				 <a target="_blank" class="linked" href="http://www.linkedin.com/sharer.php?u=<?php the_permalink(); ?>"></a>
				<?php } ?>
				<?php  
					$facebook = get_user_meta($user->ID, 'facebook', true);
								if($facebook != '')
								{
				?>
				<a target="_blank" class="web" href="<?php echo $facebook; ?>"></a>
				<?php } 
					   else{						
				 ?>
				 <a target="_blank" class="web" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"></a>
				<?php } ?>
			</div>
		</li>
			<?php
		}
	?>
</ul>





<br/>
<?php endif; ?>
</div>
</div>
<div class="list_item grey_border clearfix"></div>
<div class="row_black_wrapper overflow_fix">
<div class="row_inner clearfix">
<?php   if ( function_exists(dynamic_sidebar('Text_Above_Footer')) ) :
            dynamic_sidebar('Text_Above_Footer'); endif; ?>	
</div>
</div>
<?php get_footer(); ?>