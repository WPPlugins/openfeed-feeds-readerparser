<?php
// Dropstr Inc
// Feeds
global $current_user;
get_currentuserinfo();
$myID = $current_user->ID;
if ( is_user_logged_in() ) { 

include("config.php");
include("userData.php");
$bookmarks = $myData["bookmarks"];
$follows = $myData["follow"];

$myData = wp_remote_get("https://api.openfeed.io/v1/?c=getBookmarks&key=$myApiKey", array( 'sslverify' => false ));
$body = $myData['body'];
$ofFeed = json_decode($body, true);
$ofStatus ="Bookmarks";
?>
<style type="text/css">
#loading-div{
    display: none;
}
</style>
 <div id="data-container" class="list-group"><div style="height:58px"></div>

<?php
	include("feedData.php");

			   ?>
            <p><br /></p>


<?php } ?>
