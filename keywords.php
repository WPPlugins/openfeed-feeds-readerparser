<?php
// Dropstr Inc
// Feeds
global $current_user;
get_currentuserinfo();
$myID = $current_user->ID;
if ( is_user_logged_in() ) { 

include("config.php");
include("userData.php");
$timeframe = $myData["timeframe"];
$timeline = $myData["keyword"];
$keyword = $_GET["keyword"];
function myUrlEncode($string) {
    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D', '%20');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]", " ");
    return str_replace($entities, $replacements, urlencode($string));
}
$keyword = myUrlEncode($keyword);

$myData = wp_remote_get("https://api.openfeed.io/v1/?c=trending&feed=games&type=trending&timeline=$timeline&keyword=$keyword&key=$myApiKey", array( 'sslverify' => false ));

$body = $myData['body'];
$ofFeed = json_decode($body, true);

?>
<style type="text/css">
#loading-div{
    display: none;
}
</style>
<body>
<div id="data-container" class="list-group"><div style="height:58px"></div>
<?php
include("feedData.php");

               ?>
            <p><br /></p>

</body>
</html>
<?php } ?>
