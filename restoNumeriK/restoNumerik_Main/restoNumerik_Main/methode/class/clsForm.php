<?

class form{

function frmLogin(){
	$varResult= '<input  name="txtLogin" type="text" id="txtLogin" maxlength="26" />';
	$varResult.= '<input name="txtPassword" type="password" id="txtPassword" maxlength="26" />';
	$varResult.= '<input id="btnLogin" name="btnLogin" type="button" value="Se connecter">';
	$varResult.= '<div id="loginError"></div>';	
	return $varResult;
}


function frmMenuAdmin(){
	$varResult="Bienvenue ". $_SESSION['login'].",";
	$varResult.="<a href='disconnect.php'>Se déconnecter</a>";
	return $varResult;
}

}
?>