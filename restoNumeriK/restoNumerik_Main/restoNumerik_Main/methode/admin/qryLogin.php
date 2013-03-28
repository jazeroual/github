<?
session_start();
include("../Connections/bdd.php");
include("../class/clsMngr.php");
$manager=new manager;
$manager->makeLogin($_POST['varLogin'],$_POST['varPassword']);
?>