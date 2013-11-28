<?php
$username = "root";
$password = 'p@$SM0r~dw3b$!t3@21082013';
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
?>
<?php
//select a database to work with
$selected = mysql_select_db("wordpress",$dbhandle) 
  or die("Could not select codefixe_rails");
?>
<?php $qry="SELECT f.meta_value,a.post_date,a.ID from wp_posts a,wp_term_relationships b,wp_term_taxonomy c,wp_terms d,wp_woocommerce_order_items e,wp_woocommerce_order_itemmeta f where a.id=b.object_id and b.term_taxonomy_id=c.term_taxonomy_id and c.term_id=d.term_id and c.taxonomy='shop_order_status' and d.slug='completed' and a.post_type='shop_order' and a.id=e.order_id and e.order_item_id=f.order_item_id and f.meta_key='_product_id'";
//execute the SQL query and return records
//echo $qry;
$result = mysql_query($qry);
//print_r($result);
//fetch tha data from the database
while ($row = mysql_fetch_array($result)) {
   //echo "Product ID:".$row['meta_value']."<br>";
   //echo "Post Date:".$row['post_date']."<br>";
   $query = "SELECT * FROM wp_posts where ID=".$row['meta_value']; 
   
   $resultant = mysql_query($query); 
   $row_duration = mysql_fetch_array($resultant);
   //echo "Duration:".$row_duration['duration']."<br/>";
   //post_date contains product ordered date
    $originalDate = $row['post_date'];
    $newDate = date("Y-m-d", strtotime($originalDate));
    
            $duration_time=$row_duration['duration'];
            if($duration_time=="7")
            {
                $effectiveDate = strtotime("+1 Week", strtotime($newDate));
                $effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
            }    
            elseif($duration_time=="14")
            {
                $effectiveDate = strtotime("+2 weeks", strtotime($newDate));
                $effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
            }
            elseif($duration_time=="21")
            {
                $effectiveDate = strtotime("+3 weeks", strtotime($newDate));
                $effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
            }
            elseif($duration_time=="1")
            {
                $effectiveDate = strtotime("+1 month", strtotime($newDate));
                $effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
            }
            elseif($duration_time=="2")
            {
                $effectiveDate = strtotime("+2 months", strtotime($newDate));
                $effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
            }
            elseif($duration_time=="3")
            {
                $effectiveDate = strtotime("+3 months", strtotime($newDate));
                $effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
            }
            elseif($duration_time=="4")
            {
                $effectiveDate = strtotime("+4 months", strtotime($newDate));
                $effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
            }
            elseif($duration_time=="5")
            {
                $effectiveDate = strtotime("+5 months", strtotime($newDate));
                $effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
            }
            elseif($duration_time=="6")
            {
                $effectiveDate = strtotime("+6 months", strtotime($newDate));
                $effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
            }
            elseif($duration_time=="12")
            {
                $effectiveDate = strtotime("+1 year", strtotime($newDate));
                $effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
            }
            elseif($duration_time=="24")
            {
                $effectiveDate = strtotime("+2 years", strtotime($newDate));
                $effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
            }
            elseif($duration_time=="36")
            {
                $effectiveDate = strtotime("+3 years", strtotime($newDate));
                $effectiveDate = strftime ( '%Y-%m-%d' , $effectiveDate );
            }
            else
            {    
                $effectiveDate="";
            }    
    
    //echo "Course Complete Date:".$effectiveDate."<br/>";
    $today = date("Y-m-d");   

    require_once("course.php");
    $course_obj=new Course();
    //echo $row['ID'];     
    $user_query = "SELECT * FROM wp_postmeta where meta_key='_customer_user' and post_id=".$row['ID']; 
    $user_result = mysql_query($user_query); 
    $user_detail = mysql_fetch_array($user_result);

    //Course Ordered User Id
    //echo "<br/>---------User_Id:".$user_detail['meta_value']."--------<br/>";

    $get_lmsid_query="select lms_id from wp_posts where ID=".$row['meta_value'];
    $lms_result = mysql_query($get_lmsid_query); 
    $get_lmsid = mysql_fetch_array($lms_result);

    //Course lms Id
    //echo "Course lms Id:".$get_lmsid['lms_id']."<br/>";

    $get_userlmsid_query="select user_lms from wp_users where ID=".$user_detail['meta_value'];
    $user_lms_result = mysql_query($get_userlmsid_query); 
    $get_userlmsid = mysql_fetch_array($user_lms_result);

    //User Lms Id
    //echo "User lms Id:".$get_userlmsid['user_lms']."<br/>";
   
    $get_enrollid_query="select * from wp_enrollment where user_id=".$user_detail['meta_value'];
    $course_enroll_result = mysql_query($get_enrollid_query); 
    $get_enrollment_id = mysql_fetch_array($course_enroll_result);
    //Get enrollment id
    //echo "************Enrollment ID:".$get_enrollment_id['enrollment_id']."************<br/>";
 
    


    if((strtotime($today) > strtotime($effectiveDate)) && $effectiveDate!="")
    {
       $courses=$course_obj->conclude_enrollment($get_lmsid['lms_id'],$get_enrollment_id['enrollment_id']);
       $user_alumni=$course_obj->alumni_user($get_lmsid['lms_id'],$get_userlmsid['user_lms']);
       echo "<br/>------------------Completed--------------<br/>";
    }   
    
}
$Completed_date = date('m/d/Y h:i:s');
$file = fopen("/var/www/cron.log","a");

       echo "----Completed_date----".$Completed_date;
        echo fwrite($file,$Completed_date."\n");
        fclose($file);
?>
