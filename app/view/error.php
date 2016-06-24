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
					background: url('/img/error.gif') center/cover;
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
						<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href='#' onClick="history.go(-1);"> Back </a>
						<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href='#' onClick="signOut()"> Sign Out </a>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>			
</body>
</html>
