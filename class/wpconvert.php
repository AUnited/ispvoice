<?php
class wpconvert {
 function toarray($array) {
   $arlenght=count($array);
   $string="";
   $string="a:".$arlenght.":{";
   
   $ari=1;
   foreach($array as $item) {
    $cuarlenght=count($item);
    
    $string=$string."i:".$ari.";"."a:".$cuarlenght.":{";
      foreach($item as $value => $inn) {
        $vallenght=strlen($value);
        $innlenght=strlen($inn);
        
        $string=$string."s:".$vallenght.":\"".$value."\";"."s:".$innlenght.":\"".$inn."\";";
      }
    $string=$string."}";    
    $ari++;
   }
   $string=$string."}";
   return $string;  
 }    
 
}
?>