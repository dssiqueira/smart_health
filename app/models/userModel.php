<?php

/*
 * UserModel
 * @author hguidi
 */
class UserModel extends Model {
	public $id;
	public $email;
	public $name;
	public $image_path;
	public $remember_token;
	public function getUserByEmail($email) {
		$sql = "SELECT id, email, name, image_path, role, remember_token FROM users WHERE email = :email";
		$query = $this->db->prepare ( $sql );
		$parameters = array (
				':email' => $email 
		);
		$query->execute ( $parameters );
		
		return $query->fetch ();
	}
	
	/*
	 * @method getUserById
	 * @author hguidi
	 * @param $id, deleted = null
	 * @return user [id, email, name, image_path, role, remember_token]
	 */
	public function getUserById($uid, $deleted = null) {
		if (is_null($deleted)) {
			$sql = "SELECT id, email, name, image_path, role, remember_token FROM users WHERE id = :uid";
			$parameters = array (
					':uid' => $uid
			);
		} else {
			$sql = "SELECT id, email, name, image_path, role, remember_token FROM users WHERE id = :uid AND deleted = :deleted";
			$parameters = array (
					':uid' => $uid,
					':deleted' => $deleted
			);
		}
		
		$query = $this->db->prepare ( $sql );
		$query->execute ( $parameters );
		
		return $query->fetch ();
	}
	
	/*
	 * @method getUserByToken
	 * @author hguidi
	 * @param $token
	 * @return user [id, email, name, image_path, role, remember_token]
	 */
	public function getUserByToken($token) {
		$sql = "SELECT id, email, name, image_path, role, remember_token FROM users WHERE remember_token = :token";
		$query = $this->db->prepare ( $sql );
		$parameters = array (
				':token' => $token 
		);
		$query->execute ( $parameters );
		
		return $query->fetch ();
	}
	
	/*
	 * @method getAllUsers
	 * @author hguidi
	 * @return List of all users without where clasule
	 */
	public function getAllUsers() {
		$sql = "SELECT id, email, name, image_path, role, remember_token, created_at, updated_at, deleted FROM users";
		$query = $this->db->prepare ( $sql );
		$query->execute ();
		
		return $query->fetchAll ();
	}
	
	/*
	 * @method insertUser
	 * @author hguidi
	 * @param $email, $name, $image_path
	 * @return boolean 
	 */
	public function insertUser($email, $name, $image_path) {
		$user = $this->getUserByEmail ( $email );
		if (! is_null ( $user->id )) {
			$sql = "UPDATE users SET deleted = 0, name = :name, image_path = :image_path, updated_at = NOW() WHERE email = :email";
			$parameters = array (
					':email' => $email,
					':name' => $name,
					':image_path' => $image_path 
			);
		} else {
			$sql = "INSERT INTO users (email, name, image_path, remember_token, role, created_at, updated_at) VALUES (:email, :name, :image_path, :token, :role, NOW(), NOW())";
			$parameters = array (
					':email' => $email,
					':name' => $name,
					':image_path' => $image_path,
					':token' => md5 ( uniqid ( $email, true ) ),
					':role' => ROLE_USER 
			);
		}
		
		$query = $this->db->prepare ( $sql );
		
		return $query->execute ( $parameters );
	}

	/*
	 * @method getUsersCount
	 * @author hguidi
	 * @param 
	 * @return integer
	 */
	public function getUsersCount() {
		$sql = "SELECT count(*)  as count FROM users WHERE deleted = :deleted";
		$parameters = array (
			':deleted' => 0
		);
		
		$query = $this->db->prepare ( $sql );
		$query->execute ( $parameters );
		
		return $query->fetch ();
	}

	/*
	 * @method getLastUsers
	 * @author hguidi
	 * @param numberOfUsers
	 * @return integer
	 */
	public function getLastUsers($numberOfUsers) {
		$sql = "SELECT name, email, image_path FROM users as r1 JOIN (SELECT CEIL(RAND() * (SELECT MAX(id) FROM users)) AS id) AS r2 WHERE r1.id >= r2.id and r1.deleted = 0 ORDER BY r1.id ASC LIMIT ".$numberOfUsers.";";
		$query = $this->db->prepare ( $sql );
		$query->execute ();

		return $query->fetchAll ();
	}	

}