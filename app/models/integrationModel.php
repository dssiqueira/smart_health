<?php

class IntegrationModel extends Model
{
	public $id = null;
	public $app_id = null;
	public $user_id = null;
	public $token = null;
	public $deleted = null;
	
	public function getIntegrationByUserIdAndAppId($uid, $appid, $deleted = null)
	{
		if (is_null($deleted)) {
			$sql  = "SELECT id, app_id, user_id, token, deleted FROM integrations WHERE user_id = :user_id AND app_id = :app_id";
			$parameters = array(':user_id' => $uid, ':app_id' => $appid);
		} else {
			$sql  = "SELECT id, app_id, user_id, token FROM integrations WHERE user_id = :user_id AND app_id = :app_id AND deleted = :deleted";
		    $parameters = array(':user_id' => $uid, ':app_id' => $appid, ':deleted' => $deleted);
		}
		$query = $this->db->prepare($sql);
		$query->execute($parameters);
		
		return $query->fetch();		
	}

	public function insertIntegration($appid, $uid, $token){
		
		$integr = $this->getIntegrationByUserIdAndAppId($uid, $appid); 
		
		if (!empty($integr->id)) {
			$sql  = "UPDATE integrations SET token = :token, deleted = 0, updated_at = NOW() WHERE app_id = :app_id AND user_id = :user_id";
		} else {
			$sql  = "INSERT INTO integrations (app_id, user_id, token, created_at, updated_at) VALUE (:app_id, :user_id, :token, NOW(), NOW())";
		}
		
		$parameters = array(':app_id' => $appid, ':user_id' => $uid, ':token' => $token);
		$query = $this->db->prepare($sql);
		
		$query->execute($parameters);
	}
	
	public function getAllAppsByUserId($uid){
		
		$sql  = "SELECT app_id FROM integrations WHERE deleted = 0 and user_id = :user_id";
		$parameters = array(':user_id' => $uid);
		$query = $this->db->prepare($sql);
		$query->execute($parameters);
	
		return $query->fetchAll();		
	}
	
	
	public function delete($uid, $appid){
		
		$sql  = "UPDATE integrations SET deleted = 1, updated_at = NOW() WHERE user_id = :user_id AND app_id = :app_id";		
		$parameters = array(':user_id' => $uid, ':app_id' => $appid);
		$query = $this->db->prepare($sql);
		
		$query->execute($parameters);		
	}
	
}