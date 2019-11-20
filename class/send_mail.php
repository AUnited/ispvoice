<?php
class send_mail
{
 public function buyer($id,$idval,$email,$key,$l="en",$data,$server) {
$link=sett::languages.$l."/_mail_buyer.php";
$link1=sett::languages."en/_mail_buyer.php";

if(file_exists($link)) {
  $text=file_get_contents($link);
} elseif(file_exists($link1)) {
  $text=file_get_contents($link1);
} else {
  $text="No template selected!";
}
if(sett::showallinvoices===true) {
  $inv_codlink=md5($idval);
  $inv_url="http://".$server."/wordpress/?page_id=".sett::wppageid_invoice."&invoice_id=".$inv_codlink;
} else {
  $inv_url="[HIDDEN]";
}

$search=array();
$replace=array();

$search[]="{DOMAIN}";
$replace[]=$data["dom_dom"];
$search[]="{DOMAINPRICE}";
$replace[]=$data["dom_price"];
$search[]="{HOSTING}";
$replace[]=$data["hosting_name"];
$search[]="{HOSTINGPRICE}";
$replace[]=$data["hosting_price1"];
$search[]="{HOSTINGPRICEFEE}";
$replace[]=$data["hosting_price2"];
$search[]="{PRICE}";
$replace[]=$data["final_amount"];
$search[]="{LOGIN}";
$replace[]=$data["login"];
$search[]="{FNAME}";
$replace[]=$data["fname"];
$search[]="{LNAME}";
$replace[]=$data["lname"];
$search[]="{VARIABLE}";
$replace[]=$idval;
$search[]="{HOSTPERIOD}";
$replace[]=$data["period"];
$search[]="{DOMPERIOD}";
$replace[]=$data["dom_dur"];
$search[]="{DESCRIPTIONS}";
$replace[]=$data["prip"];
$search[]="{KEY}";
$replace[]=$key;
$search[]="{CURR}";
$replace[]=sett::curr;
$search[]="{SERVER}";
$replace[]=$server;
$search[]="{INV}";
$replace[]=$inv_url;

$text = str_replace($search, $replace, $text);

$to      = htmlspecialchars($data["email"]);
$subject = $GLOBALS["lang"]->tr("Order");
$message = $text;
$headers = "From: ".sett::reseller_name." <".sett::mail_from.">\r\n".
    "Reply-To: ".$email."\r\n".
    "MIME-Version: 1.0\r\n".
    "Content-Transfer-Encoding: 8bit\r\n".
    "Content-Type: text/html; charset=\"UTF-8\"";
$send=mail($to, $subject, $message, $headers);
if($send) { return true; } else { return false; }
 }

 public function reseller($id,$idval,$email,$data,$server) {
$link=sett::languages.sett::maillang."/_mail_reseller.php";
$text=file_get_contents($link);

$inv_codlink=md5($idval);
$inv_url="http://".$server."/wordpress/?page_id=".sett::wppageid_invoice."&invoice_id=".$inv_codlink;

$search=array();
$replace=array();

$search[]="{DOMAIN}";
$replace[]=$data["dom_dom"];
$search[]="{DOMAINPRICE}";
$replace[]=$data["dom_price"];
$search[]="{HOSTING}";
$replace[]=$data["hosting_name"];
$search[]="{HOSTINGPRICE}";
$replace[]=$data["hosting_price1"];
$search[]="{HOSTINGPRICEFEE}";
$replace[]=$data["hosting_price2"];
$search[]="{PRICE}";
$replace[]=$data["final_amount"];
$search[]="{FNAME}";
$replace[]=$data["fname"];
$search[]="{LNAME}";
$replace[]=$data["lname"];
$search[]="{VARIABLE}";
$replace[]=$idval;
$search[]="{HOSTPERIOD}";
$replace[]=$data["period"];
$search[]="{DOMPERIOD}";
$replace[]=$data["dom_dur"];
$search[]="{DESCRIPTIONS}";
$replace[]=$data["prip"];
$search[]="{CURR}";
$replace[]=sett::curr;
$search[]="{SERVER}";
$replace[]=$server;
$search[]="{INV}";
$replace[]=$inv_url;
$search[]="{WEBADMIN}";
$replace[]=sett::webadmin_path;

$text = str_replace($search, $replace, $text);

$to = $email.", ".sett::ccmail;
$subject = $GLOBALS["lang"]->tr("New order");
$message = $text;
$headers = "From: ".sett::reseller_name." <".sett::mail_from.">\r\n".
    "Reply-To: ".htmlspecialchars($data["email"])."\r\n".
    "MIME-Version: 1.0\r\n".
    "Content-Transfer-Encoding: 8bit\r\n".
    "Content-Type: text/html; charset=\"UTF-8\"";
$send=mail($to, $subject, $message, $headers);
if($send) { return true; } else { return false; }
 }

}
?>