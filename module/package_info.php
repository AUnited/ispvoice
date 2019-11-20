<?php
class package_info
 {
 
 public function __construct() {
  if(isset($_GET["id"]) && $_GET["id"]!="") { $this->get_plan($_GET["id"]); } else { die("Error: Please select plan ID!"); }
 }

 public function get_plan($id) {
  $id=addslashes(htmlspecialchars($id));
  $result = mysql_query("SELECT id,name,props,price,setup_fee,status,description FROM `".db_isp::DBName."`.`hosting_plans` WHERE  `id` = ".$id." LIMIT 0,1",$GLOBALS["DB1"]);
  $props=mysql_fetch_row($result);
  list($GLOBALS["hp_php"], $GLOBALS["hp_cgi"], $GLOBALS["hp_sub"], $GLOBALS["hp_als"], $GLOBALS["hp_mail"], $GLOBALS["hp_ftp"], $GLOBALS["hp_sql_db"], $GLOBALS["hp_sql_user"], $GLOBALS["hp_traff"], $GLOBALS["hp_disk"], $GLOBALS["hp_backup"], $GLOBALS["hp_dns"]) = explode(";", $props[2]);
  $GLOBALS["hp_name"]=$props[1];
  $GLOBALS["hp_id"]=$props[0];
  $GLOBALS["hp_price"]=$props[3];
  $GLOBALS["hp_setup"]=$props[4];
  $GLOBALS["hp_status"]=$props[5];
  $GLOBALS["hp_desc"]=$props[6];
  
  //change preddefined
  if($GLOBALS["hp_als"]==-1) { $GLOBALS["hp_als"]="&infin;"; }
  if($GLOBALS["hp_sub"]==-1) { $GLOBALS["hp_sub"]="&infin;"; }
  if($GLOBALS["hp_mail"]==-1) { $GLOBALS["hp_mail"]="&infin;"; }
  if($GLOBALS["hp_ftp"]==-1) { $GLOBALS["hp_ftp"]="&infin;"; }
  if($GLOBALS["hp_sql_db"]==-1) { $GLOBALS["hp_sql_db"]="&infin;"; }
  if($GLOBALS["hp_sql_user"]==-1) { $GLOBALS["hp_sql_user"]="&infin;"; }
 }
 
 }
$package_info=new package_info;
?>