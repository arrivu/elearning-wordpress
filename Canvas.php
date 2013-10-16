<?php
//require( dirname(__FILE__) . '/wp-load.php' );
//echo "hiiiiii";
//exit();
class Canvas{


	function __construct($oauth_token = "", $api_root_url = ""){
		$config = parse_ini_file("config.ini");
    	$tokenid = $config["canvastoken"];
    	$canvas_url=$config["canvasurl"]."/api/v1";
    	$this->oauth_token = $tokenid;
		$this->api_root_url = $canvas_url;	
	}

	public function get_json($url){
		$handle = curl_init();
		//echo "hiiiiiiiii".$this->api_root_url.$url;
		//exit();
		curl_setopt($handle, CURLOPT_URL, $this->api_root_url.$url."?access_token=".$this->oauth_token);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
		$response= json_decode(curl_exec($handle),TRUE);
		curl_close($handle);
		return $response;
	}

	public function post_json($url,$data){
		$handle = curl_init();
		$headers = array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer '.$this->oauth_token
		);
		curl_setopt($handle, CURLOPT_URL, $this->api_root_url.$url);
		curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($handle, CURLOPT_POST, true);
		curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
        $response = json_decode(curl_exec($handle),TRUE);
        curl_close($handle);
        return $response;
	}

	public function put_json($url,$data){
		$handle = curl_init();
		$headers = array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer '.$this->oauth_token
		);
		curl_setopt($handle, CURLOPT_URL, $this->api_root_url.$url);
		curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
        $response = json_decode(curl_exec($handle),TRUE);
        curl_close($handle);
        return $response;
	}

	public function delete_json($url){
		$handle = curl_init();
		$headers = array(
			'Accept: application/json',
			'Content-Type: application/json',
			'Authorization: Bearer '.$this->oauth_token
		);
		curl_setopt($handle, CURLOPT_URL, $this->api_root_url.$url);
		curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
        $response = json_decode(curl_exec($handle),TRUE);
        curl_close($handle);
        return $response;
	}
	public function cas_logout(){
		
		$handle = curl_init();
		$headers = array('cookies '.$_COOKIE["tgt"]);
		echo $_COOKIE["tgt"];
		curl_setopt($handle, CURLOPT_URL, "https://cas.thecompellingimage.com/cas/api-logout");
		curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
		//curl_setopt($handle, CURLOPT_COOKIE, "tgt=".$_COOKIE["tgt"]);
		curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handle, CURLOPT_CUSTOMREQUEST, 'DELETE');
		curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 0);
        $response = json_decode(curl_exec($handle),TRUE);
        //echo $_COOKIE["tgt"];
        print_r($response);
       // exit();
        curl_close($handle);
        //return $response;
	}

}
?>