<?php

	require_once("/opt/lampp/htdocs/qibla/wp-config.php"); 
	//require_once("/u/apps/qibla/wp-config.php");
	require_once('course.php');
	require_once('user.php');

	$dbhandle = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)  or die("Unable to connect to MySQL");
	$selected = mysql_select_db(DB_NAME,$dbhandle)  or die("Could not select database");

	$file = fopen("/opt/lampp/htdocs/qibla/canvas/cron.log","w");
	//$file = fopen("/u/apps/qibla/canvas/cron.log","w");
	fwrite($file,date('m/d/Y h:i:s')."\n");
	fclose($file);

	$user=new User();
	$course=new Course();

	//canvas user propagation
	$query="select * from wp_users where ID not in (select post_id from canvas_post_user)";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
	  $lms_result=$user->create_user(1,$row['user_login'],$row['user_email'],$row['user_pass']);
	  $query="insert into canvas_post_user (post_id,canvas_id,description) values(".$row['ID'].",".$lms_result->id.",'".mysql_real_escape_string($row['user_login'])."')";
	  mysql_query($query);
	}

	//canvas teacher propagation
	$query="select * from wp_posts where post_type='teacher' and ID not in (select post_id from canvas_post_teacher)";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$lms_result=$user->create_user(1,$row['post_title'],$row['post_name'],"");
		$query="insert into canvas_post_teacher (post_id,canvas_id,description) values(".$row['ID'].",".$lms_result->id.",'".mysql_real_escape_string($row['post_title'])."')";
		mysql_query($query);
	}

	//canvas course propagation
	$query="select * from wp_posts where post_type='course' and ID not in (select post_id from canvas_post_course)";
	$result = mysql_query($query);
		while($row = mysql_fetch_array($result)) {
			$course_id=$row['ID'];
			$lms_course_result=$course->create_course(1,$row['post_id'],$row['post_title'],$row['content']);
			$query="insert into canvas_post_course (post_id,canvas_id,description) values(".$row['ID'].",".$lms_course_result->id.",'".mysql_real_escape_string($row['post_title'])."')";
			mysql_query($query);
			//canvas teacher enrollment			
			$query2="select * from wp_postmeta where post_id=".$course_id." and meta_key='course_teachers'";
			$result2 = mysql_query($query2);
			while($row2 = mysql_fetch_array($result2)) {
				$data=$row2['meta_value'];
				if(trim($data)!=""){					
					$data = unserialize($data);
					foreach ($data as $teacher_id) {
						$query3="select * from canvas_post_teacher where post_id=".$teacher_id;
						$result3 = mysql_query($query3);
						while($row3 = mysql_fetch_array($result3)) {
							$lms_enroll_result=$course->enroll_teacher($lms_course_result->id,$row3['canvas_id']);
							$query4="insert into canvas_teacher_enrollment (course_id,teacher_id,enrollment_id) values(".$course_id.",".$teacher_id.",".$lms_enroll_result['id'].")";
							mysql_query($query4);
						}
					}
				}
			}

		}
	//canvas student enrollment
	$query="select * from wp_mdl_enrolments where id not in (select mdl_id from canvas_student_enrollment)";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$course_code=$row['course_id'];
		$query2="select * from wp_users where user_login='".$row['username']."'";
		$result2 = mysql_query($query2);
		$user_id=0;
		while($row2 = mysql_fetch_array($result2)) {
			$user_id=$row2['ID'];
		}
		if($user_id!=0){
			$course_code= explode("-",$course_code);
			if(sizeof($course_code)>=2){
				$query3="SELECT * FROM wp_posts WHERE post_type ='course' AND ID IN (SELECT a.post_id FROM wp_postmeta a, wp_postmeta b ".
				        "WHERE a.post_id = b.post_id AND a.meta_key =  'course_code' AND b.meta_key =  'semester_code' ". 
				        "AND a.meta_value =  '".$course_code[0]."' AND b.meta_value =  '".$course_code[1]."')";
				$result3 = mysql_query($query3);
				while($row3 = mysql_fetch_array($result3)) {
					$course_id=$row3['ID'];
					$canvas_course_id=0;
					$canvas_student_id=0;
					$query4="select * from canvas_post_course where post_id=".$course_id;
					$result4 = mysql_query($query4);
					while($row4 = mysql_fetch_array($result4)) {
						$canvas_course_id=$row4['canvas_id'];
					}
					$query5="select * from canvas_post_user where post_id=".$user_id;
					$result5 = mysql_query($query5);
					while($row5 = mysql_fetch_array($result5)) {
						$canvas_student_id=$row5['canvas_id'];
					}
					if($canvas_course_id!=0 && $canvas_student_id!=0){
						$lms_enroll_result=$course->enroll_user($canvas_course_id,$canvas_student_id);
						$query6="insert into canvas_student_enrollment (mdl_id,course_id,student_id,enrollment_id) values(".$row['id'].",".$course_id.",".$user_id.",".$lms_enroll_result['id'].")";
						mysql_query($query6);					
					}	
				}
			}
		}
	}
	
?>
