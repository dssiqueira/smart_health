<html>
  <head>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
    <meta name="google-signin-client_id" content="1004959689078-0tc7p0enbjr3eq9h2p2j72pmt1g0g7u2.apps.googleusercontent.com">
    <script>
      function post(path, params, method) {
        method = method || "post";

        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        for(var key in params) {
            if(params.hasOwnProperty(key)) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);
                form.appendChild(hiddenField);
             }
        }
        document.body.appendChild(form);
        form.submit();
      }
    </script>
    <style>
      html { 
        font-family: 'Roboto', sans-serif;
        background: url(images/health.jpg) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        text-align: center;
      }
      h1 {
        margin-top: 0px;
        color: #fff;
        text-decoration: none;
        font-size: 60px;
      }
    </style>
  </head>
  <body class="homepage">
    <div id="logo" style="margin-top: 160px;">
      <img src="images/CIT.png" width="30%"></img>
      <h1>Health</h1>
    </div>
    <div id="g-signin2" class="g-signin2" data-onsuccess="onSignIn" style="position: absolute; right: 50%; margin-right: -60px;"></div>
    <script>
      function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        var domain = profile.getEmail().split("@");
        if (domain[1] == 'ciandt.com') {
          post('/app.php', {name: profile.getName(), image: profile.getImageUrl(), email: profile.getEmail()});
        } else {
          window.location = "error.php";
        }
      }
      function renderButton() {
        gapi.signin2.render('g-signin2', {
          'scope': 'profile email',
          'width': 240,
          'height': 50,
          'longtitle': true,
          'onsuccess': onSuccess,
          'onfailure': onFailure
        });
      }
    </script>
    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
	</body>
</html>
