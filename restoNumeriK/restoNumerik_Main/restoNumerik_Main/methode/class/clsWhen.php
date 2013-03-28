<?
class when{
	
	private function nextHour($idAddressShopExt){
		$varHour= date("H");
		$varMin= date("i");
		
		// Penser à cherche le temps de préparation dans le shop comme paramètre
		$query = mysql_query("SELECT * FROM tblShopAddresses where idAddressShop=".$idAddressShopExt ) or die(mysql_error());
	  	$row=mysql_fetch_assoc($query);
		$varPreparationTime=$row['preparationTime'];
		$varMin=$varMin+$varPreparationTime;
		if ($varMin>=60){
			$varHour=$varHour+1;
			if($varMin==60){$varMin=0;}else{$varMin=$varMin-60;};	
		}

		if ($varMin>30){
			$varMin=00;
			$varHour=$varHour+1;
			if($varHour>23){
				echo "Attention Journée suivante";	
			}
			
		}else{
			$varMin=30;
			
		}
		return sprintf('%0' . 2 . 's', $varHour) .sprintf('%0' . 2 . 's', $varMin);
	}


	private function getHourAvailable($idShop,$idWeekDay,$idAddressShopExt,$lunchRequire){
	 //On cherche la tranche horaire la plus proche
	  $varHourStartSearch=$this->nextHour($idAddressShopExt);
	  
	  $query = mysql_query("SELECT * FROM tblShopHour inner join calendar on tblShopHour.idCalendarExt=calendar.idCalendar WHERE dayOpening=". $idWeekDay." and idShopExt=".  $idShop  ." and idAddressShopExt=". $idAddressShopExt."   and hourValue>=".$varHourStartSearch." order by hourValue asc") or die(mysql_error());
	  
	  $nbRows = mysql_num_rows($query);
	  if($nbRows<=0){
		  $this->shopHourNotAvailable();
		  return;
	  }
	  $cpt=1;
	  echo '"whenList":[';
	
	  while($row=mysql_fetch_assoc($query)){
		$day=date("D M Y");
		$varNotification="OK";
		$nbSlotsRemain=$row['nbSlotsMax']-$row['nbSlotsReserved'];
		if ($nbSlotsRemain<0){
			$nbSlotsRemain=0;
			$varNotification="Trop plein commande";
		};
		
		if($row['lunchOnly']!="Y" and $lunchRequire=="Y"){
				$nbSlotsRemain=0;
				$varNotification="Panier Midi";
		}
		echo utf8_encode( '{ "idWhen" : '. $row['idShopHour'] .',"title": "Entre '. addslashes($row['hourOpening']) .'","nbSlotsMax": '. addslashes($row['nbSlotsMax']) .',"nbSlotsRemain": '. addslashes($nbSlotsRemain) .',"isOpen": "'. addslashes($row['isOpen']) .'","notification":"'.   addslashes($varNotification) . '","day": "'. addslashes($day) .'"}');
	
	
		if($cpt < $nbRows){
			 echo ",";
		};
		$cpt++;
		 
	 }
		  
	 echo ']';
	}

	private function shopHourNotAvailable(){
	
	  echo '"whenList":[';
	  echo utf8_encode( '{ "idWhen" : -1,"title": "Plus de livraison disponible aujourd\'hui","nbSlotsMax": 1,"nbSlotsRemain": 0,"isOpen": "0","day": ""}');
	  
	  echo ']';
		
	}

	function generationWhenInfos($idShop,$typeOrder,$idLookUpAddress,$lunchRequire){
		$idWeekDay=date("N");
		if ($typeOrder=="shop"){
			//On cherche en fonction de l'adresse de la boutique où l'utilisateur va prendre sa commande à emporter
			$query = mysql_query("SELECT * FROM tblShopAddresses where idShopExt=". $idShop ." and idAddressShop=". $idLookUpAddress  ) or die(mysql_error());
			$row=mysql_fetch_assoc($query);
			
			if($row['isOpen']!="1"){
				echo "{";
				$this->shopHourNotAvailable();
				echo "}";
				return;
			}
			
			$OrderZipCode =$row['zipCode'] ;	
			
		}else{
			//On cherche en fonction de l'adresse de livraison de l'utilisateur
			$query = mysql_query("SELECT * FROM tblUserAddresses where idAddress=". $idLookUpAddress  ) or die(mysql_error());
			$row=mysql_fetch_assoc($query);
			$OrderZipCode=$row['zipCode'];
			if($OrderZipCode==""){
				echo "{";
				$this->shopHourNotAvailable();
				echo "}";
				return;
			}
		}
		// Si le idAddressShopExt = 0 cela signifie que les horaires sont identiques quelque soit la boutique.
		$query = mysql_query("SELECT * FROM tblShopZipCode where shopZipCode='". $OrderZipCode ."' and idShopExt=".$idShop ) or die(mysql_error());
		$row=mysql_fetch_assoc($query);
		if($row['isOpen']!="1"){
			echo "{";
			$this->shopHourNotAvailable();
			echo "}";
			return;
		}
		$idAddressShopExt=$row['idAddressShopExt'];
		
		echo "{";
		$this->getHourAvailable($idShop,$idWeekDay,$idAddressShopExt,$lunchRequire);
		echo "}";
		
	}

}
?>