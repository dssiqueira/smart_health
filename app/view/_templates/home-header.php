<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="CI&T Health">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
	<title>CI&amp;T Health</title>

	<!-- Page styles -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="/css/material.min.css" type='text/css'>
	<link rel="stylesheet" href="/css/bootstrap.min.css" type='text/css'>
	<link rel="stylesheet" href="/css/styles.css" type='text/css'>
	<link rel="stylesheet" href="/css/roboto.css" type='text/css'>

	<meta name="google-signin-client_id" content="1004959689078-0tc7p0enbjr3eq9h2p2j72pmt1g0g7u2.apps.googleusercontent.com">

	<script>
		function signOut() {
			var auth2 = gapi.auth2.getAuthInstance();
			auth2.signOut().then(function () {
				window.location = "/";
			});
			auth2.disconnect();
		}
	    function onLoad() {
	    	gapi.load('auth2', function() {
	        	gapi.auth2.init();
	        });
	    }
	</script>
</head>

</head>
<body>
	<!-- Always shows a header, even in smaller screens. -->
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		<header class="mdl-layout__header ciandt-blue">
			<div class="mdl-layout__header-row">
				<!-- Title -->
				<div class="mdl-layout-title header-title">
				  <img src="/img/logo_cit2.png" width="15%">
				  <span> Health</span>
				</div>
				<!-- Add spacer, to align navigation to the right -->
				<div class="mdl-layout-spacer"></div>
				<!-- Navigation. We hide it in small screens. -->
				<nav class="mdl-navigation mdl-layout--large-screen-only">
					<a class="mdl-navigation__link" href="/home">Home</a>
					<a class="mdl-navigation__link" href="/home/nextstep">Next Step</a>
					<a class="mdl-navigation__link" href="#" onclick="signOut();">Sign Out</a>
				</nav>
				<div class="header-icon">
					<a href="<?php print SMARTCANVAS_PROFILE_URL . $user->email; ?>"
						target="_blank"><img src="<?php print $user->image_path;?>"></img></a>
				</div>
			</div>
		</header>
		<div class="mdl-layout__drawer">
			<span class="mdl-layout-title">Health</span>
			<nav class="mdl-navigation">
				<a class="mdl-navigation__link" href="/home">Home</a>
				<a class="mdl-navigation__link" href="/home/nextstep">Next Step</a> 
				<a class="mdl-navigation__link" href="#" onclick="signOut();">Sign Out</a>
			</nav>
		</div>
		<main>
        <div class="page-content">
          <div class="container">
            <!-- CONTENT -->