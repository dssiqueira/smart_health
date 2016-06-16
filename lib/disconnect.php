<?php

require_once('config.php');

require_once('integration.php');

session_start();

if (!isset($_POST['appid']) || !isset($_SESSION['USER_UID'])){
	header('location:/error.php');
}


$uid = $_SESSION['USER_UID'];
$appid = $_POST['appid'];

$integration = new integration();

if ($integration->delete($uid, $appid)) {
	header('location:/app.php');
} else {
	header('location:/error.php');
}