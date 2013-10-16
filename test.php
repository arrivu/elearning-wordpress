<?php
$config = parse_ini_file("config.ini");
    	$url = $config["casurl"];
    	//echo $url;
    	$cookie_set_url = $config["cookieurl"];

	$data = array('username'=> 'testme@gmail.com','password'=> '$P$BeyKKgqcQCjY28XqSvdamJFpi36l3M/');
      	$handle = curl_init();
      	curl_setopt($handle, CURLOPT_URL, $url);
      	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
      	curl_setopt($handle, CURLOPT_POST, true);
      	curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
      	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
      	$response = json_decode(curl_exec($handle),TRUE);
    	print_r($response);
    	//echo $response['type'];
    	if($response['type']=="confirmation"){
	    	//echo "hiiii";
	      //setcookie("tgt",$response['tgt'],time()+3600*24,'/',$cookie_set_url);
    		setcookie("tgt",$response['tgt'], false, "/", $cookie_set_url);
    		//setcookie('test', 'This is a test', time() + 3600);

	      
	    }
if(isset($_COOKIE['tgt'])){
$cookieSet = 'The cookie is ' . $_COOKIE['tgt'];
} else {
$cookieSet = 'No cookie has been set';
}
echo $cookieSet;
?>
<html>
<head><title>cookie</title></head>
<body>
<?php



//define( 'ABSPATH', dirname(__FILE__) . '/' );
	//require_once( ABSPATH . 'User.php' );
	//require_once( ABSPATH . 'course.php' );
include('User.php');
include('course.php');
	//require "User.php";
	//require "course.php";
	$user=new User();
	$course=new Course();
	//$courses=$course->get_course("2");
	//print_r($courses);
	
    	//exit();

    	/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
//define('WP_USE_THEMES', true);

/** Loads the WordPress Environment and Template */
//require('./wp-blog-header.php');





	//$courses=$user->list_users("1");
	//print_r($courses);
//$response=$user->check_existing_user("33");
	//print_r($response);
	//print_r($course);
	//$response=$course->modules(2);
	//var_dump($response);
	//echo $response->name;
//echo $response->id;
	// foreach($response as $item)
	// {
	// 	echo $item->name."<br>";
	// }

	//$response=$course->modules(2);
	//print_r($response);


	//$response=$course->create_course(1,"ruby","ruby","ruby");
   //print_r($response);
	//echo $response["id"];


	
	//$response=$user->create_user(1,"babinasdasdas","babinasdasdas","babinasdasdas$");
	//print_r($response);
	//echo $response["id"];

	//$response=$user->update_user(9,"anand");
	//print_r($response);
	//echo $response["id"];

	//$response=$user->delete_user(1,9);
	//print_r($response);
	//echo $response["id"];

	//$courses=$user->get_course(2);
	//print_r($courses);

?>
</body>
</html>
<?php //get_footer(); ?>		