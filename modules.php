<?php
// Dropstr Inc
// modules for openFeed
 
 // If user is logged in, show modules
if ( is_user_logged_in() ) { ?>
<div id="myFeedSettings" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title glyphicon glyphicon-list-alt"> Settings</h4>
      </div>
      <div class="modal-body">
        <p>Something will go here!</p>
      </div>
    </div>
  </div>
</div>
<div id="myNotifications" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title glyphicon glyphicon-exclamation-sign"> Notifications</h4>
      </div>
      <div class="modal-body">
        <p><input type="checkbox" id="chromeSet">Enable Chrome Notification</p>
      </div>
    </div>
  </div>
</div>
<div id="information" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title glyphicon glyphicon-info-sign"> Information</h4>
      </div>
      <div class="modal-body" style="height:550px;overflow:scroll;">
        <p><?php 
$myData = wp_remote_get("https://api.openfeed.io/v1/?c=getVersion", array( 'sslverify' => false ));
$body = $myData['body'];
 $ofFeed = json_decode($body, true);
 echo $ofFeed["info"]; ?></p>
      </div>
    </div>
  </div>
</div>
<?php } else {
	// Not logged in
  ?>
	<!-- Modal -->

<?php } ?>