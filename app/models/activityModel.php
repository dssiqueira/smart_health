<?php

class ActivityModel extends Model
{
	public $id = null;
	public $integration_id = null;
	public $date = null;
	public $type = null;
	public $distance = null;
	public $calories = null;
	
	
	public function getAllActivities()
	{
		//TODO	
	}
	
	public function getLastActivityByIntegrationId($iid)
	{
		$sql  = "SELECT id, integration_id, start_date, type, distance, calories FROM activities WHERE integration_id = :integration_id ORDER BY start_date desc";
		$query = $this->db->prepare($sql);
		$parameters = array(':integration_id' => $iid);
		$query->execute($parameters);
		
		return $query->fetch();
		
	}
	
	
	public function insertActivity ($iid, $date, $type, $distance, $calories)
	{
		$act = $this->getLastActivityByIntegrationId($iid);
		if (!is_null($act->id) && ($act->start_date == $date)){
			// Already saved, nothing to do
			return false;
		}
		
		$sql  = "INSERT INTO activities (integration_id, start_date, type, distance, calories, created_at, updated_at) VALUE (:integration_id, :date, :type, :distance, :calories, NOW(), NOW())";
		$parameters = array(':integration_id' => $iid, ':date' => $date, ':type' => $type, ':distance' => $distance, ':calories' => $calories);
		$query = $this->db->prepare($sql);
		
		$query->execute($parameters);
		
		return true;
	}
	
}