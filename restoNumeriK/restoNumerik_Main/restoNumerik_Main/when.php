<?
include("Connections/bdd.php");
include("class/clsWhen.php");
//if ($_POST['varSecure']!=26){exit;}
$when=new when;

// en entrée : ishop, idZipCode
$when->generationWhenInfos("1","shop","1");//$_POST['idShop'] ^$_POST['typeOrder'] $_POST['idZipCode']);
?>