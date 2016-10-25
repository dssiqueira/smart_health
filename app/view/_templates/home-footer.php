
<div class="mdl-grid"
	style="background-color: rgb(224, 224, 224); text-align: center;">
	<div class="mdl-cell mdl-cell--12-col">
		<h6 style="float: left;">CI&T Health - <?php print date('Y');?></h6>
		<span style="float: right; padding-top: 12px;">
			Developed by:
			<a href="<?php print SMARTCANVAS_PROFILE_URL;?>douglass@ciandt.com" target="_blank" style="text-decoration:none;"> 
				<img src="https://lh4.googleusercontent.com/-7VQwiIQW9tc/AAAAAAAAAAI/AAAAAAAAABE/05PlkhseRBk/s96-c/photo.jpg" style="width: 50px; border-radius: 30px;">
			</a>	
			<a href="<?php print SMARTCANVAS_PROFILE_URL;?>hguidi@ciandt.com" target="_blank" style="text-decoration: none;"> 
				<img src="https://lh3.googleusercontent.com/-onzFk19sFpQ/AAAAAAAAAAI/AAAAAAAABvY/Y3UhVdy3blo/s96-c/photo.jpg" style="width: 50px; border-radius: 30px;">
			</a>  
		</span>
	</div>
</div>
</main>
</div>
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async
	defer></script>
<?php
if (isset ( $_GET ['connect'] )) {
	$connected_app = true;
	$dialog_app = $_GET ['connect'];
	include (APP . 'includes/dialog.php');
}
?>
</body>
</html>
