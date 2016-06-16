<?php

session_start();

if (!isset($_POST['appid']) || !isset($_SESSION['USER_UID'])){
	header('location:/error.php');
}


$uid = $_SESSION['USER_UID'];
$appid = 1; //RunKeeper


require_once('lib/config.php');

require_once('lib/runkeeperAPI.php');
require_once('lib/integration.php');
require_once('lib/activities.php');

/* API initialization */
$rkAPI = new runkeeperAPI();

$integration = new integration();

/* After connecting to Runkeeper and allowing your app, user is redirected to redirect_uri param (as specified in YAML config file) with $_GET parameter "code" */
if ($_GET['code']) {
	$auth_code = $_GET['code'];

	if ($rkAPI->getRunkeeperToken($auth_code) == false) {
		echo $rkAPI->api_last_error; /* get access token problem */
		exit();
	}
	else {
		
		$integration = $integration->getIntegrationByUserIdAndAppId($uid, $appid);
				
		if (empty($integration->iid)){
			//It's saving ONLY RunKeeper
			$integration->insertIntegration(1, $uid, $rkAPI->access_token);
		} else if ($integration->deleted == 1){
			$integration->activate($integration->uid, $integration->appid);
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

header("location:/app.php?connect=RunKeeper");

