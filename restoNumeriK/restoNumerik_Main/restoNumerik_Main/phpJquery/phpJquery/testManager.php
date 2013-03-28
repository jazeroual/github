<?

include("Connections/bdd.php");
include("class/clsMngr.php");

$user1=new manager;


$user1->connect($_POST['login'],$_POST['password']);


?>