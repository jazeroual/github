<?
class usr{

function generationUserInfos($idShop,$varLogin,$varPassword){
	$this->checkUserLoginPassword($idShop,$varLogin,$varPassword);
}

private function checkUserLoginPassword($idShop,$varLogin,$varPassword){
	$query = mysql_query("SELECT *  FROM  tblUser  WHERE login='". addslashes($varLogin)  ."' and password ='". addslashes($varPassword)  ."'") or die(mysql_error());
 
	  if( mysql_num_rows($query)==0){
		   echo '{"user":[{"idUser":-1,"firstName":"","lastName":"","statusLogin":"NOTFOUND"}]}';
	  }else{
  
		  $row=mysql_fetch_assoc($query);
		  $idUser=$row['idUser'];
		  if($row['blackListed']=="1"){
			   echo '{"user":[{"idUser":-1,"firstName":"","lastName":"","statusLogin":"BLACKLISTED"}]}';
		  }else{
	 		    echo "{";
				$this->getUserInfos($idUser);
				echo ",";
				$this->getUserAddressesInfos($idUser,$idShop);
				echo ",";
				$this->getShopZipCodes($idShop);
				echo ",";
				$this->getAddressesShop($idShop);
				echo "}"; 
		  }
  }
}

private function getUserInfos($idUser){

  $query = mysql_query("SELECT *  FROM  tblUser  WHERE idUser= ".$idUser) or die(mysql_error());
  $row=mysql_fetch_assoc($query);
  echo '"user":[{"idUser":'. $row['idUser'].',"firstName":"'. addslashes($row['firstName']).'","lastName":"'.  addslashes($row['lastName']) .'","statusLogin":"YES","token":"'. addslashes($row['token']) .'"}]';
  
}

private function getUserAddressesInfos($idUser,$idShop){
  $query = mysql_query("SELECT *  FROM  tblUserAddresses inner join tblShopZipCode on tblUserAddresses.zipCode=tblShopZipCode.shopZipCode  WHERE idShopExt=".  $idShop ." and idUserExt= ".$idUser) or die(mysql_error());
  
  $nbRows = mysql_num_rows($query);
  
  $cpt=1;
  echo '"addresses":[';
  
  while($row=mysql_fetch_assoc($query)){
	echo utf8_encode( '{ "idAddress" : '. $row['idAddress'] .',"title": "'. addslashes($row['title']) .'","address": "'. addslashes($row['address']) .'","zipCode": "'. addslashes($row['zipCode']) .'","tel": "'. addslashes($row['tel']) .'","building": "'. addslashes($row['building']) .'","floor": "'. addslashes($row['floor']) .'","interphone": "'. addslashes($row['interphone']) .'","door": "'. addslashes($row['door']) .'","digicode": "'. addslashes($row['digicode']) .'","deliveryCharge": "'. addslashes($row['chargesDelivery']) .'","comment": "'. addslashes($row['comment']) .'"}');

  if($cpt < $nbRows){ echo ",";};
 $cpt++;
 
  }
  
  echo ']';
}


private function getShopZipCodes($idShop){
  $query = mysql_query("SELECT *  FROM  tblShopZipCode  WHERE idShopExt=".  $idShop) or die(mysql_error());
  
  $nbRows = mysql_num_rows($query);
  $cpt=1;
  echo '"shopZipCodes":[';
  
  while($row=mysql_fetch_assoc($query)){
	  
  	echo utf8_encode( '{"idShopZipCode" : '. $row['idShopZipCode'] .',"libelle": "'. addslashes($row['shopZipCode']) .'","chargesDelivery": "'. addslashes($row['chargesDelivery']) .'"}');

  if($cpt < $nbRows){ echo ",";};
 $cpt++;
 
  }
  
  echo ']';
}

private function getAddressesShop($idShop){
  $query = mysql_query("SELECT *  FROM  tblShopAddresses  WHERE idShopExt=".  $idShop) or die(mysql_error());
  
  $nbRows = mysql_num_rows($query);
  $cpt=1;
  echo '"addressesShop":[';
  
  while($row=mysql_fetch_assoc($query)){
	  
	  
	  
	  
  		echo utf8_encode( '{ "idAddressShop" : '. $row['idAddressShop'] .',"libelle": "'. addslashes($row['shopName']) .'","address": "'. addslashes($row['address']) .'","zipCode": "'. addslashes($row['zipCode'] .' '. $row['town'] ) .'","tel": "'. addslashes($row['tel']) .'","lattitude": "'. addslashes($row['lattitude']) .'","longitude": "'. addslashes($row['longitude']) .'"}');

  if($cpt < $nbRows){ echo ",";};
 $cpt++;
 
  }
  
  echo ']';
}

// GESTION DE L'AJOUT D'ADRESSE

function addAddress($idUser,$title ,$address, $zipCode, $tel, $building, $floor, $interphone,$door, $digicode, $comment){

$varCheckValue="";
if(trim($title)==""){ $varCheckValue.=" libellé,";};
if(trim($address)==""){ $varCheckValue.=" adresse,";};
if(trim($zipCode)==""){ $varCheckValue.=" code postal,";};
if(trim($tel)==""){ $varCheckValue.=" téléphone,";};
if($varCheckValue!=""){
	
	echo '{"feedBack":[{"returnCode":"0000","returnDescription":"Merci de remplir le(s) champ(s) suivant(s) : '.$varCheckValue.'"}]}';

}else{
	$query = mysql_query("SELECT *  FROM  tblUserAddresses  WHERE title='".$title."' and idUserExt=".$idUser) or die(mysql_error());
  
	if( mysql_num_rows($query)>0){
		echo '{"feedBack":[{"returnCode":"0001","returnDescription":"Le libellé de l\'adresse est déjà utilisé"}]}';
	}else{
		$query = mysql_query("INSERT INTO tblUserAddresses ( title, address, zipCode, tel, building, floor, interphone, door, digicode, comment, idUserExt) VALUES ( '".$title."', '".$address."', '".$zipCode."', '".$tel."', '".$building."', '".$floor."', '".$interphone."', '".$door."', '".$digicode."', '".$comment."', ". $idUser .")") or die(mysql_error());
	
		echo '{"feedBack":[{"returnCode":"0002","returnDescription":"Ajout effectué avec succés","adrId":"'. mysql_insert_id() .'"}]}';
		
	}
}
	
}

function updAddress($idUser,$title ,$address, $zipCode, $tel, $building, $floor, $interphone,$door, $digicode, $comment){

$varCheckValue="";
if(trim($title)==""){ $varCheckValue.=" libellé,";};
if(trim($address)==""){ $varCheckValue.=" adresse,";};
if(trim($zipCode)==""){ $varCheckValue.=" code postal,";};
if(trim($tel)==""){ $varCheckValue.=" téléphone,";};
if($varCheckValue!=""){
	
	echo '{"feedBack":[{"returnCode":"0000","returnDescription":"Merci de remplir le(s) champ(s) suivant(s) : '.$varCheckValue.'"}]}';

}else{
	$query = mysql_query("SELECT *  FROM  tblUserAddresses  WHERE title='".$title."' and idUserExt=".$idUser) or die(mysql_error());
  
	if( mysql_num_rows($query)<1){
		echo '{"feedBack":[{"returnCode":"0001","returnDescription":"Adresse introuvable"}]}';
	}else{
		$query = mysql_query("update  tblUserAddresses set  address='".$address."', zipCode='".$zipCode."', tel='".$tel."', building='".$building."', floor='".$floor."', interphone='".$interphone."', door='".$door."', digicode='".$digicode."', comment='".$comment."' where title='".$title ."' and idUserExt=".$idUser) or die(mysql_error());
	
		echo '{"feedBack":[{"returnCode":"0002","returnDescription":"Mise à jour effectuée avec succés"}]}';
		
	}
}
	
}

function retreiveUserPassword($varSearchValue){
	$query = mysql_query("SELECT *  FROM  tblUser  WHERE login='". addslashes($varSearchValue)  ."' or email ='". addslashes($varSearchValue)  ."'") or die(mysql_error());
	
	  if( mysql_num_rows($query)==0){
		echo '{"feedBack":[{"returnCode":"0001","returnDescription":"Identifiant ou email inconnu."}]}';
		}else{
		$row=mysql_fetch_assoc($query);	
		mail($row['email'],utf8_encode("Mot de passe oublié"), "login : " .$row['login'] . "\nmdp : " . $row['password']);
		echo '{"feedBack":[{"returnCode":"0002","returnDescription":"Nous vous avons envoyé vos paramètres de connexion par email. Pensez à consulter votre dossier courrier spam/indésirable."}]}';	
		}
}


function addUser($login,$password ,$firstName, $lastName, $email){

$varCheckValue="";
if(trim($login)==""){ $varCheckValue.=" identifiant,";};
if(trim($password)==""){ $varCheckValue.=" mot de passe,";};
if(trim($firstName)==""){ $varCheckValue.=" nom,";};
if(trim($lastName)==""){ $varCheckValue.=" prénom,";};
if(trim($email)==""){ $varCheckValue.=" email,";};

if($varCheckValue!=""){
	echo '{"feedBack":[{"returnCode":"0000","returnDescription":"Merci de remplir le(s) champ(s) suivant(s) : '.$varCheckValue.'"}]}';

}else{
	$query = mysql_query("SELECT *  FROM  tblUser  WHERE login='".$login."'") or die(mysql_error());
  
	if( mysql_num_rows($query)>0){
		echo '{"feedBack":[{"returnCode":"0001","returnDescription":"L\'identifiant est déjà utilisé"}]}';
	}else{
		$query = mysql_query("SELECT *  FROM  tblUser  WHERE email='".$email."'") or die(mysql_error());
  
		if( mysql_num_rows($query)>0){
			echo '{"feedBack":[{"returnCode":"0001","returnDescription":"L\'email est déjà utilisé"}]}';
		}else{
		
		$token=uniqid();
		$query = mysql_query("INSERT INTO tblUser ( login, password, firstName, lastName, email, token) VALUES ( '".$login."', '".$password."', '".$firstName."', '".$lastName."', '".$email."', '".$token."')") or die(mysql_error());
	
		echo '{"feedBack":[{"returnCode":"0002","returnDescription":"Inscription validée."}]}';
		
	}
	}
}
	
}


}
?>