<?php include("canvas.php"); ?>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
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

    var letter = /[a-zA-Z]/;
    var number = /[0-9]/;
	var password = document.myform.password.value;
	if(document.myform.firstname.value==""){
		alert("Please enter first name.");
		myform.firstname.focus();
		return false;	
	}
	else if(document.myform.lastname.value==""){
		alert("Please enter last name.");
		myform.lastname.focus();
		return false;	
	}
	else if(document.myform.email.value==""){
		alert("Please enter email.");
		myform.email.focus();
		return false;	
	}
	else if(validateEmail()==false){
		alert("Please enter a valid email address.");
		document.myform.email.value="";
		myform.email.focus();
		return false;
	}
	else if(document.myform.password.value==""){
		alert("Please enter password.");
		myform.password.focus();
		return false;	
	}
	else if(password.length < 6 || !letter.test(password) || !number.test(password)) {
    	alert("The password field must contain at least 6 alphanumeric characters.");
    	myform.password.focus();
		return false;
    }	
	else if(document.myform.course.selectedIndex==0){
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
<tr><td>First Name</td><td> <input type="text" name="firstname" value="" id="firstname"></td></tr>
<tr><td>Last Name</td><td> <input type="text" name="lastname" value="" id="lastname"></td></tr>
<tr><td>Email</td><td> <input type="text" name="email" value="" id="email"></td></tr>
<tr><td>Password</td><td> <input type="password" name="password" value="" id="password"></td></tr>
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