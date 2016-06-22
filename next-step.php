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
		<title>Next Steps</title>
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
							<h2>Next Steps</h2>
						</div>
					</div>
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col" style="text-align: center;">
							<img src="https://assets-cdn.github.com/images/modules/logos_page/Octocat.png" width="200px"></img>
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
							<h2>What are we doing?</h2>
						</div>
					</div>
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col" style="text-align: center;">
							<img src="https://octodex.github.com/images/inspectocat.jpg" width="200px"></img>
						</div>
						<div class="mdl-cell mdl-cell--9-col">
							<?php
							$json_file = file_get_contents("https://api.github.com/repos/dssiqueira/runners/issues?state=open");   
							$json_str = json_decode($json_file, true);
							foreach ( $json_str as $e ) 
									{ echo '<a href="'.$e['url'].'" target="_blank">'.$e['title'].'</a><br>'; } 
							?>
						</div>
					</div>
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col"></div>
						<div class="mdl-cell mdl-cell--9-col">
							<h2>Version 2.0</h2>
						</div>
					</div>
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col" style="text-align: center;">
							<img src="https://octodex.github.com/images/octobiwan.jpg" width="200px"></img>
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
				</div>
				<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col"></div>
						<div class="mdl-cell mdl-cell--9-col">
							<h2>The Future...</h2>
						</div>
					</div>
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--3-col" style="text-align: center;">
						<img src="https://octodex.github.com/images/daftpunktocat-thomas.gif" width="200px"></img>
					</div>
					<div class="mdl-cell mdl-cell--9-col">
						<script src="//www.powr.io/powr.js" external-type="html"></script> 
 <div class="powr-countdown-timer" id="d240c27c_1466553780116"></div>
					</div>
				</div>
				<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col"></div>
						<div class="mdl-cell mdl-cell--9-col">
							<h2>Join the force</h2>
						</div>
					</div>
					<div class="mdl-grid">
						<div class="mdl-cell mdl-cell--3-col" style="text-align: center;">
							<img src="https://octodex.github.com/images/stormtroopocat.png" width="200px"></img>
						</div>
						<div class="mdl-cell mdl-cell--9-col">
							<button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="width: 480px;height: 150;color: #FFF;">
								YES!!!!!!!
							</button>
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