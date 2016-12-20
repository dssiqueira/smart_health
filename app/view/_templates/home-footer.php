
            <!-- -->
          </div>
  	      <!-- Footer -->
    		  <div class="mdl-grid footer-style">
      			<div class="mdl-cell mdl-cell--4-col">
      				<div class="footer-text">
                <p>CI&amp;T Health - <?php print date('Y');?></p>
                <p>Beta version</p>
              </div>
      			</div>
            <div class="mdl-cell mdl-cell--4-col">
              <div class="mdl-button footer-feedback ciandt-red">
                <a href="https://goo.gl/forms/D9XJeG0Qz1NQZSN82" target="_blank">Feedback</a>
              </div>
            </div>
            <div class="mdl-cell mdl-cell--4-col">
              <div class="footer-dev">
                <div class="footer-dev-text">
                  <p>Developed by:</p>
                </div>
                <div class="footer-dev-icon">
                  <a href="<?php print SMARTCANVAS_PROFILE_URL;?>douglass@ciandt.com" target="_blank"> 
                    <img src="https://lh4.googleusercontent.com/-7VQwiIQW9tc/AAAAAAAAAAI/AAAAAAAAABE/05PlkhseRBk/s96-c/photo.jpg">
                  </a>  
                  <a href="<?php print SMARTCANVAS_PROFILE_URL;?>hguidi@ciandt.com" target="_blank"> 
                    <img src="https://lh3.googleusercontent.com/-onzFk19sFpQ/AAAAAAAAAAI/AAAAAAAABvY/Y3UhVdy3blo/s96-c/photo.jpg">
                  </a>
                </div>                
              </div>
            </div>
    		  </div>
        </div>
      </main>    
    </div> 
    <!-- Add scripts -->
    <script src="/js/material.min.js" type="text/javascript"></script>
    <script src="/js/jquery.min.js" type="text/javascript"></script>
    <script src="/js/index.js" type="text/javascript"></script>
    <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
    <!-- <script src="http://getaninsight.com/id/wi/1171/jq/1/b/0790D5/p/r/t/y/" type="text/javascript"></script> -->
<?php
if (isset ( $_GET ['connect'] )) {
  $connected_app = true;
  $dialog_app = $_GET ['connect'];
  include (APP . 'includes/dialog.php');
}
?>    
  </body>
</html>
