<?php
/**
 * Loads the WordPress environment and template.
 *
 * @package WordPress
 */

if ( !isset($wp_did_header) ) {

	$wp_did_header = true;

	require_once( dirname(__FILE__) . '/wp-load.php' );

	wp();

	require_once( ABSPATH . WPINC . '/template-loader.php' );

}
global $current_user;
      get_currentuserinfo();


function fused_get_all_user_orders($user_id,$status='completed'){
    if(!$user_id)
        return false;
    
    $orders=array();//order ids
     
    $args = array(
        'numberposts'     => -1,
        'meta_key'        => '_customer_user',
        'meta_value'      => $user_id,
        'post_type'       => 'shop_order',
        'post_status'     => 'publish',
        'tax_query'=>array(
                array(
                    'taxonomy'  =>'shop_order_status',
                    'field'     => 'slug',
                    'terms'     =>$status
                    )
        )  
    );
    
    $posts=get_posts($args);
    //get the post ids as order ids
    $orders=wp_list_pluck( $posts, 'ID' );
    
    return $orders;
 
}
function fused_get_all_products_ordered_by_user($user_id=false,$status='completed'){
 
 $orders=fused_get_all_user_orders($user_id,$status);
 if(empty($orders))
   return false;
 
 $order_list='('.join(',', $orders).')';//let us make a list for query
 
 //so we have all the orders made by this user which was successfull
 
 //we need to find the products in these order and make sure they are downloadable
 
 // find all products in these order
 
 global $wpdb;
 $query_select_order_items="SELECT order_item_id as id FROM {$wpdb->prefix}woocommerce_order_items WHERE order_id IN {$order_list}";
 
 $query_select_product_ids="SELECT meta_value as product_id FROM {$wpdb->prefix}woocommerce_order_itemmeta WHERE meta_key=%s AND order_item_id IN ($query_select_order_items)";
 
 $products=$wpdb->get_col($wpdb->prepare($query_select_product_ids,'_product_id'));
 
 return $products;
}
$current_user = wp_get_current_user();
$result=fused_get_all_products_ordered_by_user($current_user->ID,$status='completed');
print_r($result);




















$config = parse_ini_file("config.ini");
        $url = $config["casurl"];
        $cookie_set_url = $config["cookieurl"];
        //echo $cookie_set_url;
        //echo "hiiiiii".$credentials['user_login'].$getuserId->user_pass.$url;
        //exit();
        //$url="https://rubycas.wordpress.com/cas/api-login";
        //$data = array('username'=> $credentials['user_login'],'password'=> $getuserId->user_pass);
        //$data = array('username'=> $getuserId->user_email,'password'=> $getuserId->user_pass);
        $data = array('username'=> 'testme@gmail.com','password'=> '$P$BeyKKgqcQCjY28XqSvdamJFpi36l3M/');
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($handle, CURLOPT_POST, true);
        curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
        $response = json_decode(curl_exec($handle),TRUE);
        //print_r($response);
        //exit();
        if($response['type']=="confirmation"){
            
          setcookie("tgt",$response['tgt'],time()+3600*24,'/',$cookie_set_url);
          //wp_setcookie("tgt",$response['tgt'], $cookie_set_url);
        }else{
         
        }


      
function curl_get_wp_login( $login_user, $login_pass, $login_url, $visit_url, $http_agent, $cookie_file ){
 
    if( !function_exists( 'curl_init' ) || ! function_exists( 'curl_exec' )){
        $m = "cUrl is not vailable in you PHP server.";
        echo $m;
    }
 
    // Preparing postdata for wordpress login
    $data = "log=". $login_user ."&pwd=" . $login_pass . "&wp-submit=Log%20In";
 	//$data = "log=". $login_user ."&pwd=" . $login_pass . "&wp-submit=Log%20In&redirect_to=" . $visit_url;
    // Intialize cURL
    $ch = curl_init();
 
    // Url to use
    curl_setopt( $ch, CURLOPT_URL, $login_url );
 
    // Set the cookies for the login in a cookie file.
    curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie_file );
 
    // Set SSL to false
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
 
    // User agent
    curl_setopt( $ch, CURLOPT_USERAGENT, $http_agent );
 
    // Maximum time cURL will wait for get response. in seconds
    curl_setopt( $ch, CURLOPT_TIMEOUT, 60 );
 
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
 
    // Return or echo the execution
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
 
    // Set Http referer.
    curl_setopt( $ch, CURLOPT_REFERER, $login_url );
 
    // Post fields to the login url
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );
    curl_setopt( $ch, CURLOPT_POST, 1);
 
    // Save the return in a variable
    $content = curl_exec ($ch);
 	
    /*
    ** if you need to visit another url, you can do it here.
    ** curl_setopt( $ch, CURLOPT_URL, 'a new url address or a file download url' );
    ** $content = curl_exec ($ch);
    */
  
    //print_r($content);
    //exit();
    // Close the cURL.
    //return json_decode(curl_exec($ch),TRUE);
    curl_close( $ch );
 
    // You can echo or return the page data here.
    //echo $content;
}
 
// Username for login
$login_user = "admin";
 
/*
** Password for this username
*/
$login_pass = "admin";
 
/*
** Login url address.
*/
$login_url = "http://localhost/wordpress/wp-login.php";
 //$login_url="https://cas.arrivu.corecoloud.com/cas/api-login";
/*
** Which page you want to visit after login.
** WordPress redirect their user automatically after login to this page
** if you do not assign a visit page,
** then the result for this login will return '1'.
** That means you have logged in successfully.
** Visit url is ipmportant to get the content.
*/
$visit_url = urlencode( 'http://localhost/wordpress/wp-admin' );
//$visit_url = urlencode( 'https://cas.arrivu.corecoloud.com/' );
 
/*
** Cookie vaiable
*/
$cookie_file = "/cookie.txt";
 
/*
** Set HTTP user agent.
*/
$http_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6";
 
// Test the call

//$sss=curl_get_wp_login( $login_user, $login_pass, $login_url, $visit_url, $http_agent, $cookie_file );
//print_r($sss);
//exit();

