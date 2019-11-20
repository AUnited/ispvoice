<?php
class domwhois
 {

public function detect($target,$server,$findText)
  {
$con = @fsockopen($server, 43); 
if (!$con) return false; 
@fputs($con, $target."\r\n"); 
$response = ' :'; 
while(!feof($con)) { 
$response .= @fgets($con,128); 
} 
@fclose($con); 
if (strpos($response, $findText)){ 
return true; 
} 
else { 
return false; 
} 
  }

public function get_stat($page,$exten)
  {
  
  $page=htmlspecialchars($page);
  $exten=htmlspecialchars($exten);
  $target=$page.".".$exten;
  $response=Array();
  
  if($page=="") {
    $response["status"]="error";
    $response["error"]["errorcode"]["major"]=501;
    $response["error"]["errorcode"]["minor"]=1001;
    $response["error"]["errormsg"]="Your page name is blank";
    return $response;
  } elseif($exten=="") {
    $response["status"]="error";
    $response["error"]["errorcode"]["major"]=501;
    $response["error"]["errorcode"]["minor"]=1002;
    $response["error"]["errormsg"]="Your extension name is blank";
    return $response;
  } elseif(strlen($page)<2) {
    $response["status"]="error";
    $response["error"]["errorcode"]["major"]=501;
    $response["error"]["errorcode"]["minor"]=1003;
    $response["error"]["errormsg"]="Your page name is lower than 2 chars";
    return $response;
  } elseif(!$server=$this->get_server($exten)) {
    $response["status"]="error";
    $response["error"]["errorcode"]["major"]=500;
    $response["error"]["errorcode"]["minor"]=1010;
    $response["error"]["errormsg"]="The whois server is missing";
    return $response;
  } elseif($this->detect($target,$server[0],$server[1])===true) {
    $response["status"]="ok";
    $response["data"]["avail"]=1;
    return $response;
  } elseif($this->detect($target,$server[0],$server[1])===false) {
    $response["status"]="ok";
    $response["data"]["avail"]=0;
    return $response;
  } else {
    $response["status"]="error";
    $response["error"]["errorcode"]["major"]=500;
    $response["error"]["errorcode"]["minor"]=1000;
    $response["error"]["errormsg"]="Unknown error";
    return $response;
  }
  
  }

public function get_server($exten)
  {
    $domain_ext = array(
      "com" => array("whois.crsnic.net","No match for"),
      "net" => array("whois.crsnic.net","No match for"),
      "biz" => array("whois.biz","Not found"),
      "mobi" => array("whois.dotmobiregistry.net","NOT FOUND"),
      "tv" => array("whois.nic.tv","No match for"),
      "in" => array("whois.inregistry.net","NOT FOUND"),
      "info" => array("whois.afilias.net","NOT FOUND"),
      "co.uk" => array("whois.nic.uk","No match"),
      "co.ug" => array("wawa.eahd.or.ug","No entries found"),
      "or.ug" => array("wawa.eahd.or.ug","No entries found"),
      "nl" => array("whois.domain-registry.nl","is free"),
      "ro" => array("whois.rotld.ro","No entries found for the selected"),
      "com.au" => array("whois.ausregistry.net.au","No Data Found"),
      "ca" => array("whois.cira.ca","AVAIL"),
      "org.uk" => array("whois.nic.uk","No match"),
      "name" => array("whois.nic.name","No match"),
      "us" => array("whois.nic.us","Not found"),
      "ac.ug" => array("wawa.eahd.or.ug","No entries found"),
      "ne.ug" => array("wawa.eahd.or.ug","No entries found"),
      "sc.ug" => array("wawa.eahd.or.ug","No entries found"),
      "ws" => array("whois.website.ws","No Match"),
      "be" => array("whois.ripe.net","FREE"),
      "com.cn" => array("whois.cnnic.cn","no matching record"),
      "net.cn" => array("whois.cnnic.cn","no matching record"),
      "org.cn" => array("whois.cnnic.cn","no matching record"),
      "no" => array("whois.norid.no","no matches"),
      "se" => array("whois.nic-se.se","not found"),
      "nu" => array("whois.nic.nu","NO MATCH for"),
      "com.tw" => array("whois.twnic.net","No Found"),
      "net.tw" => array("whois.twnic.net","No Found"),
      "org.tw" => array("whois.twnic.net","No Found"),
      "cc" => array("whois.nic.cc","No match"),
      "nl" => array("whois.domain-registry.nl","is free"),
      "pl" => array("whois.dns.pl","No information about"),
      "pt" => array("whois.dns.pt","no match"),
      "org" => array("whois.pir.org","NOT FOUND"),
      "eu" => array("whois.eu","AVAILABLE"),
      "cz" => array("whois.nic.cz","No data found"),
      "ru" => array("whois.ripn.net","No entries found"),
      "xn--p1ai" => array("whois.ripn.net","No entries found")
    );
    
    if(isset($domain_ext[$exten])) { $server=$domain_ext[$exten]; } else { $server=false; }
    
    return $server;
  }

 }
?>