<?php
class config
 {
  public function select($name="") {
    //get configs
    if($name!="") {
      $name="`name` = '".htmlspecialchars(addslashes($name))."' AND";
    } else {
      $name="";
    }
    $config=mysql_query("SELECT name,id,value,enabled FROM `".db_base::DBName."`.`".db_base::DBPrefix."settings` WHERE ".$name." `enabled` = 1 ORDER BY id ASC",$GLOBALS["DB0"]);
    
    if(mysql_num_rows($config) == 0) {
      return Array();
    } else {
      $output=Array();
      while($config_data=mysql_fetch_array($config)) { 
        $conf_arr=explode(";",$config_data[2]);
        $output[$config_data[1]]=$conf_arr;
      } 
      return $output;
    }
  }
 }
?>