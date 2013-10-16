<?php //echo "hiii";
include('User.php');
include('course.php');
  //require "User.php";
  //require "course.php";
 $return_statement=canvasuser();
 echo "hiiiiii".$return_statement;
  function canvasuser(){
     $user=new User();
  $course=new Course();
  $students=$user->list_users("1");
  //print_r($students);
  //print_r($_POST);
  foreach($students as $student)
  {
    //echo $student->name."<br/>";
    if(($student->name==$_POST["user"]) && ($student->oauth_token==$_POST["accesskey"]))
     {
      //echo "Success";
      //canvasuser($student->name);
      return true;
     } 

  }
  return false;
    //echo $username." user already exist.";
  }
?>