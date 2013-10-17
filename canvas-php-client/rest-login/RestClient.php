<?php
class RestClient
{
	public function login($username,$password)	{
		$config = parse_ini_file("config.ini");
  		$url = $config["url"];
		$data = array('username'=> $username,'password'=> $password);
	    $handle = curl_init();
	    curl_setopt($handle, CURLOPT_URL, $url);
	    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);
	    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($handle, CURLOPT_POST, true);
	    curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
	    return json_decode(curl_exec($handle),TRUE);
	}
}
?>