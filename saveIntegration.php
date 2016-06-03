<?php
require('lib/runkeeperAPI.class.php');
require('lib/config.php');

/* API initialization */
$rkAPI = new runkeeperAPI();

/* After connecting to Runkeeper and allowing your app, user is redirected to redirect_uri param (as specified in YAML config file) with $_GET parameter "code" */
if ($_GET['code']) {
	$auth_code = $_GET['code'];

	if ($rkAPI->getRunkeeperToken($auth_code) == false) {
		echo $rkAPI->api_last_error; /* get access token problem */
		exit();
	}
	else {
		$insert = new mysqlConnection;
        $query  = 'INSERT INTO integration(appid,uid,token) VALUE (1,1, "' . $rkAPI->access_token . '")';
        $insert->mysqlQuery($query);
		header("location:app.php");
	}
}
?>
