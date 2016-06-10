<?php
	session_start();

	//include('lib/smartCanvasAPI.php');
	include('lib/user.php');
	
  	//$post = new smartCanvasAPI;
	
	$cookie_name = "USER_UID";
	$user = new user();
	
	$email = null;
	
	//Check logged user by POST, SESSION or COOKIE
	if (isset($_POST['email'])){
		$email = $_POST['email'];
    } else if (isset($_SESSION['USER_UID'])){
    	$user = $user->getUserById($_SESSION['USER_UID']);
    } else if (isset($_COOKIE[$cookie_name])) {
    	$user = $user->getUserById($_COOKIE[$cookie_name]);
    } else {
    	header("location:index.php");
    }
    
	if (empty($user->email) && !empty($email)){
    	$user = $user->getUserByEmail($email);
	}
	
	if(empty($user->uid) && !empty($email)){
		$name = $_POST['name'];
		$path_image = $_POST['image'];
		$user->insertUser($email, $name, $path_image);
		$user = $user->getUserByEmail($email);
	}
	
	//Save userId in Session
	$_SESSION['USER_UID'] = $user->uid;
	
	//Save userId in Cookie
	$_COOKIE[$cookie_name] = $user->uid;
?>
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
        html {
            
        }
        .card-square.mdl-card {
        width: 320px;
        height: 320px;
        }
        .card-square > .mdl-card__title {
        background:
            url('images/dog.png') bottom right 15% no-repeat #46B6AC;
        }
        .counter {
            position: absolute;
            right: 20px;
            padding-top: 10px;
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
        <!-- Always shows a header, even in smaller screens. -->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">

		  <header class="mdl-layout__header" style="color: #fff">
		    <div class="mdl-layout__header-row">
		      <!-- Title -->
		      <span class="mdl-layout-title"><img src="/images/CIT.png" width="80px"></img>Health</span>
		      <!-- Add spacer, to align navigation to the right -->
		      <div class="mdl-layout-spacer"></div>
		      <!-- Navigation. We hide it in small screens. -->
		      <nav class="mdl-navigation mdl-layout--large-screen-only">
		        <a class="mdl-navigation__link" href="/app.php">Home</a>
		        <a class="mdl-navigation__link" href="/about.php">About</a>
		        <a class="mdl-navigation__link" href="/next-step.php">Next Steps</a>
		        <a class="mdl-navigation__link" href="#" onclick="signOut();">Sign Out</a>
		      </nav>
		      <img src="<?php print $user->path_image;?>" style="width: 50px;border-radius: 30px;"></img>
		    </div>
		  </header>
		  <div class="mdl-layout__drawer">
		    <span class="mdl-layout-title">Health</span>
		    <nav class="mdl-navigation">
		      <a class="mdl-navigation__link" href="/app.php">Home</a>
		      <a class="mdl-navigation__link" href="/about.php">About</a>
		      <a class="mdl-navigation__link" href="/next-step.php">Next Step</a>
		      <a class="mdl-navigation__link" href="#" onclick="signOut();">Sign Out</a>
		    </nav>
		  </div>
		  
            <main class="mdl-layout__content">
                <div class="page-content">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h5>one step at a time</h5>
                            <h2>First, Connect your App</h2>
                            <h6>Before start run or ride, let us know where we can track your stats..</h6>
                        </div>
                    </div>
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--4-col">
                            <div class="card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/strava.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Strava</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Connect</button>
                                </div>
                            </div> 
                        </div>
                        <div class="mdl-cell mdl-cell--4-col">
                            <div class="card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/runkeeper.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Runkeeper</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
								    <a href="https://runkeeper.com/apps/authorize?response_type=code&client_id=8ca1c685ee4a4ad88ffcddfe24f3d0cf&redirect_uri=https%3A%2F%2Fssl-310157.uni5.net%2FsaveIntegration.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Connect</a>
                                </div>
                            </div> 
                        </div>
                        <div class="mdl-cell mdl-cell--4-col">
                            <div class="card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/nikerunning.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Nike + Running</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
								    <button class="mdl-button mdl-js-button mdl-button--raised" disabled>Developing</button>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h2>Ok, now you can go outside</h2>
                            <h6>Go Forrest, go!</h6>
                        </div>
                    </div>
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h2>Isn't that your favorite App?</h2>
                            <h6>Help us to identify where focus our effort by voting on your favorite App...</h6>
                        </div>
                    </div>
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--3-col">
                            <div class="card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/googlefit.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Google Fit</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">-</i></button>
                                    <span class="counter">(0)</span>
                                </div>
                            </div> 
                        </div>
                        <div class="mdl-cell mdl-cell--3-col">
                            <div class="card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/adidas.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Adidas Run</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">+</i></button>
                                    <span class="counter">(0)</span>
                                </div>
                            </div> 
                        </div>
                        <div class="mdl-cell mdl-cell--3-col">
                            <div class="card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/mapmyrun.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">MapMyRun</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">+</i></button>
                                    <span class="counter">(0)</span>
                                </div>
                            </div> 
                        </div>
                        <div class="mdl-cell mdl-cell--3-col">
                            <div class="card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/endomondo.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Endomondo</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">+</i></button>
                                    <span class="counter">(0)</span>
                                </div>
                            </div> 
                        </div>
                        <div class="mdl-cell mdl-cell--3-col">
                            <div class="card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/runtastic.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Runtastic</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">+</i></button>
                                    <span class="counter">(0)</span>
                                </div>
                            </div> 
                        </div>
                    </div>  
                    <div class="mdl-grid" style="background-color: rgb(224, 224, 224); text-align: center;">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h6><?php print date('Y');?></h6>
                        </div>
                    </div>   
                </div>
            </main>
        </div>
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
    </body>
</html>