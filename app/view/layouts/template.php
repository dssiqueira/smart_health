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
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/roboto.css">
  
    <meta name="google-signin-client_id" content="1004959689078-0tc7p0enbjr3eq9h2p2j72pmt1g0g7u2.apps.googleusercontent.com">
  </head>
  <body <?php isset($header_class)? print 'class="' . $header_class . '"' : '' ?>>
      <?php isset($include_header)? print $include_header : '' ?>
      <main>
        <div class="page-content">
          <div class="container">
            <!-- CONTENT -->
            @@CONTENT@@
            <!-- -->
          </div>
        </div>
      </main>
      <!-- Feedback -->      
    </div> 
    <!-- Footer -->
    @@FOOTER@@
    <!-- Add scripts -->
    <script src="js/material.min.js" type="text/javascript"></script>
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/index.js" type="text/javascript"></script>
    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    <script src="http://getaninsight.com/id/wi/1171/jq/1/b/0790D5/p/r/t/y/" type="text/javascript"></script> 
<?php
if (isset ( $_GET ['connect'] )) {
  $connected_app = true;
  $dialog_app = $_GET ['connect'];
  include (APP . 'includes/dialog.php');
}
?>    
  </body>
</html>