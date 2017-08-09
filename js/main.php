var timer;
 function startTimer() {
  timer = setInterval(function () {
jQuery("#updates").load('<?php echo plugins_url( 'update.php', __FILE__ ); ?>')
}, 40000); }

jQuery(document).ready(function(){
if(jQuery.notification.permissionLevel() === "granted"){
  jQuery("#chromeSet").prop('checked', true);
}
jQuery("#trends").load('<?php echo plugins_url( 'trends.php', __FILE__ ); ?>');
jQuery("#feeds").load('<?php echo plugins_url( 'feeds.php', __FILE__ ); ?>');
jQuery("#timeline24").click(function(evt) {
  jQuery("#updates").load('update.php?type=trending&tf=24');
  jQuery("#feeds").load("feeds.php?type=trending&tf=24");
  jQuery('.playMenu').fadeOut();
  jQuery(".pauseMenu").fadeOut();
   evt.preventDefault();
});
jQuery("#timeline12").click(function(evt) {
  jQuery("#updates").load('update.phptype=trending&tf=12');
  jQuery("#feeds").load("feeds.php?type=trending&tf=12");
  jQuery('.playMenu').fadeOut();
  jQuery(".pauseMenu").fadeOut();
   evt.preventDefault();
});
jQuery("#timeline6").click(function(evt) {
  jQuery("#updates").load('update.php?type=trending&tf=6');
  jQuery("#feeds").load("feeds.php?type=trending&tf=6");
  jQuery('.playMenu').fadeOut();
  jQuery(".pauseMenu").fadeOut();
   evt.preventDefault();
});
jQuery("#timeline3").click(function(evt) {
  jQuery("#updates").load('update.php?type=trending&tf=3');
  jQuery("#feeds").load("feeds.php?type=trending&tf=3");
  jQuery('.playMenu').fadeOut();
  jQuery(".pauseMenu").fadeOut();
   evt.preventDefault();
});
jQuery("#timeline1").click(function(evt) {
  jQuery("#updates").load('update.php?type=trending&tf=1');
  jQuery("#feeds").load("feeds.php?type=trending&tf=1");
  jQuery('.playMenu').fadeOut();
  jQuery(".pauseMenu").fadeOut();
   evt.preventDefault();
});
jQuery("#timeline30").click(function(evt) {
  jQuery("#updates").load('update.php?type=trending&tf=30');
  jQuery("#feeds").load("feeds.php?type=trending&tf=30");
  jQuery('.playMenu').fadeOut();
  jQuery(".pauseMenu").fadeOut();
   evt.preventDefault();
});
jQuery("#timelinert").click(function(evt) {
  jQuery("#updates").load('update.php?tf=rt');
  jQuery("#feeds").load("feeds.php?tf=rt");
  jQuery('.pauseMenu').fadeIn();
   evt.preventDefault();
});
// Trending Keywords
jQuery("#keyword30").click(function(evt) {
  jQuery("#updates").load('update.php?type=keyword&tf=30');
  jQuery("#trends").load("trends.php?type=keyword&tf=30");
   evt.preventDefault();
});
jQuery("#keyword1").click(function(evt) {
  jQuery("#updates").load('update.php?type=keyword&tf=1');
  jQuery("#trends").load("trends.php?type=keyword&tf=1");
   evt.preventDefault();
});
jQuery("#keyword3").click(function(evt) {
  jQuery("#updates").load('update.php?type=keyword&tf=3');
  jQuery("#trends").load("trends.php?type=keyword&tf=3");
   evt.preventDefault();
});
jQuery("#keyword6").click(function(evt) {
  jQuery("#updates").load('update.php?type=keyword&tf=6');
  jQuery("#trends").load("trends.php?type=keyword&tf=6");
   evt.preventDefault();
});
jQuery("#keyword12").click(function(evt) {
  jQuery("#updates").load('update.php?type=keyword&tf=12');
  jQuery("#trends").load("trends.php?type=keyword&tf=12");
   evt.preventDefault();
});
jQuery("#keyword24").click(function(evt) {
  jQuery("#updates").load('update.php?type=keyword&tf=24');
  jQuery("#trends").load("trends.php?type=keyword&tf=24");
   evt.preventDefault();
});
jQuery(".showTrends").click(function(){
  if ( jQuery("#myFeeds").is(":visible") ){
        jQuery("#myFeeds").slideToggle();
      }
      jQuery("#myTrends").slideToggle();
      jQuery('.showFeeds').removeClass('active');
      jQuery('.myBookmarks').removeClass('active');    
      jQuery(this).addClass('active');
      return false;
});
jQuery(".showFeeds").click(function(){
  if ( jQuery("#myTrends").is(":visible") ){
      jQuery("#myTrends").slideToggle();
      }
      jQuery("#myFeeds").slideToggle();
      jQuery('.showTrends').removeClass('active');
      jQuery('.myBookmarks').removeClass('active');    
      jQuery(this).addClass('active');
      return false;
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
jQuery('.feeds').hover(function(){
        jQuery('.tmyFeeds').stop().animate({width: '160px'}, 400)
    }, function(){
        jQuery('.tmyFeeds').stop().animate({width: '-0'}, 400)
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
jQuery('.alerts').hover(function(){
        jQuery('.talerts').stop().animate({width: '160px'}, 400)
    }, function(){
        jQuery('.talerts').stop().animate({width: '-0'}, 400)
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
// Keywords Settings
jQuery('#keywordSettings').click(function() {
  if (jQuery('#keywordSettingsDiv').is(":visible")) {
     jQuery("#keywordSettingsDiv").slideUp();    
     jQuery('#keywordSettings').removeClass('active');    
  } else {
     jQuery("#keywordSettingsDiv").slideDown();    
    jQuery("#keywordSettings").addClass('active');
  }
  return false;
});

jQuery('.myBookmarks').click(function() {
if(jQuery( "#timelinert" ).hasClass( "active" )) {
    jQuery('.showFeeds').removeClass('active');
    jQuery('#timelinert').removeClass('active'); 
    jQuery('.pauseMenu').fadeOut();
    jQuery('.playMenu').fadeOut();
    clearInterval(timer);
  }
if(jQuery( ".showTrends" ).hasClass( "active" )) {
    jQuery('.showTrends').removeClass('active');
    jQuery('.timelines').removeClass('active'); 

}  
jQuery(".myBookmarks").addClass('active');
jQuery("#feeds").load("bookmarks.php");
    return false;
});

startTimer();
}); 