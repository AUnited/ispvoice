<?php
class session
 {
 public function save($name,$value)
  {
    $_SESSION[$name]=$value;
  }
  
 public function save_arr($array)
  {
    foreach($array as $name->$value) {
      $_SESSION[$name]=$value;
    }
  }
  
 public function read($sess)
  {
    return $_SESSION[$sess];
  }

 }
?>