<?php
// Dropstr Inc
// openFeed User Settings
// Get/Check or Register API Key for Beta Testing
global $wpdb;
function checkAPI($user){
      global $wpdb;
      $domain = get_site_url();
        $getApi = $wpdb->get_results( "SELECT option_id, option_value FROM $wpdb->options WHERE option_name = 'oF_api_$user'");
            foreach ( $getApi as $myApi )
        {
            $myApiKey = $myApi->option_value;
        }
        return $myApiKey;
    }
$myApiKey = checkAPI($myID);


// Check API Key and or create new API Key per user per domain
if($myApiKey == NULL){
$respOf = wp_remote_get( 'https://api.openfeed.io/v1/?c=register&domain='.$domain.'&uid='.$myID.'', array( 'sslverify' => false ));
if ( 200 == $respOf['response']['code'] ) {
        $body = $respOf['body'];
        $obj = json_decode($body);
        // get Status codes and display errors
        $myApiKey = $obj->{'key'};

    $wpdb->insert( 
      $wpdb->options, 
      array( 
        'option_name' => 'oF_api_'.$myID, 
        'option_value' => $myApiKey 
      ) 
    );        
        }
}

function getData($myApiKey){
	$myData = wp_remote_get("https://api.openfeed.io/v1/?c=getUser&key=$myApiKey", array( 'sslverify' => false ));
	if ( 200 == $myData['response']['code'] ) {
        $body = $myData['body'];
        $obj = json_decode($body,true);
        // get Status codes and display errors
        $myData = array('feeds' =>  $obj['settings']['feeds'], 'timeframe' => $obj['settings']['timeframe'], 'keyword' => $obj['settings']['keyword'], 'bookmarks' => $obj['bookmarks'], 'follow' => $obj['follow']);
        return $myData;       
        }

}

function setData($myApiKey,$type,$uTF){
    if($type == "trending"){
        $url = "&type=trending&timeframe=$uTF";
    }
    elseif($type == "keyword"){
        $url = "&type=keyword&timeframe=$uTF";   
    }else {
        $url = "&timeframe=$uTF";
    }
	$myData = wp_remote_get("https://api.openfeed.io/v1/?c=updateUser&key=$myApiKey$url", array( 'sslverify' => false ));
	if ( 200 == $myData['response']['code'] ) {
        $body = $myData['body'];
        $obj = json_decode($body);
        // get Status codes and display errors
        $myData = array('feeds' =>  $obj->{'feeds'}, 'timeframe' => $obj->{'timeframe'}, 'keyword' => $obj->{'keyword'});
        return $myData;       
        }



}
// If timeframe has been called to update
if($_GET["tf"]){
$uTF = $_GET["tf"];
$type = $_GET["type"];
if($uTF == "bookmark" || $uTF == "follow"){ } else {	
$myData = setData($myApiKey,$type,$uTF);
}} else{

$myData = getData($myApiKey); }

?>
