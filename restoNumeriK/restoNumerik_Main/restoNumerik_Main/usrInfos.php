<?
if ($_POST['varSecure']!=26){exit;}
include("Connections/bdd.php");
include("class/clsUsr.php");
$usr=new usr;
$usr->generationUserInfos($_POST['idShop'],$_POST['login'],$_POST['password']);//;
?>
