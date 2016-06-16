<?php

require_once('config.php');

class activities
{
	public $aid = null;
	public $iid = null;
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
		$search = new mysqlConnection;		
		$query  = 'SELECT aid, iid, date, type, distance, calories FROM activities WHERE iid = ' . $iid;
		$result = $search->mysqlQuery($query);
	
		$activities = new activities();
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$activities->aid          = $row["aid"];
				$activities->iid          = $row["iid"];
				$activities->date        = $row["date"];
				$activities->type         = $row["type"];
				$activities->distance   = $row["distance"];
				$activities->calories   = $row["calories"];
			}
		}
	
		return $activities;
	}
	
	public function insertActivity ($iid, $date, $type, $distance, $calories)
	{
		$insert = new mysqlConnection;
		$query  = 'INSERT INTO activities (iid, date, type, distance, calories) VALUE (' . $iid . ',' . $date . ', "' . $type . '", ' . $distance . ', ' . $calories . ')';
		$insert->mysqlQuery($query);
	}
	
}