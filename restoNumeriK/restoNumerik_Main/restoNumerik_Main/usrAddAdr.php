<?
if ($_POST['varSecure']!=26){exit;}
include("Connections/bdd.php");
include("class/clsUsr.php");
$usr=new usr;
if($_POST['actionType']=="add"){
	$usr->addAddress($_POST['idUser'],$_POST['title'] ,$_POST['address'], $_POST['zipCode'], $_POST['tel'], $_POST['building'], $_POST['floor'], $_POST['interphone'],$_POST['door'], $_POST['digicode'], $_POST['$comment']);
}


if($_POST['actionType']=="upd"){
	$usr->updAddress($_POST['idUser'],$_POST['title'] ,$_POST['address'], $_POST['zipCode'], $_POST['tel'], $_POST['building'], $_POST['floor'], $_POST['interphone'],$_POST['door'], $_POST['digicode'], $_POST['$comment']);

}
?>
