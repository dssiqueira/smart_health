<?php //we can use $dialog_app to display the name of the app connected... ?>
  
  <dialog class="mdl-dialog" style="z-index: 99;">
	<div>
		<img src="/images/health.png">
	</div>
   <h4 class="mdl-dialog__title">Welcome to CI&T Health!</h4>
        <div class="mdl-dialog__content">
      <p>        
        Please connect your favorite App and let's go!        
      </p>
    </div>
    <div class="mdl-dialog__actions">
      <button type="button" class="mdl-button close">Gotcha</button>
    </div>
  </dialog>
    
  <script>
    var dialog = document.querySelector('dialog');
        
    dialog.querySelector('.close').addEventListener('click', function() {
      dialog.close();
    });

    dialog.show();
    
  </script>