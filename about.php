<?php
	session_start();
	include('lib/user.php');

	
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
		<title>About CI&T Health</title>
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
						<div class="mdl-cell mdl-cell--3-col"></div>
						<div class="mdl-cell mdl-cell--9-col">
							<h2>Developer Team</h2>
						</div>
					</div>
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col">
						</div>
						<div class="mdl-cell mdl-cell--9-col">
							<ul class="demo-list-three mdl-list">
								<li class="mdl-list__item mdl-list__item--three-line">
									<span class="mdl-list__item-primary-content">
										<a href="https://ciandt.smartcanvas.com/f/persons/douglass@ciandt.com" target="_blank" style="text-decoration: none;">
											<img src="https://lh4.googleusercontent.com/-7VQwiIQW9tc/AAAAAAAAAAI/AAAAAAAAABE/05PlkhseRBk/s96-c/photo.jpg" style="width: 50px;border-radius: 30px;"></img>
										</a>
										<span>Douglas Siqueira</span>
										<span class="mdl-list__item-text-body">
											Bryan Cranston played the role of Walter in Breaking Bad. He is also known
											for playing Hal in Malcom in the Middle.
										</span>
									</span>
								</li>
								<li class="mdl-list__item mdl-list__item--three-line">
									<span class="mdl-list__item-primary-content">
										<a href="https://ciandt.smartcanvas.com/f/persons/hguidi@ciandt.com" target="_blank" style="text-decoration: none;">
											<img src="https://lh3.googleusercontent.com/-onzFk19sFpQ/AAAAAAAAAAI/AAAAAAAABvY/Y3UhVdy3blo/s96-c/photo.jpg" style="width: 50px;border-radius: 30px;"></img>
										</a>
										<span>Herinque Guidi</span>
										<span class="mdl-list__item-text-body">
											Aaron Paul played the role of Jesse in Breaking Bad. He also featured in
											the "Need For Speed" Movie.
										</span>
									</span>
								</li>
							</ul>
						</div>
				</div>
					
				</div>
			</main>
		</div>
		<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
	</body>
</html>