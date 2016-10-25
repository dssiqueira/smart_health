<html>
<head>
<meta charset="UTF-8">
<title>CI&T Health</title>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto:100'
	rel='stylesheet' type='text/css'>
<meta name="google-signin-client_id"
	content="1004959689078-0tc7p0enbjr3eq9h2p2j72pmt1g0g7u2.apps.googleusercontent.com">
<link href='css/home.css' rel='stylesheet' type='text/css'>
<script src="public/js/jquery.animateNumber.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript">
$( document ).ready(function() {
    $('#lines').animateNumber({ number: <?php echo $totalDistance ?> }, 10000);
    console.log(test);
});

</script>
</head>
<body class="homepage">
	<div id="logo">
		<img src="img/CIT.png" width="30%"></img>
	</div>
	<div id="name" class="logo-name">
		<h1>Health</h1>
	</div>
	<div class="kilometers">
		<h2>Since <span id="lines">0</span> Kilometers ago</h2>
	</div>

	<div class="healthers">
<?php
foreach ($lastUsers as $singleUser) {
?>
		<a href="<?php print SMARTCANVAS_PROFILE_URL .$singleUser->email;?>" target="_blank" title="<?php print $singleUser->name;?>"><img src="<?php print $singleUser->image_path;?>" alt="<?php print $singleUser->name;?>"></img></a>

<?php
}
?>
		<h3><?php echo $usersCount; ?> CI&T Healthers aready joined.</h3>
		<h3>Be healthy, join us.</h3>
	</div>

	<div class="login">
      	<?php if(isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST']  == 'localhost') : ?>
		    <form action="home" method="POST">
				<input type="hidden" name="email" value="hguidi@ciandt.com">
				<input type="submit" value="Sign in with Google">
			</form>
		<?php else : ?>
    	    <div id="my-signin2"></div>
		<?php endif; ?>
      	</div>
	<script src="js/home.js"></script>
	<script
		src="https://apis.google.com/js/platform.js?onload=renderButton" async
		defer></script>
</body>
</html>
