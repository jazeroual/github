<?
class shop{

function generateShopMenu($idShop){
	
echo '{"restaurant": [';
echo '{"categories": [';
$query = mysql_query("SELECT *  FROM  tblProductCategories  WHERE products<>'' and idShopExt=". addslashes($idShop) ." order by position" ) or die(mysql_error());
$nbRows = mysql_num_rows($query);
$cpt=1;
while($row=mysql_fetch_assoc($query)){	
echo  '{ "categName": "'. addslashes(utf8_encode($row['categName'])) .'","colorValue": "'. $row['colorValue'] .'","products": ['. $row['products'] .']}';

  if($cpt < $nbRows){ echo ",";};
 $cpt++;
 	  
}


echo '],';
echo '"products": [';
$query = mysql_query("SELECT *  FROM  tblProduct  WHERE idShopExt=". addslashes($idShop)  ) or die(mysql_error());
$nbRows = mysql_num_rows($query);
$cpt=1;
while($row=mysql_fetch_assoc($query)){	  
echo utf8_encode( '{"idProd": "'. addslashes($row['idProd']) .'","title": "'. (($row['title'])) .'","description": "'. (($row['description'])) .'","priceDelivery": "'. addslashes(number_format($row['priceDelivery'],2)) .'","priceShop": "'. addslashes(number_format($row['priceShop'],2)) .'","lunchOnly": "'. addslashes($row['lunchOnly']) .'","img": "'. $row['idProd'] .'","width": 160,"height": 110,"isFormula": "'. addslashes($row['isFormula']).'"');

if($row['isFormula']=='Y'){
	$this->generateFormulas($row['idProd']);
}

echo utf8_encode('}');


  if($cpt < $nbRows){ echo ",";};
 $cpt++;
 	  
}

echo ']';
echo ', "orderInfos": [{"minOrder": "15.00"}]';
echo '}';

echo ']}';

}

function generateFormulas($idProd){
echo ',"detailFormula": {"choices": [';
$query = mysql_query("SELECT *  FROM  tblProductFormula  WHERE idProdMain=". $idProd  ) or die(mysql_error());
$nbRows = mysql_num_rows($query);
$cpt=1;
while($row=mysql_fetch_assoc($query)){	  

echo '{"labelFormula": "'. addslashes(utf8_encode($row['labelFormula'])) .'","productsFormula": ['. addslashes($row['productsFormulaList']) .']}';

  if($cpt < $nbRows){ echo ",";};
 $cpt++;
 	  
}
echo ']}';	
	
}



}
?>