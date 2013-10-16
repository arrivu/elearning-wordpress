<?php
	$config = parse_ini_file("config.ini");
    $access_token=$config["canvastoken"];

	$apiurl=$config["canvasurl"];
	
	function post_json($url,$data,$accesskey){

		global $access_token;
		if($accesskey!=""){
			$access_key=$accesskey;
		}
		else{
			$access_key=$access_token;
		}

		$handle = curl_init();
		$headers = array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer '.$access_key
		);
		curl_setopt($handle, CURLOPT_URL, $url);
		curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_POST, true);
		curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
	    $response = json_decode(curl_exec($handle),TRUE);
	    curl_close($handle);
	    return $response;
	} 
	function get_json($url){
		global $access_token;
		$handle = curl_init();
		curl_setopt($handle, CURLOPT_URL, $url."?access_token=".$access_token."&per_page=1000");
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
		$response= json_decode(curl_exec($handle),TRUE);
		curl_close($handle);
		return $response;
	}
	function lms_create_user($firstname,$lastname,$password,$email,$accesskey){
		global $apiurl;
		$data = json_encode(array("user" => array("name" => $firstname,"sortable_name"=>$lastname),"pseudonym" => array("unique_id" => $email,"password" => $password)));
		return post_json($apiurl."/accounts/1/users",$data,$accesskey);

	}
	function lms_list_course(){
		global $apiurl;
		$response = get_json($apiurl."/accounts/1/courses");
		//print_r($response);
		return $response;
	}
	function lms_create_course($course,$accesskey){
		global $apiurl;
		$data = json_encode(array("account_id"=>"1","course" => array( "sis_course_id" => $course,"name" => $course, "public_description" => $course )));
		return post_json($apiurl."/accounts/1/courses",$data,$accesskey);
	}

	function lms_enroll_user($user_lmsid,$course_lmsid,$accesskey){
		global $apiurl;
		$data = json_encode(array("enrollment" => array( "user_id" => $user_lmsid, "type" => "StudentEnrollment", "enrollment_state" => "active", "notify" => "0")));
		return post_json($apiurl."/courses/".$course_lmsid."/enrollments",$data,$accesskey);
	}
?>