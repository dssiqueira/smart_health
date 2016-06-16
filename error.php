<?php
session_start();
include('lib/user.php');

$cookie_name 	= "USER_UID";
$user 			= new user();
$email 			= null;

//Check logged user by POST, SESSION or COOKIE
if (isset($_POST['email'])){
	$email = $_POST['email'];
} else if (isset($_SESSION['USER_UID'])){
	$user = $user->getUserById($_SESSION['USER_UID']);
} else if (isset($_COOKIE[$cookie_name])) {
	$user = $user->getUserById($_COOKIE[$cookie_name]);
}

if (empty($user->email) && !empty($email)){
	$user = $user->getUserByEmail($email);
}

if(empty($user->uid) && !empty($email)){
	$user = $user->getUserByEmail($email);
}
?>
<html>
	<head>
		<script src="https://apis.google.com/js/platform.js" async defer></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/material.css" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<meta name="google-signin-client_id" content="1004959689078-0tc7p0enbjr3eq9h2p2j72pmt1g0g7u2.apps.googleusercontent.com">        
		<style>
			body {
				background: #f3f3f3;
			}

			.container {
				display: table;
				position: absolute;
				height: 100%;
				width: 100%;				
			}
			.card-container{
				vertical-align: middle;
				display: table-cell;			
			}
			.card-wide.mdl-card {
				width: 50%;
				height: 450px;
				margin: auto;
				max-width: 500px;
				min-width: 350px;
			}
			.card-wide>.mdl-card__title {
				color: #fff;
				height: 80%;
				background: url('/images/error.gif') center/cover;
			}
			.card-wide>.mdl-card__menu {
				color: #fff;
			}
			.card-wide>.mdl-card__actions{
				text-align: center;
			}
		</style>
        <script>
		  function signOut() {
		    var auth2 = gapi.auth2.getAuthInstance();
		    auth2.signOut().then(function () {
		    	window.location = "/index.php";;
		    });
		  }
	      function onLoad() {
	        gapi.load('auth2', function() {
	          gapi.auth2.init();
	        });
	      }
		</script>
  </head>
  	<body>
	<!-- Header -->
	<div id="header">
		<div class="container">
			<div class="card-container">
				<div class="card-wide mdl-card mdl-shadow--8dp">
					<div class="mdl-card__title">
						<h2 class="mdl-card__title-text">Access denied!</h2>
					</div>
					<div class="mdl-card__supporting-text">Sorry! Only CI&T employees allowed here ;-)</div>
					<div class="mdl-card__actions mdl-card--border">
						<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href='/index.php'> Back </a>
						<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href='#' onClick="signOut()"> Sign Out </a>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>			
  </body>
</html>
