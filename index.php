<?php
   /* 
    Plugin Name: openFeed 
    Plugin URI: http://openfeed.io 
    Description: Real Time, Feed Reader/Parser
    Author: Dropstr Inc
    Version: 0.23 
    Author URI: http://dropstr.com 
    */ 
  if (!function_exists('openfeed_dashboard_menu')) {
  function openfeed_dashboard_menu() {
  	add_menu_page( 'openFeed', 'openFeed', 'read', 'openfeed', 'openfeed_dashboard',plugins_url( '/img/icon.png', __FILE__ ), '4.778' );
    wp_enqueue_script("jquery");
  }
  }
if (! function_exists('dashboard_footer ') ){
function dashboard_footer () {
}
}
add_filter('admin_footer_text', 'dashboard_footer ');

function openfeed_load($wp) {
  $domain = get_site_url();
    // feeds page
    if (array_key_exists('openfeed', $wp->query_vars) 
            && $wp->query_vars['openfeed'] == 'feeds') {
      wp_enqueue_script("jquery");
      include("feeds.php");
      exit;
    }
    // Trends page
    if (array_key_exists('openfeed', $wp->query_vars) 
            && $wp->query_vars['openfeed'] == 'trends') {
      wp_enqueue_script("jquery");
      include("trends.php");
      exit;
    }
    // Menu Dropdown
    if (array_key_exists('openfeed', $wp->query_vars) 
            && $wp->query_vars['openfeed'] == 'dropdown') {
      wp_enqueue_script("jquery");
      include("timeframe.php");
      exit;
    }     
    // Alerts page
    if (array_key_exists('openfeed', $wp->query_vars) 
            && $wp->query_vars['openfeed'] == 'alerts') {
      wp_enqueue_script("jquery");
      include("alerts.php");
      exit;
    }  
    // Bookmarks page
    if (array_key_exists('openfeed', $wp->query_vars) 
            && $wp->query_vars['openfeed'] == 'bookmarks') {
      wp_enqueue_script("jquery");
      include("bookmarks.php");
      exit;
    }
    // Following page
    if (array_key_exists('openfeed', $wp->query_vars) 
            && $wp->query_vars['openfeed'] == 'myfeed') {
      wp_enqueue_script("jquery");
      include("myfeed.php");
      exit;
    }    
    // More page
    if (array_key_exists('openfeed', $wp->query_vars) 
            && $wp->query_vars['openfeed'] == 'more') {
      wp_enqueue_script("jquery");
      include("more.php");
      exit;
    } 
    // Keywords page
    if (array_key_exists('openfeed', $wp->query_vars) 
            && $wp->query_vars['openfeed'] == 'keywords') {
      wp_enqueue_script("jquery");
      include("keywords.php");
      exit;
    }                     
    // Update checker
    if (array_key_exists('openfeed', $wp->query_vars) 
            && $wp->query_vars['openfeed'] == 'update') {
      wp_enqueue_script("jquery");
      include("update.php");
      exit;
    }

}
function my_plugin_query_vars($vars) {
    $vars[] = 'openfeed';
    return $vars;
}
add_filter('query_vars', 'my_plugin_query_vars');


function openfeed_dashboard() {
function ae_nocache()
{
    header("Expires: Mon, 01 Nov 2015 06:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
}
ae_nocache();

global $current_user;
get_currentuserinfo();
$myID = $current_user->ID;
$myEmail = $current_user->user_email;
$myName = $current_user->user_login;
$domain = get_site_url();
 
// openFeed Feeds Service 

include("config.php");
$version = getVersion();
setcookie("ofVersion", $version, time() + (86400 * 30), "/"); 

if ( is_user_logged_in() ) {
include("userData.php");
$myTimeFrame = $myData["timeframe"];
}
?>
<!DOCTYPE html>
<html>
<title>openFeed Dashboard v<?php echo $version; ?></title>
<head>
  <meta charset="utf-8">
	<link href="<?php echo plugins_url( '/css/bootstrap.min.css', __FILE__ ); ?>" rel="stylesheet">
  <script src="<?php echo plugins_url( '/js/jquery.notification.js', __FILE__ ); ?>"></script>
<script type="text/javascript">
var timer;
 function startTimer() {
  timer = setInterval(function () {
jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update')
}, 40000); }

jQuery(document).ready(function(){
var y = jQuery(window).scrollTop(); 
jQuery(window).scrollTop(y+150);
if(jQuery.notification.permissionLevel() === "granted"){
  jQuery("#chromeSet").prop('checked', true);
}
jQuery("#trends").load('<?php echo $domain; ?>/?openfeed=trends');
jQuery("#feeds").load('<?php echo $domain; ?>/?openfeed=feeds');
jQuery("#dropDown").load('<?php echo $domain; ?>/?openfeed=dropdown&tf=<?php echo $myTimeFrame; ?>');

// Trending Keywords
jQuery("#keyword30").click(function(evt) {
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&type=keyword&tf=30');
  jQuery("#trends").load("<?php echo $domain; ?>/?openfeed=trends&type=keyword&tf=30");
   evt.preventDefault();
});
jQuery("#keyword1").click(function(evt) {
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&type=keyword&tf=1');
  jQuery("#trends").load("<?php echo $domain; ?>/?openfeed=trends&type=keyword&tf=1");
   evt.preventDefault();
});
jQuery("#keyword3").click(function(evt) {
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&type=keyword&tf=3');
  jQuery("#trends").load("<?php echo $domain; ?>/?openfeed=trends&type=keyword&tf=3");
   evt.preventDefault();
});
jQuery("#keyword6").click(function(evt) {
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&type=keyword&tf=6');
  jQuery("#trends").load("<?php echo $domain; ?>/?openfeed=trends&type=keyword&tf=6");
   evt.preventDefault();
});
jQuery("#keyword12").click(function(evt) {
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&type=keyword&tf=12');
  jQuery("#trends").load("<?php echo $domain; ?>/?openfeed=trends&type=keyword&tf=12");
   evt.preventDefault();
});
jQuery("#keyword24").click(function(evt) {
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&type=keyword&tf=24');
  jQuery("#trends").load("<?php echo $domain; ?>/?openfeed=trends&type=keyword&tf=24");
   evt.preventDefault();
});
jQuery('.timelines').click(function() {
    jQuery('.timelines').removeClass('active');    
    jQuery(this).addClass('active');
    return false;
});
jQuery(document).scroll(function() {
  var y = jQuery(this).scrollTop();
  if (y > 300) {
    jQuery('.bottomMenu').fadeIn();
  } else {
    jQuery('.bottomMenu').fadeOut();
  }
});
jQuery('#toTop').click(function() {
jQuery('html, body').animate({ scrollTop: 0 }, 'slow');
});
jQuery('.search').hover(function(){
        jQuery('.tmySearch').stop().animate({width: '160px'}, 400)
    }, function(){
        jQuery('.tmySearch').stop().animate({width: '-0'}, 400)
  });
jQuery(".showSearch").click(function() {
if ( jQuery("#mySearchDiv").hasClass( "vis" ) ){
  jQuery("#mySearchDiv").addClass('hid');
  jQuery('#mySearchDiv').removeClass('vis'); 
  jQuery('#mySearchDiv').stop().animate({width: '-0'}, 400);}
  else {
    jQuery("#mySearchDiv").addClass('vis');
    jQuery('#mySearchDiv').removeClass('hid'); 
    jQuery('#mySearchDiv').stop().animate({width: '750px'}, 400);}
    return false;
});
jQuery('.Feeds').hover(function(){
        jQuery('.tfeeds').stop().animate({width: '160px'}, 400)
    }, function(){
        jQuery('.tfeeds').stop().animate({width: '-0'}, 400)
  });
jQuery('.trends').hover(function(){
        jQuery('.ttrends').stop().animate({width: '160px'}, 400)
    }, function(){
        jQuery('.ttrends').stop().animate({width: '-0'}, 400)
  });
jQuery('.myBookmarks').hover(function(){
        jQuery('.tmyBookmarks').stop().animate({width: '160px'}, 400)
    }, function(){
        jQuery('.tmyBookmarks').stop().animate({width: '-0'}, 400)
  });
jQuery('.myFeed').hover(function(){
        jQuery('.tmyFeed').stop().animate({width: '160px'}, 400)
    }, function(){
        jQuery('.tmyFeed').stop().animate({width: '-0'}, 400)
  });
jQuery('.reports').hover(function(){
        jQuery('.treports').stop().animate({width: '160px'}, 400)
    }, function(){
        jQuery('.treports').stop().animate({width: '-0'}, 400)
  });
jQuery(".playMenu").click(function(evt) {
      jQuery(".playMenu").toggle();
      jQuery(".pauseMenu").toggle();   
      startTimer();
   evt.preventDefault();
});
jQuery(".pauseMenu").click(function(evt) {
      jQuery(".pauseMenu").toggle();
      jQuery(".playMenu").toggle(); 
      clearInterval(timer);
   evt.preventDefault();
});
jQuery('#chromeSet').click(function() {
  if(this.checked) {
    var options = {
        iconUrl: '//openfeed.io/dashboard/img/notification.png',
        title: 'Notifications enabled',
        body: 'You have enabled notification alerts for openFeed.',
        timeout: 5000, // close notification in 1 sec
        onclick: function () {
            console.log('Pewpew');
        }
    };

    jQuery.notification(options);
} 
});

jQuery('.myBookmarks').click(function() {
clearInterval(timer);
if(jQuery( ".Feeds" ).hasClass( "active" )) {
    jQuery('.Feeds').removeClass('active'); 
    jQuery('.pauseMenu').fadeOut();
    jQuery('.playMenu').fadeOut();
  }
if(jQuery( ".myFeed" ).hasClass( "active" )) {
    jQuery('.myFeed').removeClass('active');
}  
jQuery(".myBookmarks").addClass('active');
jQuery("#feeds").load("<?php echo $domain; ?>/?openfeed=bookmarks");
jQuery("#dropDown").load("<?php echo $domain; ?>/?openfeed=dropdown&tf=bookmark");

});

jQuery('.myFeed').click(function() {
if(jQuery( ".Feeds" ).hasClass( "active" )) {
    jQuery('.Feeds').removeClass('active'); 
    jQuery('.pauseMenu').fadeOut();
    jQuery('.playMenu').fadeOut();
    clearInterval(timer);
  }
if(jQuery( ".myBookmarks" ).hasClass( "active" )) {
    jQuery('.myBookmarks').removeClass('active');
}  
jQuery(".myFeed").addClass('active');
jQuery("#feeds").load("<?php echo $domain; ?>/?openfeed=myfeed&tf=follow");
jQuery("#dropDown").load("<?php echo $domain; ?>/?openfeed=dropdown&tf=follow");

});

jQuery('.Feeds').click(function() {
if(jQuery( ".myFeed" ).hasClass( "active" )) {
    jQuery('.myFeed').removeClass('active');
}
if(jQuery( ".myBookmarks" ).hasClass( "active" )) {
    jQuery('.myBookmarks').removeClass('active');
}  
jQuery(".Feeds").addClass('active');
jQuery("#feeds").load("<?php echo $domain; ?>/?openfeed=feeds");
jQuery("#dropDown").load("<?php echo $domain; ?>/?openfeed=dropdown&check=y");

});

startTimer();
});  
</script>   
	<style>
#container {
    display: table;
    }

  #row  {
    display: table-row;
    }

  #left, #right, #middle {
    display: table-cell;
    }
.rightbox {
    position: absolute;
    display: inline-block;
    overflow: hidden;
    width: 0;
    height: 43px;
    vertical-align: top;
    margin-right: 0;
    right:0;
    border: 0;

}
.leftbox {
    position: fixed;
    overflow: hidden;
    width: 0;
    height: 43px;
    vertical-align: top;
    margin-left: 0;
    border: 0;

}
.content {
    width: 120px;
    position: absolute;
    background-color: #090909;
    height: 43px;
    text-align: center;
    left: 0;
    top: 1px;
    right: 0;
    color: #FFF;
}

.content p {
    margin-top: 8px;
}  
.navbar-logo {
margin-left: 105px;

} 
</style>
	</head>
<body>
<?php include("modules.php"); ?>
<div style="position:fixed;height:10px;width:100%;background-color:#f1f1f1;z-index:500"></div>
<div align="left" style="width:990px;margin-top:10px;">
  <div id="updates"></div>
  <div id="container">
  <div id="row">

    <div id="left" style="background-color:#222222;width:53px;">
     <div class="btn-group-vertical" style="position:fixed;display:inherit;"><div class="tmySearch rightbox">
                    <div class="content"><p>Search</p></div>
               </div>
    <a href="#"  class="btn btn-default glyphicon glyphicon-search search showSearch" alt="Search"></a>
    <div class="tfeeds rightbox">
                    <div class="content"><p>Feeds</p></div>
               </div>
    <a href="#" class="btn btn-default glyphicon glyphicon-time Feeds <?php if($myTimeFrame == "24" || $myTimeFrame == "12" || $myTimeFrame == "6" || $myTimeFrame == "3" || $myTimeFrame == "1" || $myTimeFrame == "30" || $myTimeFrame == "rt"){ echo "active"; } ?>" alt="Feeds"></a>
    <div class="tmyBookmarks rightbox">
                    <div class="content"><p>Bookmarks</p></div>
               </div>
    <a href="#" class="btn btn-default glyphicon glyphicon-star myBookmarks <?php if($myTimeFrame == "bookmarks"){ echo "active"; } ?>" alt="Bookmarks"></a>
    <div class="tmyFeed rightbox">
                    <div class="content"><p>Following</p></div>
               </div>
    <a href="#"  class="btn btn-default timelines myFeed <?php if($myTimeFrame == "follow"){ echo "active"; } ?> glyphicon glyphicon-heart" style="color:#FFF"></a>
    <a href="#"  class="btn btn-default glyphicon glyphicon-pause pauseMenu" style="display:none;" alt="play/pause"></a>
    <a href="#"  class="btn btn-default glyphicon glyphicon-play playMenu" style="display:none;" alt="play/pause"></a>
    <a href="#" id="toTop" class="btn btn-default glyphicon glyphicon-arrow-up bottomMenu" style="display:none;" alt="Back to Top"></a>
</div>
    </div>

    <div id="middle" style="vertical-align:top;">
      <div>
</div><div id="alerts"></div>
<div id="mySearchDiv" style="z-index:1000;background-color:#222222;" class="hid leftbox"><form role="search">
  <div style="float:left;color:#FFF;"><input type="text" class="form-control" size="55" placeholder="Search"></div><div style="float:left;">
          <button type="submit" class="btn btn-default"> Search</button></div>
      </form></div>
      <div style="background-color:#222222;width:750px;height:45px;position:fixed;z-index:100;"><div style="float:left;color:#FFF;margin-left:5px;"><ul class="nav navbar-nav"><li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:#FFF;text-decoration:none;padding-top:10px;">Games <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Coming Soon</a></li>
          </ul>
        </li> <li style="color:#FFF;text-decoration:none;padding-top:10px;"> / </li> <li class="dropdown" id="dropDown"></li></ul></div><div style="float:right;"><button class="btn btn-default" type="button">Posts 24H <span class="badge" id="postCount"></span></button><span style="color:#FFF;text-decoration:none;display:inline-block;margin-bottom: 0;font-weight: normal;text-align: center;vertical-align: middle;border: 1px solid transparent;white-space: nowrap;padding: 10px 18px;font-size: 15px;line-height: 1.42857143;border-radius: 0;"><span class=" glyphicon glyphicon-bell alerts" ></span><span id="alertCount" class="badge" style="background-color:#ff0000;width:19px"></span></span> </div></div>
     <div align="left" id="feeds" style="background-color:#FFF;width:750px;">
    </div></div>

    <div id="right">
      <div style="width:300px;position:fixed;margin-left:5px;">
       <div class="btn-group" style="background-color:#222222;width:100%;height:44px;"><div style="float:left;color:#FFF;margin-left:5px;"><h4>Widgets</h4></div><div style="float:right"><a href="#" class="btn btn-default glyphicon glyphicon-menu-hamburger"></a></div></div>
              <p></p>
              <div id="notify" style="background-color:#222222;width:100%;"></div>
              <p></p>
      <div class="btn-group" style="background-color:#222222;width:100%;height:44px;"><div style="float:left;color:#FFF;margin-left:5px;"><h4>Trending Keywords</h4></div><div style="float:right"></div></div>
      <div style="background-color:#222222"><a href="#" id="keyword30" class="btn btn-default btn-sm keywords" style="color:#FFF">30M</a><a href="#" id="keyword1" class="btn btn-default btn-sm keywords" style="color:#FFF">1H</a><a href="#" id="keyword3" class="btn btn-default btn-sm keywords" style="color:#FFF">3H</a><a href="#" id="keyword6" class="btn btn-default btn-sm keywords">6H</a><a href="#" id="keyword12" class="btn btn-default btn-sm keywords" style="color:#FFF">12H</a><a href="#" id="keyword24" class="btn btn-default btn-sm keywords">24H</a></div>
      <div style="background-color:#FFF;width:100%;height:150px">
      <div align="center" id="trends">Loading...</div>
      </div>
      <p></p>
      <div class="btn-group" style="background-color:#222222;width:100%;height:44px;"><div style="float:left;color:#FFF;margin-left:5px;"><h4>Settings</h4></div><div style="float:right"><a href="#" id="pluginSettings" class="btn btn-default glyphicon glyphicon-cog"></a></div></div>
      <div style="background-color:#FFF;width:100%;height:150px"><a href="#" data-toggle="modal" data-target="#information"><br /><h5>Beta Version: <b><?php echo $version; ?></h5></a></div>
    </div>
    </div>    
  </div>
</div>
</div>
<script src="<?php echo plugins_url( '/js/bootstrap.min.js', __FILE__ ); ?>"></script>	
</body>
<script>
<?php
// Load User Settings
if($myTimeFrame == "rt" || $myTimeFrame == "follow"){
echo "jQuery('.showFeeds').addClass('active');";
echo "jQuery('#myFeeds').addClass('active');";
echo "jQuery('.pauseMenu').toggle();";
  } else {
echo "jQuery('.showTrends').addClass('active');";

  }

?>
var timer;
jQuery('body').on('click','.showSingle',function(){
      jQuery("#div"+jQuery(this).attr("id")).toggle();

if (jQuery('.targetDiv').is(":visible") || jQuery('.shareDiv').is(":visible")) {
// if more than one div is visible
  if ( jQuery(".pauseMenu").is(":visible") ){
          jQuery(".playMenu").toggle();
          jQuery(".pauseMenu").toggle();
                for(i=0;i<3;i++) {
                      jQuery(".playMenu").fadeTo('slow', 0.5).fadeTo('slow', 1.0);
                    }
    }
      clearInterval(timer);
} else {
  if ( jQuery(".playMenu").is(":visible") ){
          jQuery(".playMenu").toggle();
          jQuery(".pauseMenu").toggle();
          startTimer();
    }
};
         return false;    
});
jQuery('body').on('click','.showShare',function(){
      jQuery("#follow"+jQuery(this).attr("id")).toggle();

if (jQuery('.shareDiv').is(":visible") || jQuery('.targetDiv').is(":visible")) {
// if more than one div is visible
  if ( jQuery(".pauseMenu").is(":visible") ){
          jQuery(".playMenu").toggle();
          jQuery(".pauseMenu").toggle();
                for(i=0;i<3;i++) {
                      jQuery(".playMenu").fadeTo('slow', 0.5).fadeTo('slow', 1.0);
                    }
    }
      clearInterval(timer);
} else {
  if ( jQuery(".playMenu").is(":visible") ){
          jQuery(".playMenu").toggle();
          jQuery(".pauseMenu").toggle();
          startTimer();
    }
};
         return false;    
});
  jQuery('body').on('click','#timeline24',function(){
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&type=trending&tf=24');
  jQuery("#feeds").load("<?php echo $domain; ?>/?openfeed=feeds&type=trending&tf=24");
  jQuery("#dropDown").load("<?php echo $domain; ?>/?openfeed=dropdown&tf=24");
  jQuery('.playMenu').fadeOut();
  jQuery(".pauseMenu").fadeOut();
});
  jQuery('body').on('click','#timeline12',function(){
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&type=trending&tf=12');
  jQuery("#feeds").load("<?php echo $domain; ?>/?openfeed=feeds&type=trending&tf=12");
  jQuery("#dropDown").load("<?php echo $domain; ?>/?openfeed=dropdown&tf=12");
  jQuery('.playMenu').fadeOut();
  jQuery(".pauseMenu").fadeOut();
});
  jQuery('body').on('click','#timeline6',function(){
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&type=trending&tf=6');
  jQuery("#feeds").load("<?php echo $domain; ?>/?openfeed=feeds&type=trending&tf=6");
  jQuery("#dropDown").load("<?php echo $domain; ?>/?openfeed=dropdown&tf=6");
  jQuery('.playMenu').fadeOut();
  jQuery(".pauseMenu").fadeOut();
});
  jQuery('body').on('click','#timeline3',function(){
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&type=trending&tf=3');
  jQuery("#feeds").load("<?php echo $domain; ?>/?openfeed=feeds&type=trending&tf=3");
  jQuery("#dropDown").load("<?php echo $domain; ?>/?openfeed=dropdown&tf=3");
  jQuery('.playMenu').fadeOut();
  jQuery(".pauseMenu").fadeOut();
});
  jQuery('body').on('click','#timeline1',function(){
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&type=trending&tf=1');
  jQuery("#feeds").load("<?php echo $domain; ?>/?openfeed=feeds&type=trending&tf=1");
  jQuery("#dropDown").load("<?php echo $domain; ?>/?openfeed=dropdown&tf=1");
  jQuery('.playMenu').fadeOut();
  jQuery(".pauseMenu").fadeOut();
});
  jQuery('body').on('click','#timeline30',function(){
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&type=trending&tf=30');
  jQuery("#feeds").load("<?php echo $domain; ?>/?openfeed=feeds&type=trending&tf=30");
  jQuery("#dropDown").load("<?php echo $domain; ?>/?openfeed=dropdown&tf=30");
  jQuery('.playMenu').fadeOut();
  jQuery(".pauseMenu").fadeOut();
});
  jQuery('body').on('click','#timelinert',function(){
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&tf=rt');
  jQuery("#feeds").load("<?php echo $domain; ?>/?openfeed=feeds&tf=rt");
  jQuery("#dropDown").load("<?php echo $domain; ?>/?openfeed=dropdown&tf=rt");
  jQuery('.pauseMenu').fadeIn();
});
// Bookmarks
  jQuery('body').on('click','.addBookmark',function(evt){
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&tf=bookmark&id='+jQuery(this).attr("id"));
   evt.preventDefault();
});
  jQuery('body').on('click','.addBookmark2',function(evt){
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&tf=bookmark&id='+jQuery(this).attr("id"));
  jQuery("#feeds").load('<?php echo $domain; ?>/?openfeed=bookmarks');
   evt.preventDefault();
});
 // Follows
   jQuery('body').on('click','.addFollow',function(evt){
  jQuery("#updates").load('<?php echo $domain; ?>/?openfeed=update&tf=follow&id='+jQuery(this).attr("id"));
   evt.preventDefault();
}); 
// keywords
jQuery('body').on('click','.keywordData',function(){
if(jQuery( ".Feeds" ).hasClass( "active" )) { 
    jQuery('.Feeds').removeClass('active');
    jQuery('.pauseMenu').fadeOut();
    jQuery('.playMenu').fadeOut();
    clearInterval(timer);
  }
if(jQuery( ".myFeed" ).hasClass( "active" )) { 
    jQuery('.myFeed').removeClass('active');
  }
if(jQuery( ".myBookmarks" ).hasClass( "active" )) { 
    jQuery('.myBookmarks').removeClass('active');
  }   
  jQuery("#feeds").load("<?php echo $domain; ?>/?openfeed=keywords&keyword="+jQuery(this).attr("id"));
  jQuery("#dropDown").load("<?php echo $domain; ?>/?openfeed=dropdown&tf=keyword&keyword="+jQuery(this).attr("id"));
    return false;
});
// Keyword Close
jQuery('body').on('click','#keywordClose',function(){
if(jQuery( "#timelinert" ).hasClass( "active" )) { 
    jQuery('.pauseMenu').fadeIn();
    startTimer();
  }
jQuery("#feeds").load("<?php echo $domain; ?>/?openfeed=feeds");
    return false; 
  });
</script>
</html>	
<?php }
add_action('admin_menu', 'openfeed_dashboard_menu');
add_action('wp', 'openfeed_load'); ?>
