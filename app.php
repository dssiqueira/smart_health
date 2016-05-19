<?php
  var_dump($_POST);

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

          <h1><a href="#"><img src="<?php print $image; ?>" style="border-radius: 10px;"></img></a></h1>
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
            <section class="6u">
              <span class="pennant"><img src="images/strava.png" width="100px"></img></span>
              <h3>Strava</h3>
              <a href="https://runkeeper.com/apps/authorize?client_id=8ca1c685ee4a4ad88ffcddfe24f3d0cf&scope=&state=4082225&redirect_uri=https%3A%2F%2Fssl-310157.uni5.net%2Fapp.php&response_type=code" class="button">Connect</a>
            </section>
  					<section class="6u">
  						<span class="pennant"><img src="images/runkeeper.png" width="100px"></img></span>
  						<h3>Runkeeper</h3>
              <a href="https://runkeeper.com/apps/authorize?client_id=8ca1c685ee4a4ad88ffcddfe24f3d0cf&scope=&state=4082225&redirect_uri=https%3A%2F%2Fssl-310157.uni5.net%2Fapp.php&response_type=code" class="button button-inative">Developing</a>
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
  						<span class="pennant"><img src="images/googlefit.png" width="100px"></img></span>
  						<h3>Google Fit</h3>
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
  <?php include 'inc/footer.inc' ;?>
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
