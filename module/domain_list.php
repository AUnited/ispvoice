<?php
class domain_list
 {
 public function generate_list() {
  $domains=$GLOBALS["config"]->select("domain");
  
  $return=Array();
  $return=$domains;
  
  return $return;
 }
 
 }
$domain_list=new domain_list();
?>