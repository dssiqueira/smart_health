<?php
error_reporting(E_ERROR);

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
        $query  = 'INSERT INTO INTEGRATION (appid,uid,token) VALUE (1,5, "' . $rkAPI->access_token . '")';
		var_dump($query);
        $insert->mysqlQuery($query);
		echo "ok o token é >>>>> " . $rkAPI->access_token;
	}
}
?>
