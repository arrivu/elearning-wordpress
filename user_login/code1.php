<?php include("canvas.php"); ?>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script>
function validateEmail()
{
var x=document.myform.email.value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {  
  	return false;
  }
}
function validateForm(){
	if(validateEmail()==false){
		alert("Please enter a valid email address");
		return false;
	}else if(document.myform.course.selectedIndex==0){
		alert("Please select a course");
		return false;
	}else{
		return true;
	}
}
</script>	
<title>Student</title>
</head>
<body>
<form action="submit.php" onsubmit="return validateForm();" name="myform" method="post" id="myform">
	
<table align="center" border="0">
<tr><td>Email</td><td> <input type="text" name="email" value="" id="email"></td></tr>
<tr><td>Course</td><td> 
<?php
	$course=lms_list_course();
	?>
	<select name="course" id="courseid" style="width:175px;">
	<option value="">Select a Course</option>	
	<?php
	foreach ($course as $key => $value) {
		?>
		<?php
		echo "<option value='".$value['id']."'>".$value['course_code']."</option>";
	}
?>
</select>
<?php /* ?><input type="text" name="course" value=""><?php */ ?>
</td></tr>
<tr><td>Access Token</td><td> <input type="text" name="accesskey" value=""></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="Submit" name="submit" id="submit"></td></tr>
</table>

</form>
</body>
</html>