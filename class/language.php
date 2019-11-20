<?php
class lang
 {
 public $lang;
 public $sitelang;
 
 public function select($module,$folder,$lang_name)
  {
    $lang_locale=substr((htmlspecialchars($lang_name)),0,5);
    $lang_name = strtolower(substr((htmlspecialchars($lang_name)),0,2));
    if($lang_name!="") {
      $langu=$lang_name;
      $_SESSION["lang"]=$langu;
      $locale=$lang_locale;
      $_SESSION["locale"]=$locale;
    } else {
      if($_SESSION["lang"]!="") {
        $langu=htmlspecialchars($_SESSION["lang"]);
      } else {
        $langu = strtolower(substr((htmlspecialchars($_SERVER['HTTP_ACCEPT_LANGUAGE'])),0,2));
        $_SESSION["lang"]=$langu;
      }
      if($_SESSION["locale"]!="") {
        $locale=htmlspecialchars($_SESSION["locale"]);
      } else {
        $locale = substr((htmlspecialchars($_SERVER['HTTP_ACCEPT_LANGUAGE'])),0,5);
        $locale = str_replace("-","_",$locale);
        $_SESSION["locale"]=$locale;
      }
    }
    
    $this->sitelang=$this->lang="";
    $lang_base=$folder.$langu."/_all.php";
    $lang_path=$folder.$langu."/".$module.".php";
    $GLOBALS["l"]=$langu;
    setlocale(LC_COLLATE,$locale.".UTF-8");
    if(file_exists($lang_path) || file_exists($lang_base)) {
      if(@include($lang_base)) { $this->sitelang=$sitelang; }
      if(@include($lang_path)) { $this->lang=$lang; }
      return true;
    } else {
        return false;
    }
  }
  
 public function tr($string)
  {
    $array=Array();
    if($this->lang!="" && $this->sitelang!="") {
      $array=array_merge($this->lang,$this->sitelang);
    } elseif($this->lang!="") {
      $array=$this->lang;
    } elseif($this->sitelang!="") {
      $array=$this->sitelang;
    }
    
    if(!empty($array) && isset($array[$string])) {
      $string=strtr($string,$array);
    } else {
      $string=$string;
    }
    return $string;
  }
  
 public function change($lang) {
  if($lang!="") {
    $lang=htmlspecialchars($lang);
    $_SESSION["lang"]=$lang;
  }
 }
 }
?>