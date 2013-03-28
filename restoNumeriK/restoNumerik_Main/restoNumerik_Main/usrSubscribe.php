<?
if ($_POST['varSecure']!=26){exit;}
include("Connections/bdd.php");
include("class/clsUsr.php");
$usr=new usr;
$usr->addUser(addslashes($_POST['txtIdentifiant']),addslashes($_POST['txtPassword']),addslashes($_POST['txtName']),addslashes($_POST['txtFamilyName']),addslashes($_POST['txtMail']));//;
?>
