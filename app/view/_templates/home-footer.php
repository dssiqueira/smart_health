
<div class="mdl-grid"
	style="background-color: rgb(224, 224, 224); text-align: center;">
	<div class="mdl-cell mdl-cell--12-col">
		<h6>CI&T Health - <?php print date('Y');?> - Developed by:</h6>
		<span>	 
			<ul class="demo-list-three mdl-list">
			<li class="mdl-list__item mdl-list__item--three-line"><span
				class="mdl-list__item-primary-content"> 
				<a
					href="https://ciandt.smartcanvas.com/f/persons/douglass@ciandt.com"
					target="_blank" style="text-decoration: none;"> <img
						src="https://lh4.googleusercontent.com/-7VQwiIQW9tc/AAAAAAAAAAI/AAAAAAAAABE/05PlkhseRBk/s96-c/photo.jpg"
						style="width: 50px; border-radius: 30px;"></img>
				 </a>
			</span></li>
			<li class="mdl-list__item mdl-list__item--three-line"><span
				class="mdl-list__item-primary-content"> 
				<a
					href="https://ciandt.smartcanvas.com/f/persons/hguidi@ciandt.com"
					target="_blank" style="text-decoration: none;"> <img
						src="https://lh3.googleusercontent.com/-onzFk19sFpQ/AAAAAAAAAAI/AAAAAAAABvY/Y3UhVdy3blo/s96-c/photo.jpg"
						style="width: 50px; border-radius: 30px;"></img>
				</a> 
			</span></li>
		</ul>
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
