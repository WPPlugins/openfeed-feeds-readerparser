<?php
// Dropstr Inc
// openFeed Feed Data
$rc =1;
$flag = false;
foreach ($ofFeed as $innerArray) {
    //  Check type
    if (is_array($innerArray)){
        //  Scan through inner loop
        
        foreach ($innerArray as $value) {
				if($rc == "1"){
                    if($value == "status"){
                      $flag = true;
                    }
                	} 
                	if($flag == true){
                        echo'<div align="center" class="data-item"><h4 class="list-group-item-heading">You Have 0 $ofStatus</h4></div>'; } else {
                    $excerpt = strip_tags($value["excerpt"], '<br><img>');
                    $title = strip_tags($value["title"]);
                    $title = (strlen($title) > 96) ? substr($title,0,93).'...' : $title;
                    $categories = $value["categories"];
                    $catTokens = $value["categoriesToken"];
                    // Split cats into an array and get results into hash tag

                    $thumbnail = $value["thumbnail"];
                    if($thumbnail == NULL){$thumbnail = plugins_url( '/img/filler.jpg', __FILE__ );} else {
                        if(stripos($thumbnail, "youtube.com") !== false){
                            $videoID = strstr($thumbnail, 'embed/');
                            $videoID = substr($videoID, 6);
                            $thumbnail = "http://img.youtube.com/vi/$videoID/default.jpg";
                        }
                    }
                    $host = parse_url($value["url"], PHP_URL_HOST); 
                	echo'<div class="data-item"><div style="display:inline-block;width:100%;"><p class="list-group-item-text"><div style="float:left;width:100%"><div align="center" style="width:200px;height:150px;float:left;margin:10px;background-image:url(http://www.leviathyn.com/wp-content/plugins/openfeed/img/filler.jpg);"><div style="position:absolute;width:200px;height:150px;">';
                    if($thumbnail == NULL){} else { echo '<a href="'.$value["url"].'" target="_blank" style="text-decoration:none;color:#000"><img src="'.$thumbnail.'"></a>';}
                    echo '<div style="bottom:1px;position:absolute;"><span class="label label-default">'.$host.'</span></div></div></div><div><div style="height:40px;"><h4 class="list-group-item-heading"><a href="'.$value["url"].'" target="_blank" style="text-decoration:none;color:#000"><img src='.$value["favicon"].'><b> '.$title.'</b></a></h4></div><div style="margin-top:5px;height:63px;"><div style="float:right;margin:10px;"><div style="width:50px;height:50px;"></div></div> '.$excerpt.'</div><br />';
                    echo '<a href="#" id="'.$rc.'" class="btn btn-link glyphicon glyphicon-info-sign showSingle" style="text-decoration:none;color:#000"></a> <a href="#" id="'.$value["token"].'" class="btn btn-link glyphicon ';
                    if (in_array($value["token"], $bookmarks)) { echo ' glyphicon-star';}else {echo 'glyphicon-star-empty';}
                    if($ofStatus == "Bookmarks"){echo ' addBookmark2"';} else {echo ' addBookmark"';}
                    echo ' style="text-decoration:none;color:#000"></a> <a href="#" id="'.$rc.'" class="btn btn-link glyphicon glyphicon-repeat showShare" style="text-decoration:none;color:#000"></a>';
                   /* if($value["author"] != NULL){ echo '<a href="#">'.$value["author"].'</a> | ';}
                    echo '<a href="'.$value["url"].'" target="_blank">'.$host.'</a></div></div></p></div><div style="margin:10px"><p>';
                    if($categories != NULL){
                        echo '<a href="#" class="glyphicon glyphicon-tags" style="text-decoration:none;color:#222;" alt="tags"></a> ';
                       $cats = explode(",",$categories); 
                       foreach ($cats as $cat) {
                           // output each cat as a tag
                        echo ' <a href="#">#'.$cat.'</a>, ';
                       }
                    } */ echo'</div></div></p><div id="div'.$rc.'" class="targetDiv" style="display:none;position:absolute;width:750px;margin-top:-15px;height:180px;background-color:#FFF;"><div style="float:right"><a href="#" id="'.$rc.'" class="btn btn-link glyphicon glyphicon-remove-circle showSingle" style="text-decoration:none;color:#000"></a></div><div style="margin-left:10px;"><span class="glyphicon glyphicon-user"></span>';
                        if($value["author"] != NULL){ echo ' <a href="#">'.$value["author"].'</a> <a href="#" id="'.$value["authorToken"].'" class="btn btn-link glyphicon glyphicon-heart-empty addFollow" style="text-decoration:none;color:#000;padding:0;"></a>';} else { echo ' Pending';} echo'<br />';
                        echo '<span class="glyphicon glyphicon-globe" alt="domain"></span> <a href="#">'.$host.'</a><a href="#" id="'.$value["domainToken"].'" class="btn btn-link glyphicon';
                        if (in_array($value["domainToken"], $follows)) { echo ' glyphicon-heart';
                        }else { echo ' glyphicon-heart-empty';} echo' addFollow" style="text-decoration:none;color:#000;padding:0;"></a><br />';
                       echo '<span class="glyphicon glyphicon-tags" alt="tags"></span>';
                        if($categories != NULL){
                       $cats = explode(",",$categories);
                       $cattoken = explode(",",$catTokens); 
                       $i = 0; 
                       foreach ($cats as $cat) {
                           // output each cat as a tag
                        echo ' <a href="#">#'.$cat.'</a> <a href="#" id="'.$cattoken[$i].'" class="btn btn-link glyphicon ';
                        if (in_array($cattoken[$i], $follows)) { echo ' glyphicon-heart';
                        }else { echo 'glyphicon-heart-empty';}
                          echo ' addFollow" style="text-decoration:none;color:#000;padding:0;">, ';
                        $i++;
                       }
                    } else {echo ' Pending';}

                    echo '</div></div><div id="follow'.$rc.'" class="shareDiv" style="display:none;position:absolute;width:750px;margin-top:-15px;height:180px;background-color:#FFF;"><div style="float:right"><a href="#" id="'.$rc.'" class="btn btn-link glyphicon glyphicon-remove-circle showShare" style="text-decoration:none;color:#000"></a></div><div style="margin-left:10px;"><a href="https://www.facebook.com/sharer/sharer.php?u='.$value["url"].'" target="_blank"><img src="'.plugins_url( '/img/facebook.png', __FILE__ ).'"></a> <a href="https://twitter.com/share?url='.$value["url"].'" target="_blank"><img src="'.plugins_url( '/img/twitter.png', __FILE__ ).'"></a> <a href="http://www.reddit.com/submit?url='.$value["url"].'" target="_blank"><img src="'.plugins_url( '/img/reddit.png', __FILE__ ).'"></a></div></div></div></div><hr style="margin-top:5px;margin-bottom:15px;"/>';
                }
          $rc++;      	
		}
		
	}
}
?>

