<?php
class plans
 {
 public $plan;
 
 public function __construct() {
  $this->get_plan();
  if($_SERVER['REQUEST_METHOD'] == "POST") { $this->add_to_cart(); }
  if(isset($_GET["plan"])) { $this->del_plan(); }
 }
 
 public function get_plan() {
  $result = mysql_query("SELECT id,name,price,setup_fee,status FROM  `".db_isp::DBName."`.`hosting_plans` WHERE  `reseller_id` =".sett::reseller,$GLOBALS["DB1"]);
  $GLOBALS["plan"]=$result;
 }

 public function add_to_cart() {
  $id=htmlspecialchars($_POST["id"]);
  $name=htmlspecialchars($_POST["name"]);
  $qty=htmlspecialchars($_POST["qty"]);
  if($id!="" && $name!="") {
    $_SESSION["cart"]["hosting"]=Array($id,$name,$qty);
    if($_GET["edit"]!="") { Header("Location: index.php?m=summary"); die; } else {
    $currentnumber=array_search($GLOBALS["m"],$GLOBALS["pageflow"]);
    $gotomodule=$GLOBALS["pageflow"][($currentnumber+1)];
    Header("Location: index.php?m=".$gotomodule); die; }
  }
 }

 public function del_plan() {
  unset($_SESSION["cart"]["hosting"]);
  if($_GET["edit"]!="") { Header("Location: index.php?m=summary"); die; } else {
  $currentnumber=array_search($GLOBALS["m"],$GLOBALS["pageflow"]);
  $gotomodule=$GLOBALS["pageflow"][($currentnumber+1)];
  Header("Location: index.php?m=".$gotomodule); die; }
 }
 
 }
$plans=new plans;
?>