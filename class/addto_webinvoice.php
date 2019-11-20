<?php
class add_to_db
{

 public function web_invoice($id,$idval,$key,$data,$dblink) {
$time=time();
$duedate_res=86400*sett::duedate;
$duedate_ts=$time+$duedate_res;
$item=Array();

//hosting & domain
if($data["hosting_name"]!="" && $data["dom_dom"]!="") {
  $title=$data["hosting_name"];
  $description=$data["hosting_name"]." & ".$data["dom_dom"];

$item[]=Array(
"name"=>"Webhosting",
"description"=>htmlspecialchars($data["hosting_name"]),
"quantity"=>htmlspecialchars($data["hosting_dur"]),
"price"=>htmlspecialchars($data["hosting_price1"])
);
$item[]=Array(
"name"=>"Domain",
"description"=>htmlspecialchars($data["dom_dom"]),
"quantity"=>htmlspecialchars(ceil($data["dom_dur"]/12)),
"price"=>htmlspecialchars($data["dom_p"])
);
if($data["hosting_price2"]!="" && $data["hosting_price2"]>0) {
$item[]=Array(
"name"=>"Setup",
"description"=>"Setup fee",
"quantity"=>"1",
"price"=>htmlspecialchars($data["hosting_price2"])
);

}  
  
} elseif($data["hosting_name"]!="") {
  $title=$data["hosting_name"];
  $description=$data["hosting_name"];
  
$item[]=Array(
"name"=>"Webhosting",
"description"=>htmlspecialchars($data["hosting_name"]),
"quantity"=>htmlspecialchars($data["hosting_dur"]),
"price"=>htmlspecialchars($data["hosting_price1"])
);
if($data["hosting_price2"]!="" && $data["hosting_price2"]>0) {
$item[]=Array(
"name"=>"Setup",
"description"=>"Setup fee",
"quantity"=>"1",
"price"=>htmlspecialchars($data["hosting_price2"])
);

}

} elseif($data["dom_dom"]!="") {
  $title=$data["dom_dom"];
  $description=$data["dom_dom"];
  
$item[]=Array(
"name"=>"Domain",
"description"=>htmlspecialchars($data["dom_dom"]),
"quantity"=>htmlspecialchars(ceil($data["dom_dur"]/12)),
"price"=>htmlspecialchars($data["dom_p"])
);

}

//invoice
if($data["invoiceid"]!="") {
  $inv_price=$GLOBALS["config"]->select("invoice");
  $name=$inv_price[$data["invoiceid"]][0];
  $price=$inv_price[$data["invoiceid"]][2];
  $quant=$inv_price[$data["invoiceid"]][1];
  $item[]=Array(
  "name"=>"Invoice",
  "description"=>$name,
  "quantity"=>$quant,
  "price"=>$price
  );
}

//sort($item);
$order=$item;

require(sett::classes."wpconvert.php");
$wpconvert=new wpconvert;
$items=$wpconvert->toarray($order);
$itemized=rawurlencode($items);

if($data["existuser"]>0) {
  $userid=addslashes(htmlspecialchars($data["existuser"]));
} else {
  $userid=$this->createuser($data,$key,$dblink);
}

$query="INSERT INTO `".db_base::DBName."`.`".db_base::DBWPPrefix."web_invoice_main` (
`id`, 
`invoice_date`, 
`amount`, 
`description`, 
`invoice_num`, 
`user_id`, 
`subject`, 
`itemized`, 
`status`
) VALUES (
NULL, 
CURRENT_TIMESTAMP, 
'".addslashes(htmlspecialchars($data["final_amount"]))."', 
'".addslashes(htmlspecialchars($description))."', 
'".$idval."', 
'".$userid."', 
'".addslashes(htmlspecialchars($title))."', 
'".$itemized."', 
'0'
);
";

$query1="INSERT INTO `".db_base::DBName."`.`".db_base::DBWPPrefix."web_invoice_meta` (
`meta_id`,
`invoice_id`,
`meta_key`,
`meta_value`
) VALUES (
NULL,
'".$idval."',
'web_invoice_custom_invoice_id',
'".$idval."'
),
(
NULL,
'".$idval."',
'ispcp_id',
'".$id."'
),
(
NULL,
'".$idval."',
'tax_value',
'a:1:{i:0;s:2:\"0\";}'
),
(
NULL,
'".$idval."',
'web_invoice_currency_code',
'".sett::money_currency_name."'
),
(
NULL,
'".$idval."',
'web_invoice_due_date_day',
'".date("j",$duedate_ts)."'
),
(
NULL,
'".$idval."',
'web_invoice_due_date_month',
'".date("m",$duedate_ts)."'
),
(
NULL,
'".$idval."',
'web_invoice_due_date_year',
'".date("Y",$duedate_ts)."'
),
(
NULL,
'".$idval."',
'web_invoice_payment_methods',
'".sett::gateways."'
),
(
NULL,
'".$idval."',
'sent_date',
'".date("Y-m-d",$time)."'
),
(
NULL,
'".$idval."',
'reseller',
'".sett::reseller."'
),
(
NULL,
'".$idval."',
'comments',
'".addslashes(htmlspecialchars($data["prip"]))."'
),
(
NULL,
'".$idval."',
'payment_duration',
'".addslashes(htmlspecialchars($data["hosting_dur"]))."'
),
(
NULL,
'".$idval."',
'payment_end',
'".addslashes(htmlspecialchars(($data["hosting_dur"]*2592000)+$time))."'
)
;";

if(mysql_query($query,$dblink) && mysql_query($query1,$dblink)) { return true; } else { return false; }
 }

 public function createuser($data,$key,$dblink) {

  require_once($GLOBALS["wppath"]."wp-includes/registration.php");
  
  $user_id = wp_create_user(addslashes(htmlspecialchars($data["login"])),$key,addslashes(htmlspecialchars($data["email"])));
  
  $meta=Array(
  //"first_name"=>addslashes(htmlspecialchars($data["fname"])), //WTF Wordpress?
  //"last_name"=>addslashes(htmlspecialchars($data["lname"])),
  "nickname"=>addslashes(htmlspecialchars($data["login"])),
  "gender"=>addslashes(htmlspecialchars($data["gender"])),
  "phonenumber"=>addslashes(htmlspecialchars($data["phone"])),
  "wp_user_level"=>"0",
  "company_name"=>addslashes(htmlspecialchars($data["finame"])),
  "streetaddress"=>addslashes(htmlspecialchars($data["address"])),
  "city"=>addslashes(htmlspecialchars($data["city"])),
  "zip"=>addslashes(htmlspecialchars($data["zipcode"])),
  "state"=>addslashes(htmlspecialchars($data["state"])),
  "country"=>addslashes(htmlspecialchars($data["country"])),
  "nic"=>addslashes(htmlspecialchars($data["nic"])),
  "ico"=>addslashes(htmlspecialchars($data["ico"])),
  "dic"=>addslashes(htmlspecialchars($data["dic"])),
  "icdph"=>addslashes(htmlspecialchars($data["icdph"])),
  "dphpayer"=>addslashes(htmlspecialchars($data["dphpay"])),
  "tax_id"=>"1",
  "managetoplevel_page_web-invoice_page_overviewcolumnshidden"=>"a:6:{i:0;s:4:\"user\";i:1;s:11:\"wp_username\";i:2;s:8:\"due_date\";i:3;s:0:\"\";i:4;s:0:\"\";i:5;s:0:\"\";}",
  "manageinvoices_page_recurring_billingcolumnshidden"=>"a:8:{i:0;s:4:\"user\";i:1;s:10:\"user_email\";i:2;s:12:\"company_name\";i:3;s:9:\"date_sent\";i:4;s:0:\"\";i:5;s:0:\"\";i:6;s:0:\"\";i:7;s:0:\"\";}"
  );

  foreach($meta as $key => $value) {
    add_user_meta($user_id, $key, $value, true);
  }
  
  $query="INSERT INTO `".db_base::DBName."`.`".db_base::DBWPPrefix."usermeta` (
  `umeta_id`, 
  `user_id`, 
  `meta_key`, 
  `meta_value`
  ) VALUES (
  NULL, 
  '".$user_id."', 
  'first_name', 
  '".addslashes(htmlspecialchars($data["fname"]))."'
  ),
  (
  NULL, 
  '".$user_id."', 
  'last_name', 
  '".addslashes(htmlspecialchars($data["lname"]))."'
  )
  ;";
  @mysql_query($query,$dblink);
  
  return $user_id;

 }



 public function ispcp($data,$dblink) {
$time=time();

$query="INSERT INTO `".db_isp::DBName."`.`orders` (
`id` ,
`user_id` ,
`plan_id` ,
`date` ,
`domain_name` ,
`customer_id` ,
`fname` ,
`lname` ,
`gender` ,
`firm` ,
`zip` ,
`city` ,
`state` ,
`country` ,
`email` ,
`phone` ,
`fax` ,
`street1` ,
`street2` ,
`status`
)
VALUES (
'".$GLOBALS["idkey"]."',
'".sett::reseller."',
'".addslashes(htmlspecialchars($data["hosting_id"]))."',
'".$time."',
'".addslashes(htmlspecialchars($data["dom_dom"]))."',
'".addslashes(htmlspecialchars($data["existuser"]))."',
'".addslashes(htmlspecialchars($data["fname"]))."',
'".addslashes(htmlspecialchars($data["lname"]))."',
'".addslashes(htmlspecialchars($data["gender"]))."',
'".addslashes(htmlspecialchars($data["finame"]))."',
'".addslashes(htmlspecialchars($data["zipcode"]))."',
'".addslashes(htmlspecialchars($data["city"]))."',
'".addslashes(htmlspecialchars($data["state"]))."',
'".addslashes(htmlspecialchars($data["country"]))."',
'".addslashes(htmlspecialchars($data["email"]))."',
'".addslashes(htmlspecialchars($data["phone"]))."',
'',
'".addslashes(htmlspecialchars($data["address"]))."',
'',
'new'
);";

$addto=$id=false;
$addto=mysql_query($query,$dblink);
$id=mysql_insert_id($dblink);

if($addto && $id) { return $id; } else { return false; }
 }

}
?>