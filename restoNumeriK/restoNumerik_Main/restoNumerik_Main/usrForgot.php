<?
if ($_POST['varSecure']!=26){exit;}
include("Connections/bdd.php");
include("class/clsUsr.php");
$usr=new usr;
$usr->retreiveUserPassword($_POST['txtForgotEmailOrId']);
?>
