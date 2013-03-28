<?
class manager{
	function makeLogin ($varLogin,$varPassword){
		
		$query = mysql_query("SELECT *  FROM  tblAdmin  WHERE login='". addslashes($varLogin)  ."' and password ='". addslashes($varPassword)  ."'") or die();
 			
		$_SESSION['idLogin']=-1;
		$_SESSION['login']="";
		$_SESSION['statusLogin']="NOTOK";
		
	  	if( mysql_num_rows($query)==0){
			
			echo ('{"idUser":-1,"login":"","statusLogin":"NOTOK"}');
			$_SESSION['idLogin']=-1;
			$_SESSION['login']="";
			$_SESSION['statusLogin']="NOTOK";
	  	}else{
			$row=mysql_fetch_assoc($query);
   			echo ('{"idUser":'.  $row['idAdmin'] .',"login":"'.  $row['login'] .'","statusLogin":"OK"}');
			$_SESSION['idLogin']=$row['idAdmin'];
			$_SESSION['login']=$row['login'];
			$_SESSION['statusLogin']="OK";
	  	}
 	}
}

?>