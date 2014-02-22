<?php

	require_once("/opt/lampp/htdocs/qibla/wp-config.php"); 
	//require_once("/u/apps/qibla/wp-config.php");
	require_once('course.php');

	$course=new Course();

	$query="select * from wp_mdl_enrolments where id not in (select mdl_id from canvas_student_deenrollment)";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
		$start_date=$row['enrol_date'];
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
					$query6="select * from wp_postmeta where post_id=".$course_id." and meta_key='course_duration'";
					$result6 = mysql_query($query6);
					$end_date=0;
					while($row6 = mysql_fetch_array($result6)) {
						$end_date = strtotime("+".$row6['meta_value']." Week", strtotime($start_date));
						//echo date("Ymd",strtotime($start_date))."-".$row6['meta_value']."-";
						//echo date("Ymd",$end_date)."-";
					}
					$canvas_course_id=0;
					$canvas_enrollment_id=0;
					$query4="select * from canvas_post_course where post_id=".$course_id;
					$result4 = mysql_query($query4);
					while($row4 = mysql_fetch_array($result4)) {
						$canvas_course_id=$row4['canvas_id'];
					}
					$query5="select * from canvas_student_enrollment where course_id=".$course_id." and student_id=".$user_id;
					$result5 = mysql_query($query5);
					while($row5 = mysql_fetch_array($result5)) {
						$canvas_enrollment_id=$row5['enrollment_id'];
					}
					if($canvas_course_id!=0 && $canvas_enrollment_id!=0 && $end_date!=0){
						if(date("Ymd") > date("Ymd",$end_date)){
							$lms_enroll_result=$course->conclude_enrollment($canvas_course_id,$canvas_enrollment_id);
	   					    $query7="insert into canvas_student_deenrollment (mdl_id) values(".$row['id'].")";
	  						mysql_query($query7);

						}
					}	
				}
			}
		}
	}
?>