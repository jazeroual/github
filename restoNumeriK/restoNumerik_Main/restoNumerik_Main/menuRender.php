<?

header('Content-Type: application/json');
if ($_POST['varSecure']!=26){exit;}
include("Connections/bdd.php");
include("class/clsShop.php");
$shop=new shop;
$shop->generateShopMenu(addslashes($_POST['idShop']));

?>
