
<div class="mdl-grid"
	style="background-color: rgb(224, 224, 224); text-align: center;">
	<div class="mdl-cell mdl-cell--12-col">
		<h6>CI&T Health - <?php print date('Y');?></h6>
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
