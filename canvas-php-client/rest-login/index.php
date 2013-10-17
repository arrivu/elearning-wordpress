<html>

  <head>
   <title>Test</title>
  </head>

  <body bgcolor="white">
<?php 

  if(isset($_POST['Submit'])){
    require "RestClient.php";
    $obj=new RestClient();    
    $response = $obj->login($_POST['email'],$_POST['encrypted_password']);
    if($response['type']=="confirmation"){
      setcookie("tgt",$response['tgt'],time()+3600*24,'/');
      header('Location: welcome.php');
    }else{
      echo "<h1 style='color:red;text-align:center'>Login Failed</h1>";
    }
  }
?>
  
  

  
<table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Member Login </strong></td>
</tr>
<tr>
<td width="78">Username</td>
<td width="6">:</td>
<td width="294"><input name="email" type="text" id="email" value="monickam@yahoo.com"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input name="encrypted_password" type="text" id="encrypted_password" value="$2a$10$YFZTbsb4kUue2Qw0FBWWM.GAGlLLQLqccDGOJ5/WWduxriPaj/b72"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Login"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>

  </body>

  </html>
