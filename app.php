<?php
var_dump($_POST);
  include('runkeeperAPI.class.php');

  $rkAPI = new runkeeperAPI('config/rk-api.sample.yml');
  if ($_GET['code']) {
  	$auth_code = $_GET['code'];
  	if ($rkAPI->getRunkeeperToken($auth_code) == false) {
  		echo $rkAPI->api_last_error; /* get access token problem */
  		exit();
  	}
  	else {
  		/* Your code to store $rkAPI->access_token (client-side, server-side or session-side) */
  		/* Note: $rkAPI->access_token will have to be set et valid for following operations */

  		/* Do a "Read" request on "Profile" interface => return all fields available for this Interface */
  		$rkProfile = $rkAPI->doRunkeeperRequest('Profile','Read');
  		print_r($rkProfile);

  		/* Do a "Read" request on "Settings" interface => return all fields available for this Interface */
  		$rkSettings = $rkAPI->doRunkeeperRequest('Settings','Read');
  		print_r($rkSettings);

  		/* Do a "Read" request on "FitnessActivities" interface => return all fields available for this Interface or false if request fails */
  		$rkActivities = $rkAPI->doRunkeeperRequest('FitnessActivities','Read');
  		if ($rkActivities) {
  			print_r($rkActivities);
  		}
  		else {
  			echo $rkAPI->api_last_error;
  			print_r($rkAPI->request_log);
  		}

  		/* Do a "Read" request on "FitnessActivityFeed" interface => return all fields available for this Interface or false if request fails */
  		$rkActivities = $rkAPI->doRunkeeperRequest('FitnessActivityFeed','Read');
  		if ($rkUpdateActivity) {
  			print_r($rkUpdateActivity);
  		}
  		else {
  			echo $rkAPI->api_last_error;
  			print_r($rkAPI->request_log);
  		}

  		/* Do a "Create" request on "FitnessActivity" interface with fields => return created FitnessActivity content if request success, false if not */
  		$fields = json_decode('{"type": "Running", "equipment": "None", "start_time": "Sat, 1 Jan 2011 00:00:00", "notes": "My first late-night run", "path": [{"timestamp":0, "altitude":0, "longitude":-70.95182336425782, "latitude":42.312620297384676, "type":"start"}, {"timestamp":8, "altitude":0, "longitude":-70.95255292510987, "latitude":42.31230294498018, "type":"end"}], "post_to_facebook": true, "post_to_twitter": true}');
  		$rkCreateActivity = $rkAPI->doRunkeeperRequest('NewFitnessActivity','Create',$fields);
  		if ($rkCreateActivity) {
  			print_r($rkCreateActivity);
  		}
  		else {
  			echo $rkAPI->api_last_error;
  			print_r($rkAPI->request_log);
  		}
  	}
  }

  echo "Token: " . $token;


  $name   = $_POST['name'];
  $image  = $_POST['image'];
?>
<html>
<head>
  <?php include 'inc/header.inc' ;?>
</head>
  <body>
	<!-- Header -->
		<div id="header">
			<div id="nav-wrapper">
				<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">Next Step</a></li>
						<li class="active"><a href="#" onclick="signOut();">Sign out</a></li>
					</ul>
				</nav>
			</div>
			<div class="container">
				<!-- Logo -->
				<div id="logo">

          <h1><a href="#"><img src="<?php print $image; ?>"></img></a></h1>
					<span class="tag"><?php print $name?></span>
				</div>
			</div>
		</div>
	<!-- Header -->
  <!-- Featured -->
  		<div id="featured">
  			<div class="container">
  				<header>
  					<h2>Connect Your App</h2>
  				</header>
  				<p>Every day we get the information so your application to add to our database automatically. So run and enjoy!</p>
  				<hr />
  				<div class="row">
  					<section class="12u">
  						<span class="pennant"><img src="images/runkeeper.png" width="100px"></img></span>
  						<h3>Runkeeper</h3>
              <a href="https://runkeeper.com/apps/authorize?client_id=8ca1c685ee4a4ad88ffcddfe24f3d0cf&scope=&state=4082225&redirect_uri=https%3A%2F%2Fssl-310157.uni5.net%2Fapp.php&response_type=code" class="button button-style1">Connect</a>
  					</section>
  				</div>
  			</div>
  		</div>
      <div id="featured">
  			<div class="container">
  				<header>
  					<h2>Next Integration</h2>
  				</header>
  				<p>Choose application integration. Your opinion is important.</p>
  				<hr />
  				<div class="row">
  					<section class="2u">
  						<span class="pennant"><img src="images/strava.png" width="100px"></img></span>
  						<h3>Strava</h3>
              <a href="" class="button button-style1">Connect</a>
  					</section>
            <section class="2u">
  						<span class="pennant"><img src="images/nikerunning.png" width="100px"></img></span>
  						<h3>Nike + Running</h3>
              <a href="" class="button button-style1">Connect</a>
  					</section>
            <section class="2u">
  						<span class="pennant"><img src="images/adidas.jpeg" width="100px"></img></span>
  						<h3>Adidas train & run</h3>
              <a href="" class="button button-style1">Connect</a>
  					</section>
            <section class="2u">
  						<span class="pennant"><img src="images/mapmyrun.png" width="100px"></img></span>
  						<h3>MapMyRun</h3>
              <a href="" class="button button-style1">Connect</a>
  					</section>
            <section class="2u">
  						<span class="pennant"><img src="images/endomondo.png" width="100px"></img></span>
  						<h3>Endomondo</h3>
              <a href="" class="button button-style1">Connect</a>
  					</section>
            <section class="2u">
  						<span class="pennant"><img src="images/runtastic.png" width="100px"></img></span>
  						<h3>Runtastic</h3>
              <a href="" class="button button-style1">Connect</a>
  					</section>
  				</div>
  			</div>
  		</div>
	<!-- Tweet -->
		<div id="tweet">
			<div class="container">
				<section>
					<blockquote>&ldquo;Run, Forrest, Run!&rdquo;</blockquote>
				</section>
			</div>
		</div>
	<!-- /Tweet -->
  <script>
    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
      });
    }
  </script>
  </body>
</html>
