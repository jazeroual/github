<?

class manager{

	function connect ($varLogin,$varPassword){
			global $bdd;

		  $SQL = "
            SELECT *
            FROM tblmanager 
            WHERE logIn = :login 
			AND password= :pwd
        ";
        $query= $bdd->prepare($SQL);
        $query->execute(array(':login' => $varLogin , ':pwd' => $varPassword));
		$nbrow = $query->rowCount();
		$row = $query->fetch();
		
		if ($nbrow == 1 && $varLogin != "" && $varPassword != "")	
			{
				// connexxion reussie
				
				$_SESSION['id']= $row['idManager'];
				$_SESSION['login']= $row['logIn'];
				$_SESSION['pwd']= $row['password'];

				echo json_encode('{"loginStatus":"OK" ,"login":"'.$_SESSION['login'].'", "idLogin":"'.$_SESSION['id'].'"}');
				//echo utf8_decode("vous êtes connécté sous".$_SESSION['login']);
			}
			else{
				//mauvaise saisie intru !!!!
				echo json_encode( '{"loginStatus":"PASOK" ,"login":"", "idLogin":-1}');
				//echo utf8_decode("mauvaise saisie intru !!!!");
			}  
	}

	public function disconnect ($varLogin,$varPassword){
		session_destroy();
	}

	
}

?>