<?
session_start();
include("../Connections/bdd.php");
include("../class/clsForm.php");
$form=new form;
	if($_SESSION['statusLogin']=="OK"){
		echo $form->frmMenuAdmin();
	}else{
		echo $form->frmLogin();	
	}

?>