<?php
require "Canvas.php";
class User extends Canvas{
	public $id;
	public $name;
	public $sortable_name;
	public $short_name;
	public $login_id;

	public static function load($item){
		$user=new User();
		$user->id 	   		 = $item['id'];
		$user->name 	     = $item['name'];
		$user->sortable_name = $item['sortable_name'];
		$user->short_name    = $item['short_name'];
		$user->login_id 	 = isset($item['login_id']) ? $item['login_id'] : null; 
		return $user;
	}	

	public function list_users($accountid){
		$response= $this->get_json("/accounts/".$accountid."/users");
		$users = array();		
		foreach($response as $item)
		{
			$users[] = User::load($item);
		}
		return $users;
	}
	
	public function create_user($accountid,$name,$unique_id,$password){
		$data = json_encode(array("user" => array("name" => $name),"pseudonym" => array("unique_id" => $unique_id,"password" => $password)));
		$response = $this->post_json("/accounts/".$accountid."/users",$data);
		$user = User::load($response);
		return $user;
	}

	public function update_user($id,$name){
		$data = json_encode(array("user" => array("name" => $name)));
		$response = $this->put_json("/users/".$id,$data);
		$user = User::load($response);
		return $user;
	}

	public function delete_user($account_id,$id){
		$response = $this->delete_json("/accounts/".$account_id."/users/".$id);
		var_dump($response);
		$user = User::load($response);
		return $user;
	}
}

?>