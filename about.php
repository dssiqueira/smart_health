	<?php
		session_start();
		require_once('lib/config.php');
		require_once('lib/user.php');

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
		//  	header("location:index.php");
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
		<link href='https://fonts.googleapis.com/css?family=Roboto:400' rel='stylesheet' type='text/css'>
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
			background: url('images/dog.png') bottom right 15% no-repeat #46B6AC;
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
					<span class="mdl-layout-title"><img src="/images/CIT.png" width="80px"></img>Health</span>
					<div class="mdl-layout-spacer"></div>
					<nav class="mdl-navigation mdl-layout--large-screen-only">
						<a class="mdl-navigation__link" href="/app.php" style="color: #FFF;">Home</a>
						<a class="mdl-navigation__link" href="/about.php" style="color: #FFF;">About</a>
						<a class="mdl-navigation__link" href="/next-step.php" style="color: #FFF;">Next Steps</a>
						<a class="mdl-navigation__link" href="#" onclick="signOut();" style="color: #FFF;">Sign Out</a>
					</nav>
					<img src="<?php print $user->path_image;?>" style="width: 50px;border-radius: 30px;"></img>
				</div>
			</header>
			<main class="mdl-layout__content">
				<div class="page-content">
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col"></div>
						<div class="mdl-cell mdl-cell--9-col">
							<h2>About</h2>
						</div>
					</div>
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col" style="text-align: center; margin-top: 60px;">
							<img src="http://icons.iconarchive.com/icons/jozef89/services-flat/128/lab-icon.png"></img>
						</div>
						<div class="mdl-cell mdl-cell--9-col">
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque tempus nunc non orci dictum, non ultricies turpis blandit. Fusce feugiat gravida dui, a facilisis mauris tristique vel. Praesent massa sem, egestas nec nibh pretium, fermentum mollis eros. Pellentesque mattis elementum purus nec varius. In eu mi varius, interdum velit ut, fringilla justo. Duis quis libero diam. Maecenas pretium interdum nisl viverra imperdiet. Vestibulum dui eros, blandit eu velit id, tempor efficitur est.
							</p>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque tempus nunc non orci dictum, non ultricies turpis blandit. Fusce feugiat gravida dui, a facilisis mauris tristique vel. Praesent massa sem, egestas nec nibh pretium, fermentum mollis eros. Pellentesque mattis elementum purus nec varius. In eu mi varius, interdum velit ut, fringilla justo. Duis quis libero diam. Maecenas pretium interdum nisl viverra imperdiet. Vestibulum dui eros, blandit eu velit id, tempor efficitur est.
							</p>
						</div>
					</div>
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col"></div>
						<div class="mdl-cell mdl-cell--9-col">
							<h2>Developer Team</h2>
						</div>
					</div>
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col" style="text-align: center; margin-top: 60px;">
							<img src="http://icons.iconarchive.com/icons/jozef89/services-flat/128/design-icon.png"></img>
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
				<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col"></div>
						<div class="mdl-cell mdl-cell--9-col">
							<h2>Technology</h2>
						</div>
					</div>
				<div class="mdl-grid" style="padding-bottom: 100px;">
					<div class="mdl-cell mdl-cell--3-col" style="text-align: center; margin-top: 60px;">
						<img src="http://icons.iconarchive.com/icons/jozef89/services-flat/128/startup-icon.png"></img>
					</div>
					<div class="mdl-cell mdl-cell--3-col" style="margin-top: 60px;">
						<img src="http://www.myiconfinder.com/uploads/iconsets/128-128-34de4cfcd13c83a4f7e2e48415c6938a.png" width="128px"></img>
					</div>
					<div class="mdl-cell mdl-cell--3-col" style="margin-top: 60px;">
						<img src="http://www.myiconfinder.com/uploads/iconsets/128-128-e42f329d0832c5a8369e6006056ad82f.png"></img>
					</div>
					<div class="mdl-cell mdl-cell--3-col" style="margin-top: 60px;">
						<img src="http://www.myiconfinder.com/uploads/iconsets/128-128-2412e9e2aeec1b5f9dee8ac0ec7bde93.png"></img>
					</div>
				</div>
				<div class="mdl-grid" style="background-color: rgb(224, 224, 224); text-align: center;">
					<div class="mdl-cell mdl-cell--12-col">
						<h6>CI&T Health - <?php print date('Y');?></h6>
					</div>
				</div> 
			</main>
		</div>
		<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
	</body>
</html>