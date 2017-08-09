<?php
// Dropstr Inc
$type = $_GET["type"];
?>
<script>
jQuery(document).ready(function(){
      jQuery("#reload").click(function(evt) {
         jQuery("#feeds").load("<?php echo "$domain/?openfeed=feeds"; ?>")
         evt.preventDefault();
      })
});
</script>
<?php if($type == "feedUpdate"){ ?>
<div class="alert alert-dismissible alert-info">
  <h4>Feed Updates</h4>
  <p>There are new updates to your current feed, please refresh the feed to see changes. <a href="#" id="reload" class="alert-link" data-dismiss="alert">Refresh Now</a>.</p>
</div>
<?php } if($type == "update"){ ?>
<div class="alert alert-dismissible alert-warning">
  <h4>Service Update</h4>
  <p>There has been an update to the service, please refresh to load changes. <a href="/wp-admin/admin.php?page=openfeed" class="alert-link">Refresh</a></p>
</div>
<?php  } ?>