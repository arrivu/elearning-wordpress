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
    //print_r($course);
    //exit();
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
    //$url="https://rubycas.com/cas/api-login";
    $config = parse_ini_file("config.ini");
    $url = $config["casurl"];
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
 

}
