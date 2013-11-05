<?php 
//ob_start();
//print_r($_POST);
//exit();

?>
<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title();?></title>
<link rel="Shortcut Icon" href="<?php echo bloginfo('template_url'); ?>/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/source/css/main.css" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link href='https://fonts.googleapis.com/css?family=Viga' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Noticia+Text' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
 
<script type="text/javascript"> 
var $jQFlip=jQuery.noConflict(true);
$jQFlip(document).ready(function(){
$jQFlip("ul.product-categories li a").append('<span class="indicator"></span>');
  $jQFlip(".pdtdes_dis a.red_txt_normal").click(function(){
	$jQFlip(this).hide();
	$jQFlip(this).prev(".show").hide();	
	$jQFlip(this).next('.pdtdes_hdn').show();
  });
  $jQFlip(".pdtdes_dis .show").click(function(){
	$jQFlip(this).hide();
	$jQFlip(this).next(".red_txt_normal").hide();	
	$jQFlip(this).next(".red_txt_normal").next('.pdtdes_hdn').show();	
  });
  $jQFlip(".pdtdes_hdn a.grey_txt_normal").click(function(){
	$jQFlip(this).parent(".pdtdes_hdn").hide();
	$jQFlip(this).parent(".pdtdes_hdn").prev(".red_txt_normal").show();
	$jQFlip(this).parent(".pdtdes_hdn").prev(".red_txt_normal").prev(".show").show();
  });
  //instructors page functionality
   $jQFlip("ul#instructors li a.photography-select").addClass('active');
   $jQFlip('.photography-sect').show();
   $jQFlip('.multimedia-sect').hide();
   $jQFlip("ul#instructors li a.photography-select").click(function(){
	$jQFlip("ul#instructors li a").removeClass('active');
	$jQFlip(this).addClass('active');
	$jQFlip('.multimedia-sect').hide();
	$jQFlip('.photography-sect').show();
  });
  $jQFlip("ul#instructors li a.multimedia-select").click(function(){
  	$jQFlip("ul#instructors li a").removeClass('active');
	$jQFlip(this).addClass('active');
	$jQFlip('.multimedia-sect').show();
	$jQFlip('.photography-sect').hide();
  });
  //career page functionality
  $jQFlip("ul#career li a.instructor-select").addClass('active');
  $jQFlip('.instructor-sect').show();
  $jQFlip('.management-sect').hide();
  $jQFlip("ul#career li a.instructor-select").click(function(){
	$jQFlip("ul#career li a").removeClass('active');
	$jQFlip(this).addClass('active');
	$jQFlip('.management-sect').hide();
	$jQFlip('.instructor-sect').show();
  });
  $jQFlip("ul#career li a.management-select").click(function(){
  	$jQFlip("ul#career li a").removeClass('active');
	$jQFlip(this).addClass('active');
	$jQFlip('.management-sect').show();
	$jQFlip('.instructor-sect').hide();
  });
});
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_url'); ?>/source/js/colorbox/jquery.colorbox-min.js"></script>
<link type="text/css" media="screen" rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/source/js/colorbox/colorbox.css" />
<script type="text/javascript">
var $jQColor=jQuery.noConflict(true);
$jQColor(document).ready(function(){
	$jQColor(".popupvideo").colorbox({iframe:true, innerWidth:300, innerHeight:170});
});
</script>
<script type="text/javascript">
function logout_lms()

{ 

mywindow= window.open('https://lms.thecompellingimage.com/logout','_blank');
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }



xmlhttp.open("GET","https://beta.thecompellingimage.com/wp-login.php?action=logout",false);
xmlhttp.send();
mywindow.close();
window.location.href="https://beta.thecompellingimage.com/";

}
</script>
 
</head>
<body>
<div class="wrapper">
<div id="header_row">
<div id="header">
<div id="logo"><a href="/">Logo</a></div>
	<ul class="social_menu clearfix">
	<li><a id="yt"></a></li><li><a id="fb"></a></li><li><a id="tw"></a></li><li><a id="in"></a></li>
	</ul>
	<ul class="right_menu">
			
	<?php $direct=get_site_url();
		//echo $direct;
		if(is_user_logged_in())
      	{
      	?>
      		<?php /*?><li><a href="<?php echo $direct;?>/?page_id=10" class="font_tahoma">View Orders</a></li><?php */?>
      		<?php $user_id=get_current_user_id(); ?>
      		<?php
      			if ( !current_user_can( 'manage_options' ) ) {
      		?>
      		<li><a href="<?php echo $direct;?>/my-account/" class="font_tahoma">My Courses</a></li>
      		<li><a href="<?php echo $direct;?>/edit-profile/" class="font_tahoma">Edit Profile</a></li>
      		<?php } ?>
      		<li><a href="#" onclick= "logout_lms()">Logout</a></li>
      	<?php	
      	}	
      	else
      	{
      		?>
      		<li><a href="<?php echo $direct;?>?page_id=7" class="font_tahoma">Sign Up</a></li>
      		<li><a href="<?php echo $direct;?>?page_id=7" class="font_tahoma">Login</a></li>
      		<?php
      	}	
	?>
	
	
	<li><a href="<?php echo $direct;?>?page_id=49" class="font_tahoma">Contact</a></li>
	</ul>

<?php /* ?>	
<?php   if ( function_exists(dynamic_sidebar('Header Right Section')) ) :
            dynamic_sidebar('Header Right Section');
             endif; ?>	

<?php */ ?>
</div>	
</div>
<div class="menu_row">
<div class="menu_row_inner">
<?php wp_nav_menu(array('main_nav' => 'main nav menu')); ?>  
<div class="search_container">
<form action="<?php echo bloginfo('url'); ?>" class="search-form" method="get" role="search">
	<input type="text" name="s" class="txt_search">
	<input type="submit" class="btn_search">
</form>
</div>
</div>
</div>
<?php putRevSlider("banner","homepage") ?>
<?php 
$postid=get_the_ID();
//echo $postid;
//echo current_page_url();
$string = get_permalink();
//echo $string;
$pos = strpos($string, "product");
$cour=strpos($string, "courses");
$checkout = strpos($string, "checkout");
    if ($pos == true || $cour == true) {
    
        putRevSlider("programmes");
    }
if($postid=="44")
{
   putRevSlider("aboutus");
}
if($postid=="46")
{
     putRevSlider("career");
}
if ($checkout == true)
{
 ?>
			
								<div style="margin:0px auto;background-color:#E9E9E9;padding:0px;margin-top:0px;margin-bottom:0px;height:470px;width:1280px;">

<div class="tp-caption big_white fade" style="margin: 9% 0% 0% 10%"
					 >Online-Interactive</div>
								
				<div class="tp-caption big_white fade"  
					  style="margin: 12.5% 0% 0% 10%"> Courses in Photography</div>
								
				<div class="tp-caption big_white fade"  
				
					 style="margin: 16% 0% 0% 10%">and Multimedia Storytelling - Taught</div>	
	 				
					<div class="tp-caption big_white fade"  
				
					 style="margin: 19.5% 0% 0% 10%">by the Professionals</div>

	


					<div style="height:470px;width:1280px;">						
										
						<img src="<?php echo $direct; ?>/wp-content/uploads/2013/08/img_programme.jpg"  alt="img_photo11" >
														
		
														</div>
				</div>	
<?php		
} ?> 
<div class="line"></div>