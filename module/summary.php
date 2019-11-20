<?php
class summary
 {
  public function __construct() {
    if(isset($_GET["new"])) {
      $this->start();
      $this->generate_captcha();
      $this->show_captcha();
    } elseif(isset($_POST["recalculate"])) {
      $this->start();
      $this->show_captcha();
    } elseif(isset($_POST["Submit"])) {
      $this->start();
      $this->post_order();
      $this->show_captcha();
    } else {
      $this->start();
      $this->generate_captcha();
    }
    
  }
  
  public function start() {

    $GLOBALS["data"]=$data=$_SESSION["cart"]["data"];
    $GLOBALS["domain"]=$domain=$_SESSION["cart"]["domain"];
    $GLOBALS["hosting"]=$hosting=$_SESSION["cart"]["hosting"];
    $GLOBALS["payment_sel"]=$this->generate_payment();
    $GLOBALS["invoice_sel"]=$this->generate_options_invoicement();
    $invoice=$GLOBALS["data"]["invoiceid"]=addslashes(htmlspecialchars($GLOBALS["data"]["inv"]));
    $inv_price=$this->get_inv($invoice);
    
    $period=addslashes(htmlspecialchars($GLOBALS["data"]["period"]));
    $payment_val=addslashes(htmlspecialchars($GLOBALS["data"]["payment_val"]));
    
    $host_name=$GLOBALS["hosting"][1];
    if($host_name!="") {
      $plan=$this->get_plan();
      $GLOBALS["data"]["hosting_name"]=$plan[1];
      if($GLOBALS["hosting"][2]!="") {
        $GLOBALS["data"]["hosting_dur"]=$hdur=$GLOBALS["hosting"][2];
      } elseif(isset($_POST["period"])) {
        $GLOBALS["data"]["hosting_dur"]=$hdur=addslashes(htmlspecialchars($_POST["period"]));
      } else {
        if($period!="") {
          $GLOBALS["data"]["hosting_dur"]=$hdur=$period;
        } else {
          $GLOBALS["data"]["hosting_dur"]=$hdur=$this->default_dur();
        }
      }
      $GLOBALS["data"]["hosting_id"]=$plan[0];
      $GLOBALS["data"]["hosting_price1"]=$hprice1=$plan[2];
      $GLOBALS["data"]["hosting_price2"]=$hprice2=$plan[3];
      $GLOBALS["data"]["hosting_p1"]=$host_p=$hprice1*$hdur;
      $host_v=$GLOBALS["money"]->money($host_p);
      $GLOBALS["data"]["host_price_final"]=$host_v[0].$host_v[2].$host_v[1];
    } else {
      $GLOBALS["data"]["hosting_name"]="";
      $GLOBALS["data"]["hosting_dur"]=$hdur=0;
      $GLOBALS["data"]["hosting_id"]="";
      $GLOBALS["data"]["hosting_price1"]=$hprice1=0;
      $GLOBALS["data"]["hosting_price2"]=$hprice2=0;
      $GLOBALS["data"]["hosting_p1"]=0;
      $GLOBALS["data"]["host_price_final"]=0;
    }
    
    $dom_name=$domain[1];
    if($dom_name!="") {
      $GLOBALS["data"]["dom_name"]=$domain[1];
      $GLOBALS["data"]["dom_ext"]=$domain[2];
      $GLOBALS["data"]["dom_dom"]=$domain[1].".".$domain[2];
      if($domain[3]!="") {
        $GLOBALS["data"]["dom_dur"]=$ddur=$domain[3];
      } else {
        $GLOBALS["data"]["dom_dur"]=$ddur=$this->domain_dur($domain[2]);
      }
      $GLOBALS["data"]["dom_price_v"]=$GLOBALS["data"]["dom_price"]=$dprice=$this->domain_price($domain[2]);
      $GLOBALS["data"]["dom_p"]=$dom_p=$dprice*($ddur/12);
      $dom_v=$GLOBALS["money"]->money($dom_p);
      $GLOBALS["data"]["dom_price_final_v"]=$GLOBALS["data"]["dom_price_final"]=$dom_v[0].$dom_v[2].$dom_v[1];
    } else {
      $GLOBALS["data"]["dom_name"]="";
      $GLOBALS["data"]["dom_ext"]="";
      $GLOBALS["data"]["dom_dom"]="";
      $GLOBALS["data"]["dom_dur"]=$ddur=0;
      $GLOBALS["data"]["dom_price"]=$dprice=0;
      $GLOBALS["data"]["dom_price_v"]="0 ".sett::curr;
      $GLOBALS["data"]["dom_p"]="";
      $GLOBALS["data"]["dom_price_final"]=0;
      $dom_p_temp=$GLOBALS["money"]->money(0);
      $GLOBALS["data"]["dom_price_final_v"]=$dom_p_temp[0].$dom_p_temp[2].$dom_p_temp[1];
    }
    
    $GLOBALS["data"]["invoiceid"]=addslashes(htmlspecialchars($_POST["paysendtype"]));
    
    $GLOBALS["data"]["final_amount"]=$final_amount=$this->count($hprice1,$hprice2,$hdur,$dprice,$ddur,$inv_price,$payment_val);
    $GLOBALS["data"]["final_amount_exc"]=number_format(($final_amount*((100-sett::vat)/100)),sett::money_round,sett::money_dot,sett::money_thousand);
    $GLOBALS["data"]["final_amount_with"]=number_format((ceil(($final_amount*100))/100),sett::money_round,sett::money_dot,sett::money_thousand);
  }

 public function post_order() {
  $GLOBALS["error"] = false;
      $result=$this->check_captcha(htmlspecialchars($_POST["c"]));
      if($result===true) {
        $this->process();
      } else {
        $GLOBALS["error"] = "<div class=\"error\">".$GLOBALS["lang"]->tr("The result of an exam is bad!")."<br /><b>".$GLOBALS["lang"]->tr("Help:")."</b> ".$GLOBALS["lang"]->tr("result is")." ".$GLOBALS["lang"]->tr($result)."</div>";
      }
 }

 public function generate_captcha() {
  $GLOBALS["n1"]=$number1=rand(0,9);
  $GLOBALS["n2"]=$number2=rand(0,9);
  $_SESSION["ca"]=Array($number1,$number2);
 }

 public function show_captcha() {
  $numbers=$_SESSION["ca"];
  $GLOBALS["n1"]=htmlspecialchars($numbers[0]);
  $GLOBALS["n2"]=htmlspecialchars($numbers[1]);
 }

 public function check_captcha($input) {
  $numbers=$_SESSION["ca"];
  $n1=htmlspecialchars($numbers[0]);
  $n2=htmlspecialchars($numbers[1]);
  $result=$n1+$n2;
  if($input==$result) {
    unset($_SESSION["ca"]);
    return true;
  } else {
    return $result;
  }
 }

 public function get_plan() {
  $ordered_plan=htmlspecialchars(addslashes($_SESSION["cart"]["hosting"][0]));
  $result = mysql_query("SELECT id,name,price,setup_fee FROM  `hosting_plans` WHERE  `id` =".$ordered_plan." LIMIT 0,1",$GLOBALS["DB1"]);
  $row = mysql_fetch_row($result);
  if($row[1]!="") { return $row; } else { return false; }
 }

 public function default_dur() {
    $dur=$GLOBALS["config"]->select("payment_period");
    $defdur=false;
    foreach($dur as $item=>$data) {
      if($data[2]=="select") {
        $defdur=$data[0];
        break;
      }
    }
    return $defdur;
  }
 
 public function domain_price($ext) {
    $domains=$GLOBALS["config"]->select("domain");
    $price=false;
    foreach($domains as $item=>$data) {
      if($data[0]==$ext) {
        $price=$data[1];
        break;
      }
    }
    return $price;
  }

 public function domain_dur($ext) {
    $domains=$GLOBALS["config"]->select("domain");
    $dur=false;
    foreach($domains as $item=>$data) {
      if($data[0]==$ext) {
        $dur=$data[2];
        break;
      }
    }
    return $dur;
  }

 public function get_inv($id) {
  $invoice_type=$GLOBALS["config"]->select("invoice");
  $GLOBALS["invoice"]["price"]=$invoice_type[$id][2];
  $GLOBALS["invoice"]["name"]=$invoice_type[$id][0];
  return $GLOBALS["invoice"]["price"];
 }

 public function generate_payment() {
  $return="";
  $payment_period=$GLOBALS["config"]->select("payment_period");
  $period=htmlspecialchars($_POST["period"]);
  $periodsel=false;
  foreach($payment_period as $item => $data) {
    $selected="";
    if(($period!="") && $period==$data[0]) { $selected=" selected=\"selected\""; $periodsel=true; }
    elseif($periodsel===false && $data[2]=="select") { $selected=" selected=\"selected\""; }
    $return = $return."<option value=\"".$data[0]."\"".$selected.">".$GLOBALS["lang"]->tr($data[1])."</option>";
  }
  return $return;
 }

 public function generate_options_invoicement() {
  $return="";
  $invoice_type=$GLOBALS["config"]->select("invoice");
  $inv=htmlspecialchars($_POST["paysendtype"]);
  $invsel=false;
  foreach($invoice_type as $id => $data) {
    $selected="";
    if(($inv!="") && $inv==$id) { $selected=" selected=\"selected\""; $invsel=true; $GLOBALS["data"]["inv"]=htmlspecialchars($id); }
    elseif($invsel===false && $data[3]=="select") { $selected=" selected=\"selected\""; $GLOBALS["data"]["inv"]=htmlspecialchars($id); }
    $price=$GLOBALS["money"]->money($data[2]);
    $return = $return."<option value=\"".$id."\"".$selected.">".$GLOBALS["lang"]->tr($data[0])." +".$price[0].$price[2].$price[1]."</option>";
  }
  return $return;
 }

 public function count($hprice1,$hprice2,$hdur,$dprice,$ddur,$inv_price,$payment_val) {
  $amount=($hprice1*$hdur)+$hprice2+($dprice*($ddur/12))+($inv_price*$hdur);
  $amount=(ceil($amount*100))/100;
  $amount_format=$GLOBALS["money"]->money($amount);
  $GLOBALS["data"]["suprice"]=$amount_format[0].$amount_format[2].$amount_format[1];
  return $amount;
 }

 public function generate_id() {
  $query="SELECT id,value,name,enabled FROM `".db_base::DBName."`.`".db_base::DBPrefix."settings` WHERE `name` = 'identifier' AND `enabled` = '1' ORDER BY `id` DESC LIMIT 0,1";
  if($row=mysql_query($query,$GLOBALS["DB0"])) {
    $arr=mysql_fetch_row($row);
  } else { $arr=Array(); }

  if($arr[1]!="" && $arr[1]==date("y")) {
    $query1="UPDATE `".db_base::DBName."`.`".db_base::DBPrefix."settings` SET `id` = `id`+1 WHERE `name` = 'identifier';";
  } elseif($arr[1]!="") {
    $query1="UPDATE `".db_base::DBName."`.`".db_base::DBPrefix."settings` SET `value` = '".date("y")."' , `id` = '1' WHERE `name` = 'identifier';";
  } else {
    $query1="";
  }
  
  if(mysql_query($query1,$GLOBALS["DB0"])) {
    $query2="SELECT id,value,name,enabled FROM `".db_base::DBName."`.`".db_base::DBPrefix."settings` WHERE `name` = 'identifier' AND `enabled` = '1' ORDER BY `id` DESC LIMIT 0,1";
    $row1=mysql_query($query2,$GLOBALS["DB0"]);
    $arr1=mysql_fetch_row($row1);
    $id=$arr1[0];
  } else {
    $id="000000";
  }
  
  $idval=date("y").sett::variable_service.str_pad($id,6,"0",STR_PAD_LEFT);
  return $idval;
 }
 
 public function generate_secret($length=8,$use_upper=1,$use_lower=1,$use_number=1,$use_custom="") {
	$upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$lower = "abcdefghijklmnopqrstuvwxyz";
	$number = "0123456789";
	if($use_upper) {
		$seed_length += 26;
		$seed .= $upper;
	}
	if($use_lower) {
		$seed_length += 26;
		$seed .= $lower;
	}
	if($use_number) {
		$seed_length += 10;
		$seed .= $number;
	}
	if($use_custom) {
		$seed_length +=strlen($use_custom);
		$seed .= $use_custom;
	}
	for($x=1;$x<=$length;$x++) {
		$password .= $seed{rand(0,$seed_length-1)};
	}
	return($password);
}

 public function process() {
  $isgen=$ispcpid=$mail=false;

  $isgen=$this->ifisnt_domain();
  if($isgen===true) {
  
  $this->insertdata();

  } else {
    Header("Location:index.php?m=info&ok=0&err=exist"); die;
  }
 }

 public function get_admin_mail() {
  $query="SELECT admin_id,email FROM `".db_isp::DBName."`.`admin` WHERE `admin_id` = ".sett::reseller." LIMIT 0,1";
  if($row=mysql_query($query,$GLOBALS["DB1"])) {
    $arr=mysql_fetch_row($row);
    return $arr[1];
  } else {
    return sett::adminmail;
  }
 }

 public function ifisnt_domain() {
  if($GLOBALS["dom_dom"]!="") {
  $query="SELECT id,domain_name,status FROM `".db_isp::DBName."`.`orders` WHERE `domain_name` = '".addslashes(htmlspecialchars($GLOBALS["dom_dom"]))."' LIMIT 0,1";
  if(mysql_query($query,$GLOBALS["DB1"])) {
    if(mysql_affected_rows($GLOBALS["DB1"])==0) {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
  } else {
    return true;
  }
 }

public function insertdata() {
  //start add to database engine
  require(sett::classes."addto_webinvoice.php");
  $add_to_db=new add_to_db;
  //add to ispcp
  $ispcpid=$add_to_db->ispcp($GLOBALS["data"],$GLOBALS["DB1"]);
  
  if($ispcpid!==false) {
    //variable
    $idval=$this->generate_id();
    //secret
    $key=$this->generate_secret();
    
    //add to local db
    $addtodb=$add_to_db->web_invoice($ispcpid,$idval,$key,$GLOBALS["data"],$GLOBALS["DB0"]);
    
    if($addtodb) {
      //get admin mail
      $email=$this->get_admin_mail();
      //start the send mail engine
      require(sett::classes."send_mail.php");
      $send_mail=new send_mail;
      //send mail to buyer
      $mail0=$send_mail->buyer($ispcpid,$idval,$email,$key,$GLOBALS["l"],$GLOBALS["data"],$GLOBALS["server"]);
      //send mail to reseller
      $mail1=$send_mail->reseller($ispcpid,$idval,$email,$GLOBALS["data"],$GLOBALS["server"]);
      //check and redirect
      if($mail0===true && $mail1===true) {
        unset($_SESSION["cart"]);
        unset($GLOBALS["data"]);
        unset($_SESSION["ca"]);
        Header("Location:index.php?m=info&ok=1&msg=success"); die;
      } else {
        Header("Location:index.php?m=info&ok=0&msg=mail"); die;
      }
    } else {
      Header("Location:index.php?m=info&ok=0&msg=db"); die;
    }
  } else {
    Header("Location:index.php?m=info&ok=0&msg=isp"); die;
  }
}


 } 
$summary=new summary();
?>