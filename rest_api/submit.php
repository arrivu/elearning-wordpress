<?php
	include("db.php");
	include("canvas.php");
	
	$user_lmsid="";
	$course_lmsid="";
	$email=trim(strtolower($_POST['email']));
	$accesskey=trim($_POST['accesskey']);
	$query="select * from student where trim(lower(email))='".$email."'";
	$result=pg_query($query);
	if($row=pg_fetch_array($result))	{
		$user_lmsid=$row['lms_id'];		
	}else{
		//create canvas user
		$response=lms_create_user($email,$accesskey);
		if($response['id'] != ""){
			$insert="INSERT INTO student (email, lms_id) VALUES ('".$email."','".$response['id']."')";
			pg_query($insert);
			$user_lmsid=$response['id'];
		}
		
	}	
	
	$course=trim(strtolower($_POST['course']));
	if($user_lmsid!=""){
		//enroll user to a course
		lms_enroll_user($user_lmsid,$course,$accesskey);
	}
	header("Location: code1.php");

?>
