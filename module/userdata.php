<?php
class userdata
 {
 //konstruktor
 public function __construct() {
  
  //the hosting must be selected!
  if(!isset($_SESSION["cart"]["hosting"]) || $_SESSION["cart"]["hosting"][0]=="") {
    Header("Location: index.php?m=plans"); die;
  }
  
  $GLOBALS["check"]["cond"]=$GLOBALS["check"]["dphpay"]="";
  $GLOBALS["error"]=false;
  $GLOBALS["logged"]=Array();
  if(sett::wpallow===true) {
    $GLOBALS["logged"]["id"]=0; //get user id from wordpress NOT SOLVED!
    $GLOBALS["logged"]["name"]="";
  } else {
    $GLOBALS["logged"]["id"]=0;
    $GLOBALS["logged"]["name"]="";
  }
  
  if(isset($_GET["edit"])) {
    $this->ins_forms();
  }
  
  $GLOBALS["conditions"]=$this->get_cond();
  
  if($_SERVER['REQUEST_METHOD'] == "POST") {
  
  $data=Array();
  $data["existuser"]=$GLOBALS["logged"]["id"];
  $data["login"]=htmlspecialchars($_POST["login"]);
  $data["fname"]=htmlspecialchars($_POST["fname"]);
  $data["lname"]=htmlspecialchars($_POST["lname"]);
  $data["gender"]=htmlspecialchars($_POST["gender"]);
  $data["email"]=htmlspecialchars($_POST["email"]);
  $data["phone"]=htmlspecialchars($_POST["phone"]);
  $data["nic"]=htmlspecialchars($_POST["sknic"]);
  $data["address"]=htmlspecialchars($_POST["address"]);
  $data["zipcode"]=htmlspecialchars($_POST["zipcode"]);
  $data["city"]=htmlspecialchars($_POST["city"]);
  $data["country"]=htmlspecialchars($_POST["country"]);
  $data["state"]=htmlspecialchars($_POST["state"]);
  $data["finame"]=htmlspecialchars($_POST["finame"]);
  $data["ico"]=htmlspecialchars($_POST["ico"]);
  $data["dic"]=htmlspecialchars($_POST["dic"]);
  $data["icdph"]=htmlspecialchars($_POST["icdph"]);
  $data["dphpay"]=htmlspecialchars($_POST["dphpay"]);
  $data["prip"]=htmlspecialchars($_POST["prip"]);
  $data["cond"]=htmlspecialchars($_POST["cond"]);
  $GLOBALS["data"]=$data;
  
  if(($this->checkform($data))===true) { $this->insert($data); }
  }
  
 }

 public function checkform($data) {
  $go=0;
  if($data["fname"]=="") { $this->error("Your first name is blank!"); return false; }
  if($data["lname"]=="") { $this->error("Your last name is blank!"); return false; }
  if($data["email"]=="") { $this->error("Your e-mail is blank!"); return false; }
  if($data["address"]=="") { $this->error("Your street is blank!"); return false; }
  if($data["zipcode"]=="") { $this->error("Your ZIP is blank!"); return false; }
  if($data["city"]=="") { $this->error("Your city is blank!"); return false; }
  if($data["country"]=="") { $this->error("Your country is blank!"); return false; }
  if($GLOBALS["logged"]["id"]==0 && $data["login"]=="") { $this->error("Please write your new login or sign-in to the page."); return false; }
  if($GLOBALS["logged"]["id"]==0 && (preg_match("/^[a-zA-Z0-9_-]{5,16}$/",$data["login"]))!="") { $go=1; } else { $this->error("Use only a-z A-Z 0-9 _ - chars with length 5-16!"); return false; }
  if(!filter_var($data["email"],FILTER_VALIDATE_EMAIL)) { $this->error("Your e-mail doesn't look like true!"); return false; }
  if(!is_numeric($data["zipcode"])) { $this->error("ZIP must be only with numbers!"); return false; }
  
  if(sett::wpallow===true) {
    if (username_exists($data["login"]) && $GLOBALS["logged"]["id"]==0) { $this->error("Your login name is in use, please select different one."); return false; }
    if (email_exists($data["email"]) && $GLOBALS["logged"]["id"]==0) { $this->error("Your e-mail is in use, please login in your account first."); return false; }
  }
  
  return true;
 }

 public function error($text) {
  $GLOBALS["error"]=$GLOBALS["lang"]->tr($text);
 }

 public function ins_forms() {
  $data=$_SESSION["cart"]["data"];
  $GLOBALS["data"]=$data;
  
  if($GLOBALS["data"]["cond"]) {
    $GLOBALS["check"]["cond"]=" checked=\"checked\"";
  }
  if($GLOBALS["data"]["dphpay"]) {
    $GLOBALS["check"]["dphpay"]=" checked=\"checked\"";
  }
 }

 public function insert($data) {
  if($_SESSION["cart"]["data"]=$data) {
    $currentnumber=array_search($GLOBALS["m"],$GLOBALS["pageflow"]);
    $gotomodule=$GLOBALS["pageflow"][($currentnumber+1)];
    Header("Location: index.php?m=".$gotomodule); die; }
 }
 
 public function get_cond() {
  $ordered_plan=htmlspecialchars(addslashes($_SESSION["cart"]["hosting"][0]));
  $result = mysql_query("SELECT id,tos FROM  `".db_isp::DBName."`.`hosting_plans` WHERE  `id` =".$ordered_plan." LIMIT 0,1",$GLOBALS["DB1"]);
  $row = mysql_fetch_row($result);
  if($row[1]!="") { return $row[1]; } else { return false; }
 }
 
 public function generate_options_gender($lang) {
  $return="";
  $values=Array();
  $values["U"]=$lang->tr("Undefined");
  $values["F"]=$lang->tr("Female");
  $values["M"]=$lang->tr("Male");
  foreach($values as $item => $data) {
    $selected="";
    if(isset($GLOBALS["data"]["gender"]) && $GLOBALS["data"]["gender"]==$item) { $selected=" selected=\"selected\""; }
    $return = $return."<option value=\"".$item."\"".$selected.">".$data."</option>";
  }
  return $return;
 }

 public function generate_options_country($lang) {
  $return="";
$values=Array();
$values["Afghanistan"]=$lang->tr("Afghanistan");
$values["Albania"]=$lang->tr("Albania");
$values["Algeria"]=$lang->tr("Algeria");
$values["Andorra"]=$lang->tr("Andorra");
$values["Antigua and Barbuda"]=$lang->tr("Antigua and Barbuda");
$values["Argentina"]=$lang->tr("Argentina");
$values["Armenia"]=$lang->tr("Armenia");
$values["Australia"]=$lang->tr("Australia");
$values["Austria"]=$lang->tr("Austria");
$values["Azerbaijan"]=$lang->tr("Azerbaijan");
$values["Bahamas"]=$lang->tr("Bahamas");
$values["Bahrain"]=$lang->tr("Bahrain");
$values["Bangladesh"]=$lang->tr("Bangladesh");
$values["Barbados"]=$lang->tr("Barbados");
$values["Belarus"]=$lang->tr("Belarus");
$values["Belgium"]=$lang->tr("Belgium");
$values["Belize"]=$lang->tr("Belize");
$values["Benin"]=$lang->tr("Benin");
$values["Bhutan"]=$lang->tr("Bhutan");
$values["Bolivia"]=$lang->tr("Bolivia");
$values["Bosnia and Herzegovina"]=$lang->tr("Bosnia and Herzegovina");
$values["Botswana"]=$lang->tr("Botswana");
$values["Brazil"]=$lang->tr("Brazil");
$values["Brunei"]=$lang->tr("Brunei");
$values["Bulgaria"]=$lang->tr("Bulgaria");
$values["Burkina Faso"]=$lang->tr("Burkina Faso");
$values["Burundi"]=$lang->tr("Burundi");
$values["Cambodia"]=$lang->tr("Cambodia");
$values["Cameroon"]=$lang->tr("Cameroon");
$values["Canada"]=$lang->tr("Canada");
$values["Cape Verde"]=$lang->tr("Cape Verde");
$values["Central African Republic"]=$lang->tr("Central African Republic");
$values["Chad"]=$lang->tr("Chad");
$values["Chile"]=$lang->tr("Chile");
$values["China"]=$lang->tr("China");
$values["Colombia"]=$lang->tr("Colombia");
$values["Comoros"]=$lang->tr("Comoros");
$values["Congo"]=$lang->tr("Congo");
$values["Costa Rica"]=$lang->tr("Costa Rica");
$values["Cote d'Ivoire"]=$lang->tr("Cote d'Ivoire");
$values["Croatia"]=$lang->tr("Croatia");
$values["Cuba"]=$lang->tr("Cuba");
$values["Cyprus"]=$lang->tr("Cyprus");
$values["Czech Republic"]=$lang->tr("Czech Republic");
$values["Denmark"]=$lang->tr("Denmark");
$values["Djibouti"]=$lang->tr("Djibouti");
$values["Dominica"]=$lang->tr("Dominica");
$values["Dominican Republic"]=$lang->tr("Dominican Republic");
$values["East Timor"]=$lang->tr("East Timor");
$values["Ecuador"]=$lang->tr("Ecuador");
$values["Egypt"]=$lang->tr("Egypt");
$values["El Salvador"]=$lang->tr("El Salvador");
$values["Equatorial Guinea"]=$lang->tr("Equatorial Guinea");
$values["Eritrea"]=$lang->tr("Eritrea");
$values["Estonia"]=$lang->tr("Estonia");
$values["Ethiopia"]=$lang->tr("Ethiopia");
$values["Fiji"]=$lang->tr("Fiji");
$values["Finland"]=$lang->tr("Finland");
$values["France"]=$lang->tr("France");
$values["Gabon"]=$lang->tr("Gabon");
$values["Gambia"]=$lang->tr("Gambia");
$values["Georgia"]=$lang->tr("Georgia");
$values["Germany"]=$lang->tr("Germany");
$values["Ghana"]=$lang->tr("Ghana");
$values["Greece"]=$lang->tr("Greece");
$values["Grenada"]=$lang->tr("Grenada");
$values["Guatemala"]=$lang->tr("Guatemala");
$values["Guinea"]=$lang->tr("Guinea");
$values["Guinea-Bissau"]=$lang->tr("Guinea-Bissau");
$values["Guyana"]=$lang->tr("Guyana");
$values["Haiti"]=$lang->tr("Haiti");
$values["Honduras"]=$lang->tr("Honduras");
$values["Hong Kong"]=$lang->tr("Hong Kong");
$values["Hungary"]=$lang->tr("Hungary");
$values["Iceland"]=$lang->tr("Iceland");
$values["India"]=$lang->tr("India");
$values["Indonesia"]=$lang->tr("Indonesia");
$values["Iran"]=$lang->tr("Iran");
$values["Iraq"]=$lang->tr("Iraq");
$values["Ireland"]=$lang->tr("Ireland");
$values["Israel"]=$lang->tr("Israel");
$values["Italy"]=$lang->tr("Italy");
$values["Jamaica"]=$lang->tr("Jamaica");
$values["Japan"]=$lang->tr("Japan");
$values["Jordan"]=$lang->tr("Jordan");
$values["Kazakhstan"]=$lang->tr("Kazakhstan");
$values["Kenya"]=$lang->tr("Kenya");
$values["Kiribati"]=$lang->tr("Kiribati");
$values["Kosovo"]=$lang->tr("Kosovo");
$values["North Korea"]=$lang->tr("North Korea");
$values["South Korea"]=$lang->tr("South Korea");
$values["Kuwait"]=$lang->tr("Kuwait");
$values["Kyrgyzstan"]=$lang->tr("Kyrgyzstan");
$values["Laos"]=$lang->tr("Laos");
$values["Latvia"]=$lang->tr("Latvia");
$values["Lebanon"]=$lang->tr("Lebanon");
$values["Lesotho"]=$lang->tr("Lesotho");
$values["Liberia"]=$lang->tr("Liberia");
$values["Libya"]=$lang->tr("Libya");
$values["Liechtenstein"]=$lang->tr("Liechtenstein");
$values["Lithuania"]=$lang->tr("Lithuania");
$values["Luxembourg"]=$lang->tr("Luxembourg");
$values["Macedonia"]=$lang->tr("Macedonia");
$values["Madagascar"]=$lang->tr("Madagascar");
$values["Malawi"]=$lang->tr("Malawi");
$values["Malaysia"]=$lang->tr("Malaysia");
$values["Maldives"]=$lang->tr("Maldives");
$values["Mali"]=$lang->tr("Mali");
$values["Malta"]=$lang->tr("Malta");
$values["Marshall Islands"]=$lang->tr("Marshall Islands");
$values["Mauritania"]=$lang->tr("Mauritania");
$values["Mauritius"]=$lang->tr("Mauritius");
$values["Mexico"]=$lang->tr("Mexico");
$values["Micronesia"]=$lang->tr("Micronesia");
$values["Moldova"]=$lang->tr("Moldova");
$values["Monaco"]=$lang->tr("Monaco");
$values["Mongolia"]=$lang->tr("Mongolia");
$values["Montenegro"]=$lang->tr("Montenegro");
$values["Morocco"]=$lang->tr("Morocco");
$values["Mozambique"]=$lang->tr("Mozambique");
$values["Myanmar"]=$lang->tr("Myanmar");
$values["Namibia"]=$lang->tr("Namibia");
$values["Nauru"]=$lang->tr("Nauru");
$values["Nepal"]=$lang->tr("Nepal");
$values["Netherlands"]=$lang->tr("Netherlands");
$values["New Zealand"]=$lang->tr("New Zealand");
$values["Nicaragua"]=$lang->tr("Nicaragua");
$values["Niger"]=$lang->tr("Niger");
$values["Nigeria"]=$lang->tr("Nigeria");
$values["Norway"]=$lang->tr("Norway");
$values["Oman"]=$lang->tr("Oman");
$values["Pakistan"]=$lang->tr("Pakistan");
$values["Palau"]=$lang->tr("Palau");
$values["Panama"]=$lang->tr("Panama");
$values["Papua New Guinea"]=$lang->tr("Papua New Guinea");
$values["Paraguay"]=$lang->tr("Paraguay");
$values["Peru"]=$lang->tr("Peru");
$values["Philippines"]=$lang->tr("Philippines");
$values["Poland"]=$lang->tr("Poland");
$values["Portugal"]=$lang->tr("Portugal");
$values["Puerto Rico"]=$lang->tr("Puerto Rico");
$values["Qatar"]=$lang->tr("Qatar");
$values["Romania"]=$lang->tr("Romania");
$values["Russia"]=$lang->tr("Russia");
$values["Rwanda"]=$lang->tr("Rwanda");
$values["Saint Kitts and Nevis"]=$lang->tr("Saint Kitts and Nevis");
$values["Saint Lucia"]=$lang->tr("Saint Lucia");
$values["Saint Vincent and the Grenadines"]=$lang->tr("Saint Vincent and the Grenadines");
$values["Samoa"]=$lang->tr("Samoa");
$values["San Marino"]=$lang->tr("San Marino");
$values["Sao Tome and Principe"]=$lang->tr("Sao Tome and Principe");
$values["Saudi Arabia"]=$lang->tr("Saudi Arabia");
$values["Senegal"]=$lang->tr("Senegal");
$values["Serbia and Montenegro"]=$lang->tr("Serbia and Montenegro");
$values["Seychelles"]=$lang->tr("Seychelles");
$values["Sierra Leone"]=$lang->tr("Sierra Leone");
$values["Singapore"]=$lang->tr("Singapore");
$values["Slovakia"]=$lang->tr("Slovakia");
$values["Slovenia"]=$lang->tr("Slovenia");
$values["Solomon Islands"]=$lang->tr("Solomon Islands");
$values["Somalia"]=$lang->tr("Somalia");
$values["South Africa"]=$lang->tr("South Africa");
$values["Spain"]=$lang->tr("Spain");
$values["Sri Lanka"]=$lang->tr("Sri Lanka");
$values["Sudan"]=$lang->tr("Sudan");
$values["Suriname"]=$lang->tr("Suriname");
$values["Swaziland"]=$lang->tr("Swaziland");
$values["Sweden"]=$lang->tr("Sweden");
$values["Switzerland"]=$lang->tr("Switzerland");
$values["Syria"]=$lang->tr("Syria");
$values["Taiwan"]=$lang->tr("Taiwan");
$values["Tajikistan"]=$lang->tr("Tajikistan");
$values["Tanzania"]=$lang->tr("Tanzania");
$values["Thailand"]=$lang->tr("Thailand");
$values["Togo"]=$lang->tr("Togo");
$values["Tonga"]=$lang->tr("Tonga");
$values["Trinidad and Tobago"]=$lang->tr("Trinidad and Tobago");
$values["Tunisia"]=$lang->tr("Tunisia");
$values["Turkey"]=$lang->tr("Turkey");
$values["Turkmenistan"]=$lang->tr("Turkmenistan");
$values["Tuvalu"]=$lang->tr("Tuvalu");
$values["Uganda"]=$lang->tr("Uganda");
$values["Ukraine"]=$lang->tr("Ukraine");
$values["United Arab Emirates"]=$lang->tr("United Arab Emirates");
$values["United Kingdom"]=$lang->tr("United Kingdom");
$values["United States of America"]=$lang->tr("United States of America");
$values["Uruguay"]=$lang->tr("Uruguay");
$values["Uzbekistan"]=$lang->tr("Uzbekistan");
$values["Vanuatu"]=$lang->tr("Vanuatu");
$values["Vatican City"]=$lang->tr("Vatican City");
$values["Venezuela"]=$lang->tr("Venezuela");
$values["Vietnam"]=$lang->tr("Vietnam");
$values["Yemen"]=$lang->tr("Yemen");
$values["Zambia"]=$lang->tr("Zambia");
$values["Zimbabwe"]=$lang->tr("Zimbabwe");

sort($values,SORT_LOCALE_STRING);

  foreach($values as $item => $data) { echo $GLOBALS["data"]["country"];
    $selected="";
    if(isset($GLOBALS["data"]["country"]) && $GLOBALS["data"]["country"]==$data) { $selected=" selected=\"selected\""; }
    $return = $return."<option value=\"".$data."\"".$selected.">".$data."</option>";
  }
  return $return;
 }
 
 }
 
$userdata=new userdata();
?>