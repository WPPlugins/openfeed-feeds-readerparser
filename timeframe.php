<?php
// Dropstr Inc Timeframe Selection

// get feeds if none is known
if($_GET["check"]){
 global $current_user;
get_currentuserinfo();
$myID = $current_user->ID;

      if ( is_user_logged_in() ) {
      include("userData.php");
      $myTimeFrame = $myData["timeframe"];
      }     
} else{
$myTimeFrame = $_GET["tf"];      
}
?>
<script>
<?php
if($myTimeFrame == "rt"){ 
?>
clearInterval(timer);
jQuery('.pauseMenu').fadeIn();
startTimer();
<?php }
// if tf equals bookmark do not start timer
if($myTimeFrame == "bookmark" || $myTimeFrame == "keyword" || $myTimeFrame == "follow"){ ?>
clearInterval(timer); 
<?php } else { ?>
clearInterval(timer);
startTimer();
<?php } ?>
</script>
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:#FFF;text-decoration:none;padding-top:10px;"><?php
        if($myTimeFrame == "rt"){
          echo "Real Time <span class=\"caret\"></span>";
        }elseif ($myTimeFrame == "keyword") {
            $myKeyword = $_GET["keyword"];
              echo "Trending Keyword / $myKeyword";
        }elseif ($myTimeFrame == "bookmark") {
              echo "Bookmarks";
        }elseif ($myTimeFrame == "follow") {
              echo "Following";
        } else { echo "Trending / $myTimeFrame <span class=\"caret\"></span>";} ?> </a>
          <ul class="dropdown-menu" role="menu">

            <?php if($myTimeFrame == "30"){ ?>
            <li><a href="#" id="timeline1">1 Hour</a></li>
            <li><a href="#" id="timeline3">3 Hours</a></li>
            <li><a href="#" id="timeline6">6 Hours</a></li>
            <li><a href="#" id="timeline12">12 Hours</a></li>
            <li><a href="#" id="timeline24">24 Hours</a></li>
            <li class="divider"></li>
            <li><a href="#" id="timelinert">Real Time</a></li>
            <?php } elseif($myTimeFrame == "1"){ ?>
            <li><a href="#" id="timeline30">30 Minutes</a></li>
            <li><a href="#" id="timeline3">3 Hours</a></li>
            <li><a href="#" id="timeline6">6 Hours</a></li>
            <li><a href="#" id="timeline12">12 Hours</a></li>
            <li><a href="#" id="timeline24">24 Hours</a></li>
            <li class="divider"></li>
            <li><a href="#" id="timelinert">Real Time</a></li>
            <?php } elseif($myTimeFrame == "3"){ ?>
            <li><a href="#" id="timeline30">30 Minutes</a></li>
            <li><a href="#" id="timeline1">1 Hour</a></li>
            <li><a href="#" id="timeline6">6 Hours</a></li>
            <li><a href="#" id="timeline12">12 Hours</a></li>
            <li><a href="#" id="timeline24">24 Hours</a></li>
            <li class="divider"></li>
            <li><a href="#" id="timelinert">Real Time</a></li>
            <?php } elseif($myTimeFrame == "6"){ ?>
            <li><a href="#" id="timeline30">30 Minutes</a></li>
            <li><a href="#" id="timeline1">1 Hour</a></li>
            <li><a href="#" id="timeline3">3 Hours</a></li>
            <li><a href="#" id="timeline12">12 Hours</a></li>
            <li><a href="#" id="timeline24">24 Hours</a></li>
            <li class="divider"></li>
            <li><a href="#" id="timelinert">Real Time</a></li>
            <?php } elseif($myTimeFrame == "12"){ ?>
            <li><a href="#" id="timeline30">30 Minutes</a></li>
            <li><a href="#" id="timeline1">1 Hour</a></li>
            <li><a href="#" id="timeline3">3 Hours</a></li>
            <li><a href="#" id="timeline6">6 Hours</a></li>
            <li><a href="#" id="timeline24">24 Hours</a></li>
            <li class="divider"></li>
            <li><a href="#" id="timelinert">Real Time</a></li>
            <?php } elseif($myTimeFrame == "24"){ ?>
            <li><a href="#" id="timeline30">30 Minutes</a></li>
            <li><a href="#" id="timeline1">1 Hour</a></li>
            <li><a href="#" id="timeline3">3 Hours</a></li>
            <li><a href="#" id="timeline6">6 Hours</a></li>
            <li><a href="#" id="timeline12">12 Hours</a></li>
            <li class="divider"></li>
            <li><a href="#" id="timelinert">Real Time</a></li>
            <?php } elseif($myTimeFrame == "keyword" || $myTimeFrame == "bookmark" || $myTimeFrame == "follow"){ ?>

           <?php } else { ?>
            <li><a href="#" id="timeline30">30 Minutes</a></li>
            <li><a href="#" id="timeline1">1 Hour</a></li>
            <li><a href="#" id="timeline3">3 Hours</a></li>
            <li><a href="#" id="timeline6">6 Hours</a></li>
            <li><a href="#" id="timeline12">12 Hours</a></li>
            <li><a href="#" id="timeline24">24 Hours</a></li>
            <?php  } ?>
          </ul>