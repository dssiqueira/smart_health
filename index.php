<html>
  <head>
    <?php include 'inc/header.inc' ;?>
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
  </head>
  <body class="homepage">

	<!-- Header -->
		<div id="header">
			<div class="container">

				<!-- Logo -->
				<div id="logo">
          <img src="images/CIT.png" width="30%"></img>
					<h1><a href="#">Runners</a></h1>
				</div>
        <div class="g-signin2" data-onsuccess="onSignIn"></div>
			</div>
		</div>
	 <?php include 'inc/footer.inc' ;?>
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
    </script>
	</body>
</html>
