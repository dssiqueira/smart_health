<html>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css">
	<script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <head>
	    <script src="https://apis.google.com/js/platform.js" async defer></script>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
	    <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.light_blue-pink.min.css" />
	    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	    <meta name="google-signin-client_id" content="1004959689078-0tc7p0enbjr3eq9h2p2j72pmt1g0g7u2.apps.googleusercontent.com">        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style>        
        .card-square.mdl-card {
        width: 320px;
        height: 320px;
        }
        .card-square > .mdl-card__title {
        background:
            url('img/dog.png') bottom right 15% no-repeat #46B6AC;
        }
        .counter {
            position: absolute;
            right: 20px;
            padding-top: 10px;
        }
        
        .mdl-dialog {
        	width: 500px;
        	text-align: center;
        }
        </style>
        <script>
		  function signOut() {
		    var auth2 = gapi.auth2.getAuthInstance();
		    auth2.signOut().then(function () {
		    	window.location = "/";
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
        <!-- Always shows a header, even in smaller screens. -->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

		  <header class="mdl-layout__header" style="color: #fff">
		    <div class="mdl-layout__header-row">
		      <!-- Title -->
		      <span class="mdl-layout-title"><img src="/img/CIT.png" width="80px"></img>Health</span>
		      <!-- Add spacer, to align navigation to the right -->
		      <div class="mdl-layout-spacer"></div>
		      <!-- Navigation. We hide it in small screens. -->
		      <nav class="mdl-navigation mdl-layout--large-screen-only">
		        <a class="mdl-navigation__link" href="/home">Home</a>
		        <a class="mdl-navigation__link" href="/home/about">About</a>
		        <a class="mdl-navigation__link" href="/home/nextstep">Next Steps</a>
		        <a class="mdl-navigation__link" href="#" onclick="signOut();">Sign Out</a>
		      </nav>
		      <a href="<?php print SMARTCANVAS_PROFILE_URL . $user->email; ?>" target="_blank"><img src="<?php print $user->image_path;?>" style="width: 50px;border-radius: 30px;"></img>
		    </div>
		  </header>
		  <div class="mdl-layout__drawer">
		    <span class="mdl-layout-title">Health</span>
		    <nav class="mdl-navigation">
		      <a class="mdl-navigation__link" href="/home">Home</a>
		      <a class="mdl-navigation__link" href="/home/about">About</a>
		      <a class="mdl-navigation__link" href="/home/nextstep">Next Step</a>
		      <a class="mdl-navigation__link" href="#" onclick="signOut();">Sign Out</a>
		    </nav>
		  </div>
		  <main class="mdl-layout__content">
		    <div class="page-content">
		  
