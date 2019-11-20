<?php
class curr_convert
{

private function googlemoney($amount,$currency,$exchangeIn)
{
$response=false;
$url="http://www.google.com/ig/calculator?hl=en&q=1".urlencode($currency."=?".$exchangeIn);
$json=file_get_contents($url);
if(!$json) { return false; }
$json=str_replace(Array('lhs','rhs','error','icc'),Array('"lhs"','"rhs"','"error"','"icc"'),$json);
$array=json_decode($json,true);
if(!$array) { return false; }
if($array['error']) { return false; }
$data = strstr($array['rhs']," ",true);
$response = $data*$amount;
return $response;
}

private function eubankmoney($amount,$currency="EUR",$exchangeIn) {

if($currency!="EUR") { return false; }
if(!$XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml")) { return false; }

$return=false;

foreach($XML->Cube->Cube->Cube as $rate)  {
    if($exchangeIn==$rate["currency"]) {
      $number=explode(".",$rate["rate"]);
      $num=(int)$number[0];
      $dec=$number[1];
      if($dec>0) {
        $lengthofdec=strlen($dec);
        $a="1";
        for($i=0;$i<$lengthofdec;$i++) {
          $a=$a."0";
        }
        $a=(int)$a;
        $deci=(int)$dec;
        $decim=$deci/$a;
        $num=$num+$decim;
        
        $return=$num*$amount;
      }
      break;
    }
  }
return $return;
}

public function convert($used,$a,$type,$to,$curr_sign,$delimiter=" ",$rate=1,$extra=0,$round=2)
{
$return_value = false;

if(sett::money_conversion===true && $type=="online" && $used===true)
{

  if(sett::money_convertor=="google") {
    $response = $this->googlemoney($a,sett::money_currency_name,$to);
  } elseif(sett::money_convertor=="eubank") {
    $response = $this->eubankmoney($a,sett::money_currency_name,$to);
  } else {
    $response===false;
  }
    
  if($response!==false) {
    $return_value = Array(number_format($response,$round,sett::money_dot,sett::money_thousand),$curr_sign,$delimiter);
  } else {
    $return_value = Array(number_format($a,$round,sett::money_dot,sett::money_thousand),sett::money_currency_sign,sett::money_delimiter);
  }
} elseif(sett::money_conversion===true && $type=="offline" && $used===true) {
  $amount_final=number_format((($a+$extra)*$rate),$round,sett::money_dot,sett::money_thousand);
  if($amount_final) { $return_value = Array($amount_final,$curr_sign,$delimiter); }
  else { $return_value = Array(number_format($a,$round,sett::money_dot,sett::money_thousand),sett::money_currency_sign,sett::money_delimiter); }
} else {
  $return_value = Array(number_format($a,$round,sett::money_dot,sett::money_thousand),sett::money_currency_sign,sett::money_delimiter);
}

return $return_value;
}

public function detect($curr)
{
    $op_lang="";
    $curr = strtolower(substr((htmlspecialchars($curr)),0,5));
    if($curr!="") {
      $op_lang = $curr;
      $_SESSION["curr"]=$op_lang;
    } else {
      if($_SESSION["curr"]!="") {
        $op_lang=htmlspecialchars($_SESSION["curr"]);
      } else {
        $op_lang = strtolower(substr((htmlspecialchars($_SERVER['HTTP_ACCEPT_LANGUAGE'])),0,5));
        $_SESSION["curr"]=$op_lang;
      }
    }
    return $op_lang;
}

public function money($a)
{
if(sett::vat!="" && sett::vat>0 && sett::countvat===false) {
  $a=((100-sett::vat)/100)*$a;
}
$conversion=sett::money_conversion;
$curr_deafault_delimiter=sett::money_delimiter;
$curr_deafault_currency=sett::money_currency_sign;
$op_lang=htmlspecialchars($_SESSION["curr"]);

$return=Array();

// DETECTING
if ($op_lang == 'cs-cz') 
{
if($conversion===true) {
$return=$this->convert(true,$a,"online","CZK","Kč"," ",25.04,0,-1);
} else { $return=Array(number_format($a,sett::money_round,sett::money_dot,sett::money_thousand),$curr_deafault_currency,$curr_deafault_delimiter); }
}
elseif ($op_lang == 'en-gb') 
{
if($conversion===true) {
$return=$this->convert(true,$a,"online","GBP","£"," ",0.86,0,2);
} else { $return=Array(number_format($a,sett::money_round,sett::money_dot,sett::money_thousand),$curr_deafault_currency,$curr_deafault_delimiter); }
}
elseif ($op_lang == 'hu-hu') 
{
if($conversion===true) {
$return=$this->convert(true,$a,"online","HUF","Ft"," ",278.26,0,-2);
} else { $return=Array(number_format($a,sett::money_round,sett::money_dot,sett::money_thousand),$curr_deafault_currency,$curr_deafault_delimiter); }
}
elseif ($op_lang == 'pl-pl') 
{
if($conversion===true) {
$return=$this->convert(true,$a,"online","PLN","Zł"," ",3.97,0,0);
} else { $return=Array(number_format($a,sett::money_round,sett::money_dot,sett::money_thousand),$curr_deafault_currency,$curr_deafault_delimiter); }
}
elseif ($op_lang == 'ro-ro') 
{
if($conversion===true) {
$return=$this->convert(true,$a,"online","RON","leu"," ",4.25,0,2);
} else { $return=Array(number_format($a,sett::money_round,sett::money_dot,sett::money_thousand),$curr_deafault_currency,$curr_deafault_delimiter); }
}
elseif ($op_lang == 'ru-ru') 
{
if($conversion===true) {
$return=$this->convert(true,$a,"online","RUB","руб"," ",40.85,0,0);
} else { $return=Array(number_format($a,sett::money_round,sett::money_dot,sett::money_thousand),$curr_deafault_currency,$curr_deafault_delimiter); }
}
elseif ($op_lang == 'sk-sk') 
{
if($conversion===true) {
$return=$this->convert(true,$a,"offline","EUR","€"," ",1,0,2);
} else { $return=Array(number_format($a,sett::money_round,sett::money_dot,sett::money_thousand),$curr_deafault_currency,$curr_deafault_delimiter); }
}
elseif ($op_lang == 'uk-ua') 
{
if($conversion===true) {
$return=$this->convert(true,$a,"offline","UAH","гривні"," ",10.65,0,2);
} else { $return=Array(number_format($a,sett::money_round,sett::money_dot,sett::money_thousand),$curr_deafault_currency,$curr_deafault_delimiter); }
}
elseif ($op_lang == 'en-us') 
{
if($conversion===true) {
$return=$this->convert(true,$a,"online","USD","$"," ",1.34,0,2);
} else { $return=Array(number_format($a,sett::money_round,sett::money_dot,sett::money_thousand),$curr_deafault_currency,$curr_deafault_delimiter); }
}
else //INTERNATIONAL (EU) 
{
if($conversion===true) {
$return=$this->convert(true,$a,"offline","EUR","€"," ",1,0,2);
} else { $return=Array(number_format($a,sett::money_round,sett::money_dot,sett::money_thousand),$curr_deafault_currency,$curr_deafault_delimiter); }
}

return $return;

}

}
?>