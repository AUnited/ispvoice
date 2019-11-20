<?php
class db
 {
 protected $server;
 protected $uzivatel;
 protected $heslo;
 protected $databaza;
 protected $port;
 public $err;
 public $conn;

 public function __construct($server,$port,$uzivatel,$heslo,$databaza)
  {
   $this->server=$server;
   $this->uzivatel=$uzivatel;
   $this->heslo=$heslo;
   $this->databaza=$databaza;
   $this->port=$port;
  }
  
 public function start($db,$codeset)
  {
   if(!$conn=@mysql_connect($this->server.$this->port,$this->uzivatel,$this->heslo,true))
     {
       die("Cannot connect to the database!");
     }
   if(!mysql_select_db($db,$conn))
     {
       die("Cannot select the database!");
     }
   if((!mysql_query("SET character_set_results=".$codeset,$conn)) && (!mysql_query("SET character_set_connection=".$codeset,$conn)) && (!mysql_query("SET character_set_client=".$codeset,$conn)))
     { 
       die("Cannot select codeset!");
     }
   return $conn;
  }

 public function ending()
  {
   @mysql_close($this->conn);
  }
 }
?>