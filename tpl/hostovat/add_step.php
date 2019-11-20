
<?php
function showflow() {
  $curr=array_search($GLOBALS["m"],$GLOBALS["pageflow"]);
  $curr=$curr+1;
  $max=count($GLOBALS["pageflow"])+1;
  $current=round((100/$max)*$curr);

  $return="";
  $jq=false;
  $script="<script type=\"text/javascript\">$(document).ready(function() { $(\".flow\").progressbar({ value: ".$current." }); });</script>\n<div class=\"flow\" style=\"width: 150px;\">&nbsp;</div>"; 
  
  if($jq===false) {
  $go=false;
  for($i=1;$i<=$max;$i++) {
    $go=true;
    if($i==$curr) { $c="<span class=\"curr\" style=\"font-size: 22px;\">".$i."</span>"; } else { $c=$i; }
    $return=$return." ".sett::nextflowsymbol." ".$c;
  }
  if($go) {
    $return="<span class=\"flow\">".$return."</span>";
  }
  } else {
    $return=$script;
  }
  return $return;
}
?>