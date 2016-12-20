<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="CI&T Health">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>CI&amp;T Health</title>

    <!-- Page styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="css/material.min.css" type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css" type='text/css'>
    <link rel="stylesheet" href="css/styles.css" type='text/css'>
    <link rel="stylesheet" href="css/roboto.css" type='text/css'>
  
    <meta name="google-signin-client_id" content="1004959689078-0tc7p0enbjr3eq9h2p2j72pmt1g0g7u2.apps.googleusercontent.com">
  </head>
  <body class="background-image">
      <main>
        <div class="page-content">
          <div class="container">
            <div class="mdl-grid">
              <div class="mdl-layout-spacer"></div>
              <div class="mdl-cell mdl-cell--4-col index-card">
                <!-- Logo -->
                <img clss="index-logo-cit" src="/img/logo_cit2.png" alt="CI&amp;T Health" height="auto" width="100%">
                <p class="index-logo-name">Health</p>
                <!-- Kilometer -->
                <p class="index-counter-text" id="kilometers"></p>
                <p class="index-text">kilometers and going far</p>
           
                <!-- Join Us-->
                <?php if(isset($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST']  == 'localhost')||($_SERVER['HTTP_HOST']  == 'smart_health')) : ?>
                <form action="home" method="POST">
                  <input type="hidden" name="email" value="hguidi@ciandt.com">
                  <input type="submit" value="Sign in with Google">
                </form>
                <?php else : ?>
                <div class="index-my-signin" id="index-my-signin"></div>
                <?php endif; ?>
                <!-- User lists -->
                <div class="index-user-list">
            <?php
            foreach ($lastUsers as $singleUser) {
            ?>
                <a href="<?php print SMARTCANVAS_PROFILE_URL .$singleUser->email;?>" target="_blank" title="<?php print $singleUser->name;?>"><img src="<?php print $singleUser->image_path;?>" alt="<?php print $singleUser->name;?>"></img></a>					
            <?php
            }
            ?>                  
                <p class="index-text"><?php print $usersCount; ?> CI&amp;T already joined.</p>
                </div>
              </div>
              <div class="mdl-layout-spacer"></div>                
          </div>
        </div>
      </main>
      <!-- Feedback -->
    </div> 
    <!-- Footer -->
    <!-- Add scripts -->
    <script src="js/material.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
        $('#kilometers').animateNumber({ number: <?php print $totalDistance ?> }, 1000);
      });
    </script>
    <script src="js/index.js"></script>
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
  </body>
</html>
