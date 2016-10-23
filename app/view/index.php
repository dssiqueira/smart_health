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

<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body class="homepage">
	<div id="logo" style="margin-top: 50px;">
		<img src="img/CIT.png" width="30%"></img>
	</div>
	<div id="name" style="margin-top: -50px;"">
		<h1>Health</h1>
	</div>
	<div class="kilometers">
		<h2>Since <?php echo number_format($totalDistance,2) ?> Kilometers ago</h2>
	</div>

	<div class="healthers">		
<?php
foreach ($lastUsers as $singleUser) {
?>
		<img src="<?php print $singleUser->image_path;?>" style="width: 50px; border-radius: 30px;"></img>

<?php
}
?>
		<h3><?php echo $usersCount; ?> CI&T Healthers aready joined.</h3>
		<h3>Be healthy, join us.</h3>
	</div>

	<div class="login" style="position: absolute; right: 50%; margin-right: -120px;">
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
