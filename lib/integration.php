<?php
class integration
{
	public $iid = null;
	public $appid = null;
	public $uid = null;
	public $token = null;
	
	public function getIntegrationByUserIdAndAppId($uid, $appid)
	{
		$search = new mysqlConnection;
		$integration = new integration;
		$query  = 'SELECT iid, appid, uid, token FROM integration WHERE uid = "' . $uid . '" and appid = ' . $appid;
		$result = $search->mysqlQuery($query);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$integration->iid          = $row["iid"];
				$integration->appid        = $row["appid"];
				$integration->uid         = $row["uid"];
				$integration->token   = $row["token"];
			}
		}
		
		return $integration;
	}
	
	public function insertIntegration($appid, $uid, $token){
		$insert = new mysqlConnection;
        $query  = 'INSERT INTO integration(appid,uid,token) VALUE (' . $appid . ',' . $uid . ', "' . $token . '")';
        $insert->mysqlQuery($query);
	}
	
	
}