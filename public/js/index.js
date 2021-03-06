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
	
    function onSignIn(googleUser) {
      var profile = googleUser.getBasicProfile();
      var domain = profile.getEmail().split("@");
      if (domain[1] == 'ciandt.com') {
        post('/home', {name: profile.getName(), image: profile.getImageUrl(), email: profile.getEmail()});
      } else {
        window.location = "/error";
      }
    }

    function onLoad() {
    	gapi.load('auth2', function() {
	    	gapi.auth2.init();
	    });
	    // Works only on Welcome page
	    gapi.signin2.render('index-my-signin', {
        	'scope': 'profile email',
        	'width': 240,
        	'height': 50,
        	'longtitle': true,
        	'onsuccess': onSignIn
      	});
    }
