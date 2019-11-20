<?php
class info
 {

public function __construct() {
  $GLOBALS["ok"]=htmlspecialchars($_GET["ok"]);
  $GLOBALS["msg"]=htmlspecialchars($_GET["msg"]);
  
  if($GLOBALS["ok"]=="1") {
    $GLOBALS["text"]=$GLOBALS["lang"]->tr("On your mail was send next informations.");
    if($GLOBALS["msg"]=="success") {
      $GLOBALS["text1"]=$GLOBALS["lang"]->tr("The invoice has been saved, please check your mail and pay the money.");
    }else {
      $GLOBALS["text1"]=$GLOBALS["lang"]->tr("");
    }
  } else {
    $GLOBALS["text"]=$GLOBALS["lang"]->tr("Processing order failed.");
    if($GLOBALS["msg"]=="isp") {
      $GLOBALS["text1"]=$GLOBALS["lang"]->tr("Error: Fail to load extended database.");
    } elseif($GLOBALS["msg"]=="db") {
      $GLOBALS["text1"]=$GLOBALS["lang"]->tr("Error: Fail to load local database.");
    } elseif($GLOBALS["msg"]=="mail") {
      $GLOBALS["text1"]=$GLOBALS["lang"]->tr("Error: Fail to send e-mail.");
    } elseif($GLOBALS["msg"]=="exist") {
      $GLOBALS["text1"]=$GLOBALS["lang"]->tr("Error: Order already created. Wait for processing.");
    } elseif($GLOBALS["msg"]=="paypal_cancel") {
      $GLOBALS["text1"]=$GLOBALS["lang"]->tr("You cancel the paypal payment.");
    } else {
      $GLOBALS["text1"]=$GLOBALS["lang"]->tr("Error: unknown error, please contact Admin.");
    }
  }
}

 }
$info=new info;
?>