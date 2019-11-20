<?php
class domainreg
 {
protected $user1;
protected $pass1;

public function whois($domain,$extension)
  {

$client = new SoapClient(
        null, 
        array(
            "location" => "https://soap.subreg.cz/cmd.php",
            "uri" => "http://subreg.cz/soap"
            )
        );

$params = array ( 
    "data" => array (
        "login" => sett::sub_username,
        "password" => sett::sub_password,
    )
);

$response = $client->__call("Login",$params);

$token = $response["data"]["ssid"];

unset($params);

$params = array (
    "data" => array (
            "ssid" => $token,
            "domain" => $domain.".".$extension,
    )
);

$response = $client->__call("Check_Domain",$params);

if($response["status"]=="ok") { return $response; }
elseif($response["status"]=="error") { return $response; }
else { return false; }
  }

 }
?>