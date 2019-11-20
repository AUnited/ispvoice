<?php
class domain
 {
 public $domain;
 public $extension;
 public $domex;
 public $item_id;
 public $item_price;
 //konstruktor
 public function __construct() {
  $GLOBALS["domain"]=$this->domain=substr(htmlspecialchars($_REQUEST["domain"]),0,100);
  $GLOBALS["extension"]=$this->extension=substr(htmlspecialchars($_REQUEST["extension"]),0,10);
  $GLOBALS["domex"]=$this->domex=substr(htmlspecialchars($_REQUEST["domex"]),0,100);
  $GLOBALS["dommsg"]="<img src=\"tpl/hostovat/images/info.png\" alt=\"i\" /> <span>".$GLOBALS["lang"]->tr("Check your domain")."</span>";
  if($this->domain!="") { $GLOBALS["ins_domain"]=$this->domain; }
  elseif($this->domex!="") {
    $domarr=explode(".",$this->domex,2);
    $GLOBALS["ins_domain"]=$this->domain=$domarr[0];
    $GLOBALS["extension"]=$this->extension=$domarr[1];
  }
  else { $GLOBALS["ins_domain"]=""; }
  
  if($_GET["type"]=="check") { $this->whois(); }
  if($_SERVER['REQUEST_METHOD'] == "POST" && $_GET["type"]=="buy") { $this->add_to_cart(); }
  if($_SERVER['REQUEST_METHOD'] == "POST" && $_GET["type"]=="del") { $this->del_dom(); }
  if($GLOBALS["infostyle"]=="") { $GLOBALS["infostyle"]="highlight"; }
 }
 
 public function whois() {
  
  $GLOBALS["dommsg"]="";
  $GLOBALS["domstat"]=Array("","");
  $GLOBALS["showorder"]=true;
  $GLOBALS["infostyle"]="highlight";
  $data=Array();
  
  if(sett::domcheck=="subreg") {
    include(sett::classes."domain.php");
    $domainreg=new domainreg();
    $data=$domainreg->whois($this->domain,$this->extension);
  } elseif(sett::domcheck=="whois") {
    include(sett::classes."whois.php");
    $domwhois=new domwhois();
    $data=$domwhois->get_stat($this->domain,$this->extension);
  } else {
    $domwhois=new domwhois();
    $data=$domwhois->get_stat($this->domain,$this->extension);
  }
  
  
  if($data["status"]=="ok") {
    $GLOBALS["showorder"]=true; $GLOBALS["infostyle"]="highlight";
    $GLOBALS["dommsg"]="<img src=\"tpl/hostovat/images/check.png\" alt=\"OK\" /> <span>".$GLOBALS["lang"]->tr("Domain checking success.")."</span>";
    $GLOBALS["domainname"]=$data["data"]["name"];
    if($data["data"]["avail"]==1) {
      $GLOBALS["domstat"]=Array("is free","You can order it.","Order domain");
      $GLOBALS["domstat_send"]="1";
    } elseif($data["data"]["avail"]==0) {
      $GLOBALS["domstat"]=Array("is occupied","If you are the owner, you can move it to us.","Extend the domain");
      $GLOBALS["domstat_send"]="0";
    }
  } elseif($data["status"]=="error") {
    $GLOBALS["showorder"]=false; $GLOBALS["infostyle"]="error";
    $GLOBALS["dommsg"]="<img src=\"tpl/hostovat/images/warning.png\" alt=\"Warning\" /> <span>".$GLOBALS["lang"]->tr($data["error"]["errormsg"])."</span>";
        
  } else {
    $GLOBALS["showorder"]=false; $GLOBALS["infostyle"]="error";
    $GLOBALS["dommsg"]="<img src=\"tpl/hostovat/images/close.png\" alt=\"Error\" /> <span>".$GLOBALS["lang"]->tr("An error occurred when verifying domain!")."</span>";
  }
 }
 
 public function generate_options() {
  $domains=$GLOBALS["config"]->select("domain");
  $domains=array_map("unserialize",array_unique(array_map("serialize",$domains)));
  $return="";
  foreach($domains as $item => $data) {
    $selected="";
    if($this->extension==$data[0]) { $selected=" selected=\"selected\""; }
    $return = $return."<option value=\"".$data[0]."\"".$selected.">.".$this->tld_equvivalent($data[0])."</option>";
  }
  return $return;
 }

 public function tld_equvivalent($tld) {
  $spectld=Array(
    "xn--p1ai"=>"рф"
  );
  
  if(isset($spectld[$tld])) { $rettld=$spectld[$tld]; } else { $rettld=$tld; }
  return $rettld;
 }
 
 public function add_to_cart() {
  $domain=htmlspecialchars($_POST["domain"]);
  $extension=htmlspecialchars($_POST["extension"]);
  $qty=htmlspecialchars($_POST["qty"]);
  $stat=htmlspecialchars($_POST["stat"]);
  if($domain!="" && $extension!="") {
    $domains=$GLOBALS["config"]->select("domain");
    $ext_arr=Array();
    foreach($domains as $item => $data) {
      if($data[0]==$extension) {
        $ext_arr=$data; break;
      }
    }
    $item_id=$ext_arr[1];
    $_SESSION["cart"]["domain"]=Array($item_id,$domain,$extension,$qty,$stat);
    if($_GET["edit"]!="") { Header("Location: index.php?m=summary"); die; } else {
    $currentnumber=array_search($GLOBALS["m"],$GLOBALS["pageflow"]);
    $gotomodule=$GLOBALS["pageflow"][($currentnumber+1)];
    Header("Location: index.php?m=".$gotomodule); die; }
  }
 }

 public function del_dom() {
  unset($_SESSION["cart"]["domain"]);
  if($_GET["edit"]!="") { Header("Location: index.php?m=summary"); die; } else {
  $currentnumber=array_search($GLOBALS["m"],$GLOBALS["pageflow"]);
  $gotomodule=$GLOBALS["pageflow"][($currentnumber+1)];
  Header("Location: index.php?m=".$gotomodule); die; }
 }
 }
 
$domain=new domain();
?>