<?php
	//include('lib/smartCanvasAPI.php');
	include('lib/user.php');
	
  //$post = new smartCanvasAPI;
	$user = new user;
	$email = $_POST['email'];
	$name = $_POST['name'];
	$path_image = $_POST['image'];
	
	$user = $user->getUserByEmail($email);
	
	if(empty($user->uid) && !empty($email)){
		$user->insertUser($email, $name, $path_image);
	} else {
		
	}
	
	//$title = 'Teste LIB PHP';
	//$content = 'Testando biblioteca PHP';
	//$shareWith = '["organization", "5712425286369280"]';
	//$cover = 'http://blog.zend.com/wp-content/uploads/2013/09/elephant-queue.jpg';
	
	//post->postCard($title, $content, $shareWith, $cover);
	
	$isConnected = FALSE;
	if ($_GET['code']) {
		$isConnected = TRUE;
	}

  $name   = $_POST['name'];
  $image  = $_POST['image'];
?>
<html>
    <head>
        <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.light_blue-pink.min.css" />
        <style>
        .demo-card-square.mdl-card {
        width: 320px;
        height: 320px;
        }
        .demo-card-square > .mdl-card__title {
        background:
            url('images/dog.png') bottom right 15% no-repeat #46B6AC;
        }
        .counter {
            position: absolute;
            right: 20px;
            padding-top: 10px;
        }
        </style>
    </head>
    <body>
        <!-- Always shows a header, even in smaller screens. -->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row">
                <!-- Title -->
                <img src="images/CIT.png" width="5%"></img>
                <span class="mdl-layout-title">Health</span>
                <!-- Add spacer, to align navigation to the right -->
                <div class="mdl-layout-spacer"></div>
                <!-- Navigation. We hide it in small screens. -->
                <nav class="mdl-navigation mdl-layout--large-screen-only">
                    <a class="mdl-navigation__link" href="">Home</a>
                    <a class="mdl-navigation__link" href="">About</a>
                    <a class="mdl-navigation__link" href="">Next Step</a>
                    <a class="mdl-navigation__link" href="">Sing Out</a>
                    <img src="<?php print $user->path_image;?>" style="width: 50px;border-radius: 30px;"></img>
                </nav>
                </div>
            </header>
            <div class="mdl-layout__drawer">
                <span class="mdl-layout-title">Title</span>
                <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="">Home</a>
                <a class="mdl-navigation__link" href="">About</a>
                <a class="mdl-navigation__link" href="">Next Step</a>
                <a class="mdl-navigation__link" href="">Sing Out</a>
                </nav>
            </div>
            <main class="mdl-layout__content">
                <div class="page-content">
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h2>Connect Your App</h2>
                            <h6>Every day we get the information so your application to add to our database automatically. So run and enjoy!</h6>
                        </div>
                    </div>
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--4-col">
                            <div class="demo-card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/strava.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Strava</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Connect</button>
                                </div>
                            </div> 
                        </div>
                        <div class="mdl-cell mdl-cell--4-col">
                            <div class="demo-card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/runkeeper.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Runkeeper</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
								    <a href="https://runkeeper.com/apps/authorize?response_type=code&client_id=8ca1c685ee4a4ad88ffcddfe24f3d0cf&redirect_uri=https%3A%2F%2Fssl-310157.uni5.net%2FsaveIntegration.php" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Connect</a>
                                </div>
                            </div> 
                        </div>
                        <div class="mdl-cell mdl-cell--4-col">
                            <div class="demo-card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/nikerunning.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Nike + Running</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
								    <button class="mdl-button mdl-js-button mdl-button--raised" disabled>Developing</button>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--12-col">
                            <h2>Next Integration</h2>
                            <h6>Choose application integration. Your opinion is important.</h6>
                        </div>
                    </div>
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--3-col">
                            <div class="demo-card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/googlefit.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Google Fit</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">+</i></button>
                                    <span class="counter">(0)</span>
                                </div>
                            </div> 
                        </div>
                        <div class="mdl-cell mdl-cell--3-col">
                            <div class="demo-card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/adidas.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Adidas Run</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">+</i></button>
                                    <span class="counter">(0)</span>
                                </div>
                            </div> 
                        </div>
                        <div class="mdl-cell mdl-cell--3-col">
                            <div class="demo-card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/mapmyrun.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">MapMyRun</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">+</i></button>
                                    <span class="counter">(0)</span>
                                </div>
                            </div> 
                        </div>
                        <div class="mdl-cell mdl-cell--3-col">
                            <div class="demo-card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/endomondo.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Endomondo</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">+</i></button>
                                    <span class="counter">(0)</span>
                                </div>
                            </div> 
                        </div>
                        <div class="mdl-cell mdl-cell--3-col">
                            <div class="demo-card-square mdl-card mdl-shadow--2dp">
                                <div class="mdl-card__title mdl-card--expand" style="background: url('images/runtastic.png');"></div>
                                <div class="mdl-card__supporting-text">
                                    <h2 class="mdl-card__title-text">Runtastic</h2>
                                </div>
                                <div class="mdl-card__actions mdl-card--border">
                                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored"><i class="material-icons">+</i></button>
                                    <span class="counter">(0)</span>
                                </div>
                            </div> 
                        </div>
                    </div>     
                </div>
            </main>
        </div>
    </body>
</html>