<?php

/*
 * ActivityModel
 * @author hguidi
 */
class ActivityModel extends Model {
	public $id = null;
	public $integration_id = null;
	public $date = null;
	public $type = null;
	public $distance = null;
	public $calories = null;

	/*
	 * @todo create method
	 */
	public function getAllActivities() {
		// TODO
	}
	
	/*
	 * @method getLastActivityByIntegrationId
	 * @author hguidi
	 * @param $iid
	 * @return activity [id, integration_id, start_date, type, distance, calories]
	 */
	public function getLastActivityByIntegrationId($iid) {
		$sql = "SELECT id, integration_id, start_date, type, distance, calories FROM activities WHERE integration_id = :integration_id ORDER BY start_date desc";
		$query = $this->db->prepare ( $sql );
		$parameters = array (
				':integration_id' => $iid 
		);
		$query->execute ( $parameters );
		
		return $query->fetch ();
	}
	
	/*
	 * @method insertActivity
	 * @author hguidi
	 * @param $iid, $date, $type, $distance, $calories
	 * @return boolean
	 */
	public function insertActivity($iid, $date, $type, $distance, $calories) {
		$act = $this->getLastActivityByIntegrationId ( $iid );
		if (! is_null ( $act->id ) && ($act->start_date == $date)) {
			// Already saved, nothing to do
			return false;
		}
		if (is_null($distance) or $distance <= 0) {
			// at least distance we should have! =(
			return false;
		}
		if (!isset($calories)){
			$calories = 0;
		}
		
		$sql = "INSERT INTO activities (integration_id, start_date, type, distance, calories, created_at, updated_at) VALUE (:integration_id, :date, :type, :distance, :calories, NOW(), NOW())";
		$parameters = array (
				':integration_id' => $iid,
				':date' => $date,
				':type' => $type,
				':distance' => $distance,
				':calories' => $calories 
		);
		$query = $this->db->prepare ( $sql );
		
		$query->execute ( $parameters );
		
		return true;
	}

	/*
	 * @method getTotalDistance
	 * @author hguidi
	 * @param 
	 * @return integer
	 */
	public function getTotalDistance() {
		$sql = "SELECT sum(distance)  as sum FROM activities WHERE deleted = :deleted";
		$parameters = array (
			':deleted' => 0
		);
		
		$query = $this->db->prepare ( $sql );
		$query->execute ( $parameters );
		
		return $query->fetch ();
	}

}