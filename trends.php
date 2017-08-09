<?php

// Dropstr Inc
// openFeed Trends
global $current_user;
get_currentuserinfo();
$myID = $current_user->ID;

if ( is_user_logged_in() ) { 
include("userData.php");
$keyword = $myData["keyword"];
function myUrlEncode($string) {
    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D', '%20');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]", " ");
    return str_replace($entities, $replacements, urlencode($string));
}


$myData = wp_remote_get("https://api.openfeed.io/v1/?c=getFeed&feed=games&type=keywords&timeline=$keyword&key=$myApiKey", array( 'sslverify' => false ));
$body = $myData['body'];
 $ofFeed = json_decode($body, true);
 setcookie("keywordsTokenCache", $ofFeed["cacheToken"], time() + (86400 * 30), "/");
 
$x = 1;
echo "<br /><div style='background-color:#FFF;''><div align='left' style='float:left;width:50%;'><div style='margin-left:5px;'>";


       foreach ($ofFeed as $innerArray) {
            //  Check type
            if (is_array($innerArray)){
                //  Scan through inner loop
                
                foreach ($innerArray as $value) {
                    $keywordData = myUrlEncode($value["keyword"]);

                        echo'<a href="#" id="'.$keywordData.'" class="keywordData">#'.$value["keyword"].'</a><br />'; 
 			if($x == 5){
        		echo "</div></div><div align='left' style='float:left;width:50%'>";
        				}     
    		$x++;     	
		}
		
	}
}
        foreach ($ofFeed as $value) {



    }
    echo "</div>";
?>
</div>
<?php } ?>
