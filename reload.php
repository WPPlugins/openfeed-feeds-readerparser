<?php


?>
<script>
$(document).ready(function(){
$(".showSingle").click(function(){
      $("#div"+$(this).attr("id")).toggle();
      return false;
});
});
</script>