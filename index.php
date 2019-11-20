<?php
if(file_exists("config/wordpress.conf.php")) { @include("config/wordpress.conf.php"); }

class engine
{

public function __construct() {

if(require("config/db_isp.conf.php")) { if(class_exists("db_isp")) { $db_isp=new db_isp(); } else { die("Error: Cannot inciate the ISP db class!"); } }
else { die("Error: Cannot connect to the ISP db!"); }
if(require("config/db.conf.php")) { if(class_exists("db_base")) { $db_base=new db_base(); } else { die("Error: Cannot inciate the base db class!"); } }
else { die("Error: Cannot connect to the base db!"); }
if(require("config/config.conf.php")) { if(class_exists("sett")) { $sett=new sett(); } else { die("Error: Cannot inciate the settings class!"); } }
else { die("Error: Cannot connect to the settings!"); }

//CURRENT VERSION
$GLOBALS["version"]="1.20 beta (hotfix-1)";

//redirect
if(sett::redirect!="") {
  header("HTTP/1.1 301 Moved Permanently");
  header("Location: ".sett::redirect);
  header("Connection: close");
  exit();
} elseif(sett::redirectwww===true) {
  if ((substr($_SERVER["HTTP_HOST"],0,4))!="www.")
    {
      header("HTTP/1.1 301 Moved Permanently");
      header("Location: http://www.".$_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"]);
      header("Connection: close");
      exit();
    }
}

//debug
if(sett::debug===true) {
error_reporting(E_ALL); $start=microtime(true); } else { error_reporting(0); }

//start DB
if(file_exists(sett::classes."db.php")) {
  include_once(sett::classes."db.php");
  if(class_exists("db")) {
    $db = new db(db_base::DBServer,db_base::DBPort,db_base::DBUser,db_base::DBPassword,db_base::DBName);
    $db_ispcp = new db(db_isp::DBServer,db_isp::DBPort,db_isp::DBUser,db_isp::DBPassword,db_isp::DBName);
  }
}

session_start();
                               
$GLOBALS["DB0"] = $db->start(db_base::DBName,db_base::DBCodeSet);
$GLOBALS["DB1"] = $db_ispcp->start(db_isp::DBName,db_isp::DBCodeSet);
$GLOBALS["server"] = str_replace("www.","",$_SERVER["SERVER_NAME"]);

//select region
$m=$GLOBALS["m"]="";
if(isset($_REQUEST["m"])) { $request_m=$_REQUEST["m"]; } else { $request_m=""; }
if($request_m!="") { $GLOBALS["m"]=$m=substr(htmlspecialchars($request_m),0,20); }
$modules=Array("domain","plans","userdata","summary","info","package_info","domain_list","ipn_paypal");
$pageflow=$GLOBALS["pageflow"]=explode(",",sett::pageflow);
//include code
if(in_array($m,$modules)) {
  $this->start_page($m);
} else {
  $this->start_page($pageflow[0]);
}
//end DB
$db->ending;
$db_ispcp->ending;

//debug
if(sett::debug===true) {
echo "<div id=\"debug\"><b style=\"color: red;\">Debug mode enabled</b><br /><b>Version:</b> ".$GLOBALS["version"]."<br /><b>Error reporting:</b> ALL<br /><b>Flush:</b> ".((microtime(true)-$start)*1000000)." µs</div>"; }
}

public function start_page($m) {
 
  //config
  @require(sett::classes."config.php");
  if(class_exists("config")) { $GLOBALS["config"]=$config=new config(); }

  //sessions
  @require(sett::classes."session.php");
  if(class_exists("session")) { $sess=$GLOBALS["sess"]=new session(); }

  //language
  @include(sett::classes."language.php");
  if(class_exists("lang")) { $GLOBALS["lang"]=$lang=new lang(); }
  if(isset($_GET["l"])) { $get_l=$_GET["l"]; } else { $get_l=""; }
  $lang->select($m,sett::languages,$get_l);

  //money
  @require(sett::classes."money.php");
  if(class_exists("curr_convert")) { $GLOBALS["money"]=$money=new curr_convert(); }
  if(isset($_GET["curr"])) { $get_curr=$_GET["curr"]; } else { $get_curr=""; }
  $money->detect($get_curr);

  //plugins
  $plugs=explode(",",sett::plugin);
  foreach($plugs as $items) {
    $link=sett::plugins.$items."/".$m.".plug.php";
    if(file_exists($link) && is_file($link)) { include($link); $GLOBALS["plug"][$items]=true; }
    else { $GLOBALS["plug"][$items]=false; }
  }

  //module
  @require(sett::modules.$m.".php");

  //template
  //add navigation
  @include(sett::templates.sett::template."/add_step.php");
  $tpl_base=sett::templates."/".sett::template."/";
  $tpl=$tpl_base.$m.".php";
  
  //headline
  $head_search=array();
  $head_replace=array();
  $head_search[]="{SERVER}";
  $head_replace[]=ucfirst($GLOBALS["server"]);
  $head_search[]="{MODULE}";
  $head_replace[]=$lang->tr("title_".$m);
  $GLOBALS["headline"]=str_replace($head_search,$head_replace,sett::headline);
  
  // INICIALIZE ////////////////
    //header
  if(file_exists($tpl) && file_exists($tpl_base."_header.php") && (sett::header=="ispvoice")) { @include($tpl_base."_header.php"); }
  elseif(file_exists($tpl) && (sett::wpallow===true) && (sett::header=="wp")) { get_header(); }
  elseif(file_exists($tpl) && sett::header=="ispcp") { echo $this->get_ispcp("header",sett::reseller); }
    //internal scripts
  if(file_exists($tpl) && file_exists($tpl_base."_scripts.php") && (sett::usescripts===true)) { @require($tpl_base."_scripts.php"); }
    //menu
  if(file_exists($tpl) && sett::menu===true) { @include($tpl_base."_menu.php"); }
    // MODULE
  if(file_exists($tpl)) { @include($tpl); }
    //wp sidebar
  if(file_exists($tpl) && (sett::wpallow===true) && (sett::wpsidebar===true)) { get_sidebar(); }
    //footer
  if(file_exists($tpl) && file_exists($tpl_base."_footer.php") && (sett::footer=="ispvoice")) { @include($tpl_base."_footer.php"); }
  elseif(file_exists($tpl) && (sett::wpallow===true) && (sett::footer=="wp")) { get_footer(); }
  elseif(file_exists($tpl) && sett::footer=="ispcp") { echo $this->get_ispcp("footer",sett::reseller); }
    //Google analytics
  if(file_exists($tpl) && (file_exists($tpl_base."_analytics.php")) && (sett::UrchinTr!="")) { @include($tpl_base."_analytics.php"); }
}

public function get_ispcp($what,$user_id) {
  $query="";
  if($what=="header") {
    $query="SELECT user_id,header FROM `orders_settings` WHERE `user_id`=".$user_id." LIMIT 0,1";
  } elseif($what=="footer") {
    $query="SELECT user_id,footer FROM `orders_settings` WHERE `user_id`=".$user_id." LIMIT 0,1";
  }
  if(@$result=mysql_query($query,$GLOBALS["DB1"])) {
    $row = mysql_fetch_row($result);
    if($row[1]!="") {
      return $row[1];
    } else {
      return "";
    }
  } else {
    return false;
  }
}

}
$engine=new engine();
?>