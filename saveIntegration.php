<?php
error_reporting(E_ERROR);

require('lib/runkeeperAPI.class.php');

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
		
		$servername = "localhost";
		$username = "root";
		$password = "root";
		$dbname = "runners";
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		$sql = 'INSERT INTO INTEGRATION (appid,uid,token) VALUE (1,1, "'.$rkAPI->access_token.'")';
		$result = $conn->query($sql);
		
		$conn->close();
		
		echo 'ok';
		
	}
}
?>
