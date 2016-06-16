<?php

include('lib/runkeeperAPI.php');
include('lib/integration.php');
include('lib/activities.php');

//include('lib/config.php');

/* API initialization */
$rkAPI = new runkeeperAPI();

$integration = new integration();

$cookie_name = "USER_UID";

/* After connecting to Runkeeper and allowing your app, user is redirected to redirect_uri param (as specified in YAML config file) with $_GET parameter "code" */
if ($_GET['code']) {
	$auth_code = $_GET['code'];

	if ($rkAPI->getRunkeeperToken($auth_code) == false) {
		echo $rkAPI->api_last_error; /* get access token problem */
		exit();
	}
	else {
		$uid = $_COOKIE[$cookie_name];
		$integration = $integration->getIntegrationByUserIdAndAppId($uid, 1);
		if (empty($integration->iid)){
			//It's saving ONLY RunKeeper
			$integration->insertIntegration(1, $uid, $rkAPI->access_token);
		}
		
		//Add last Activity just for test
		$rkActivities = $rkAPI->getLastActivity();
		
		$activities = new activities();
		
		$activities = $activities->getLastActivityByIntegrationId($integration->iid);
		
		if (empty($activities->aid)) {
			$activities->insertActivity(
					$integration->iid,
					strtotime($rkActivities['items'][0]['start_time']),
					$rkActivities['items'][0]['type'],
					$rkActivities['items'][0]['total_distance'],
					$rkActivities['items'][0]['total_calories']);
		}		
	}		
}

header("location:app.php");

