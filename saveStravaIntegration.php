<?php

require_once('lib/config.php');

require_once('lib/stravaAPI.php');
require_once('lib/integration.php');
require_once('lib/activities.php');

/* API initialization */
$stravaAPI = new stravaAPI();

$integration = new integration();

$cookie_name = "USER_UID";

if ($_GET['code']) {
	$auth_code = $_GET['code'];

	if ($stravaAPI->getStravaToken($auth_code) == false) {
		echo $stravaAPI->api_last_error; /* get access token problem */
		exit();
	}
	else {
		$uid = $_COOKIE[$cookie_name];
		$integration = $integration->getIntegrationByUserIdAndAppId($uid, 2);
		if (empty($integration->iid)){
			//It's saving ONLY Strava
			$integration->insertIntegration(2, $uid, $stravaAPI->access_token);
		} else if ($integration->deleted == 1){
			$integration->activate($integration->uid, $integration->appid);
		}
		
		//Add last Activity just for test
		$stravaActivities = $stravaAPI->getLastActivity();
		
		$activities = new activities();
		
		$activities = $activities->getLastActivityByIntegrationId($integration->iid);
		
		if (empty($activities->aid)) {
			$activities->insertActivity(
					$integration->iid,
					strtotime($stravaActivities[0]['start_date_local']),
					$stravaActivities[0]['type'],
					$stravaActivities[0]['distance'],
					'0'); //no calories for Stravia =(
		}		
	}		
}

header("location:/app.php?connect=Strava");

