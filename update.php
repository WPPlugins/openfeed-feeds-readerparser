<script>
<?php
// Dropstr inc
// update script
global $current_user;
get_currentuserinfo();
$myID = $current_user->ID;

//Login Check
if ( is_user_logged_in() ) { } else {
header("Location: http://<?php echo $domain; ?>/wp-admin/");	}

// check current version
include("config.php");
$version = getVersion();
if(!isset($_COOKIE["ofVersion"])) {
	setcookie("ofVersion", $version, time() + (86400 * 30), "/"); 
}
if($_COOKIE["ofVersion"] != $version){
echo "jQuery(\"#alerts\").load('$domain/?openfeed=alerts&type=update');";
setcookie("ofVersion", $version, time() + (86400 * 30), "/");
}

include("userData.php");
$timeframe = $myData["timeframe"];
$keyword = $myData["keyword"];
$bookmarks = $myData["bookmarks"];
$follows = $myData["follow"];

if($_GET["tf"] == "bookmark"){
	$token = $_GET["id"];
	$myData = wp_remote_get("https://api.openfeed.io/v1/?c=setBookmarks&id=$token&key=$myApiKey", array( 'sslverify' => false ));
	$body = $myData['body'];
	$ofFeed = json_decode($body, true);

	if($ofFeed["bookmark"] == "1"){
	echo "jQuery('#$token').removeClass('glyphicon-star-empty');";
	echo "jQuery('#$token').addClass('glyphicon-star');";
	 } else {
	echo "jQuery('#$token').removeClass('glyphicon-star');";
	echo "jQuery('#$token').addClass('glyphicon-star-empty');";	
	}
//echo "jQuery(\"#feeds\").load('$domain/?openfeed=feeds');";
}
elseif($_GET["tf"] == "follow"){
	$token = $_GET["id"];
	$myData = wp_remote_get("https://api.openfeed.io/v1/?c=setFollow&id=$token&key=$myApiKey", array( 'sslverify' => false ));
	$body = $myData['body'];
	$ofFeed = json_decode($body, true);

	if($ofFeed["follow"] == "1"){
	echo "jQuery('#$token').removeClass('glyphicon-heart-empty');";
	echo "jQuery('#$token').addClass('glyphicon-heart');";
	 } else {
	echo "jQuery('#$token').removeClass('glyphicon-heart');";
	echo "jQuery('#$token').addClass('glyphicon-heart-empty');";	
	}	
} else {
$myData = wp_remote_get("https://api.openfeed.io/v1/?c=getStatus&feed=games&timeline=$timeframe&keyword=$keyword&key=$myApiKey", array( 'sslverify' => false ));
$body = $myData['body'];
$ofFeed = json_decode($body, true); 
//setcookie("keywordsTokenCache", $ofFeed["cacheToken"], time() + (86400 * 30), "/");
// Alerts

//  update alert icon
if($ofFeed["alerts"] == "0"){
		echo "jQuery(\"#alertCount\").empty();";
	} else {
		echo "jQuery(\"#alertCount\").text(\"$ofFeed[alerts]\");"; }

if($_GET["tf"]){
	if($type == "trending"){
setcookie("feedTokenCache", $ofFeed["trendsToken"], time() + (86400 * 30), "/"); 
}} 
else {

// Check Cookie for token change
if(!isset($_COOKIE["feedTokenCache"])) {
	setcookie("feedTokenCache", $ofFeed["trendsToken"], time() + (86400 * 30), "/"); 
}

if($_COOKIE["feedTokenCache"] != $ofFeed["trendsToken"]){
	//  Check if RT or not
	if($timeframe == "rt"){
				echo "jQuery(\"#feeds\").load('$domain/?openfeed=feeds&tf=rt');";
	} else {	echo "jQuery(\"#alerts\").load('$domain/?openfeed=alerts&type=feedUpdate');"; }
}
	}

if($_GET["tf"]){
	if($type == "keyword"){
		setcookie("keywordsTokenCache", $ofFeed["keywordsToken"], time() + (86400 * 30), "/");
	}
} else {
// Check Cookie for keywords token change
if(!isset($_COOKIE["keywordsTokenCache"])) {
	setcookie("keywordsTokenCache", $ofFeed["keywordsToken"], time() + (86400 * 30), "/"); 
}

if($_COOKIE["keywordsTokenCache"] != $ofFeed["keywordsToken"]){
echo "jQuery(\"#trends\").load('$domain/?openfeed=trends');";
}
}

}
?>
</script>
<?php// echo $_COOKIE["feedTokenCache"]; echo "<br />"; echo $ofFeed["trendsToken"]; ?>
