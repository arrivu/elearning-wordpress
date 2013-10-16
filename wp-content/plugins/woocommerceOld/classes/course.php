<?php
require_once("Canvas.php");
class Course extends Canvas{
  public $id;
  public $account_id;
  public $course_code;
  public $name;
  public $sis_course_id;

  public static function load($item){
    $course=new Course();
    $course->id              = $item['id'];
    $course->account_id      = $item['course_code'];
    $course->course_code     = $item['course_code'];
    $course->name            = $item['name'];
    $course->sis_course_id   = isset($item['sis_course_id']) ? $item['sis_course_id'] : null; 
    return $course;
  } 

	public function get_course($id){
		$response =  $this->get_json("/courses/".$id);
    $course = Course::load($response);
    
    return $course;
	}

	public function create_course($accountid,$sis_course_id,$name,$public_description){
		$data = json_encode(array("account_id"=>$accountid,"course" => array( "sis_course_id" => $sis_course_id,
								 "name" => $name, "public_description" => $public_description )));
		$response = $this->post_json("/accounts/".$accountid."/courses",$data);
    $course = Course::load($response);
    return $course;
	}
	
	public function update_course($id,$name,$public_description){
    $data = json_encode(array("course" => array( "name" => $name, "public_description" => $public_description)));
  	$response = $this->put_json("/courses/".$id,$data);
    $course = Course::load($response);
    return $course;
 	}

	public function enroll_user($course_id,$user_id, $type = "StudentEnrollment", $enrollment_state = "active",  $notify = 0){
  	$data = json_encode(array("enrollment" => array( "user_id" => $user_id, "type" => $type, "enrollment_state" => $enrollment_state, "notify" => $notify)));
  	return $this->post_json("/courses/".$course_id."/enrollments",$data);
	} 

	public function conclude_enrollment($course_id,$user_id){
  	return $this->delete_json("/courses/".$course_id."/enrollments/".$user_id."?task=conclude");
	}

	public function delete_course($id){
  	return $this->delete_json("/courses/".$id."?event=delete");
	}

	public function conclude_course($id){
    return $this->delete_json("/courses/".$id."?event=conclude");
  }  

	public function modules($course_id){
		return $this->get_json("/courses/".$course_id."/modules");
	}
  public function login($username,$password)  {
    //$config = parse_ini_file("config.ini");
      //$url = $config["url"];
      //$url="https://cas.arrivu.corecloud.com/cas/api-login";
    //$username="lms";
    //$password="$P$BgnM6ohzh.7db4.yUTj6V8Zx9099g5.";
    //echo "hiiiiiiiiii".$username.$password;
    $url="https://rubycas.com/cas/api-login";
    $data = array('username'=> $username,'password'=> $password);
      $handle = curl_init();
      curl_setopt($handle, CURLOPT_URL, $url);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($handle, CURLOPT_POST, true);
      curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
      //$ss=json_decode(curl_exec($handle),TRUE);
      //print_r($ss);
      //exit();

      return json_decode(curl_exec($handle),TRUE);
  }
 public function fused_get_all_user_orders($user_id,$status='completed'){
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
    //print_r($orders);
    //exit();
    return $orders;
 
  }
  //$order_ids=fused_get_all_user_orders(6, 'completed');
public function fused_get_all_products_ordered_by_user($user_id=false,$status='completed'){
  //echo "hiiiii".$user_id;
  //exit();
   $orders=Course::fused_get_all_user_orders($user_id,$status);

   if(empty($orders))
     return false;
   
   $order_list='('.join(',', $orders).')';//let us make a list for query
   
   global $wpdb;
   $query_select_order_items="SELECT order_item_id as id FROM {$wpdb->prefix}woocommerce_order_items WHERE order_id IN {$order_list}";
   
   $query_select_product_ids="SELECT meta_value as product_id FROM {$wpdb->prefix}woocommerce_order_itemmeta WHERE meta_key=%s AND order_item_id IN ($query_select_order_items)";
   //echo "SELECT meta_value as product_id FROM {$wpdb->prefix}woocommerce_order_itemmeta WHERE meta_key=%s AND order_item_id IN ($query_select_order_items)";
   //echo "hiiiiiiii".$query_select_product_ids;
   $products=$wpdb->get_col($wpdb->prepare($query_select_product_ids,'_product_id'));
   //print_r($products);
   return $products;
  }
  //$order_userids=fused_get_all_products_ordered_by_user(6, 'completed');
  //print_r($order_userids);  
  public function fused_has_user_bought($user_id,$product_id){
   $ordered_products=Course::fused_get_all_products_ordered_by_user($user_id);
   
   if(in_array($product_id, (array)$ordered_products))
     return true;
   return false;
   
  }

}
