<?php
class integration
{
	public $iid = null;
	public $appid = null;
	public $uid = null;
	public $token = null;
	public $deleted = null;
	
	public function getIntegrationByUserIdAndAppId($uid, $appid)
	{
		$search = new mysqlConnection;
		$integration = new integration;
		$query  = 'SELECT iid, appid, uid, token, deleted FROM integration WHERE uid = "' . $uid . '" and appid = ' . $appid;
		$result = $search->mysqlQuery($query);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$integration->iid = $row["iid"];
				$integration->appid = $row["appid"];
				$integration->uid = $row["uid"];
				$integration->token = $row["token"];
				$integration->deleted = $row["deleted"];
				
			}
		}

		return $integration;
	}
	
	public function insertIntegration($appid, $uid, $token){
		$insert = new mysqlConnection;
        $query  = 'INSERT INTO integration(appid,uid,token) VALUE (' . $appid . ',' . $uid . ', "' . $token . '")';
        $insert->mysqlQuery($query);
	}
	
	public function getAllAppsByUserId($uid){
		$search = new mysqlConnection;
		$query  = 'SELECT appid FROM integration WHERE deleted = 0 and uid = ' . $uid;
		$result = $search->mysqlQuery($query);

		$ret[] = null;
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
			  $ret[$row['appid']] = $row['appid'];	
		  	}
		}
		return $ret;
	}
	
	public function activate($uid, $appid){
		$sql = new mysqlConnection;
		$query  = 'UPDATE integration SET deleted = "0" WHERE uid = ' . $uid . ' and appid = ' . $appid;
		
		return $sql->mysqlQuery($query);
	}
	
	public function delete($uid, $appid){
		$sql = new mysqlConnection;
		$query  = 'UPDATE integration SET deleted = "1" WHERE uid = ' . $uid . ' and appid = ' . $appid;

		return $sql->mysqlQuery($query);		
	}
	
}