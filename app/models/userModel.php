<?php

class UserModel extends Model
{
	public $id;
	public $email;
	public $name;
	public $image_path;
	public $remember_token;
	
	public function getUserByEmail($email){
		
		$sql  = "SELECT id, email, name, image_path, role, remember_token FROM users WHERE email = :email";
		$query = $this->db->prepare($sql);
		$parameters = array(':email' => $email);
		$query->execute($parameters);
		
		return $query->fetch();
	}
	
	public function getUserById($uid){
		$sql  = "SELECT id, email, name, image_path, role, remember_token FROM users WHERE id = :uid";
		$query = $this->db->prepare($sql);
		$parameters = array(':uid' => $uid);
		$query->execute($parameters);
		
		return $query->fetch();
	}

	public function getUserByToken($token){
		$sql  = "SELECT id, email, name, image_path, role, remember_token FROM users WHERE remember_token = :token";
		$query = $this->db->prepare($sql);
		$parameters = array(':token' => $token);
		$query->execute($parameters);
	
		return $query->fetch();
	}
	
	public function getAllUsers(){
		$sql  = "SELECT id, email, name, image_path, role, remember_token, created_at, updated_at, deleted FROM users";
		$query = $this->db->prepare($sql);
		$query->execute();
	
		return $query->fetchAll();
	}
	
	
	public function insertUser($email, $name, $image_path){
	
		$user = $this->getUserByEmail($email);
		if (!is_null($user->id)){
			$sql  = "UPDATE users SET deleted = 0, name = :name, image_path = :image_path, updated_at = NOW() WHERE email = :email";
			$parameters = array(':email' => $email, ':name' => $name, ':image_path' => $image_path);
				
		} else {
			$sql  = "INSERT INTO users (email, name, image_path, remember_token, role, created_at, updated_at) VALUES (:email, :name, :image_path, :token, :role, NOW(), NOW())";				
			$parameters = array(':email' => $email, ':name' => $name, ':image_path' => $image_path, ':token' => md5(uniqid($email, true)), ':role' => ROLE_USER);
		}
		
		$query = $this->db->prepare($sql);
		
		$query->execute($parameters);
	}
}