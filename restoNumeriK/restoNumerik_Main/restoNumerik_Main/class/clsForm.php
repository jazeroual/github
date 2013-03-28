<?php


class Formulaire {

	function writeFormLogin(){

		echo '<div id="formLog">';
			echo '<label for="txtlogin">Entrer votre login :</label><br/>';
			echo '<input id="txtLogin" name="" type="text" /><br/>';
			echo '<label for="txtPassword">Entrer votre mdp :</label><br/>';
			echo '<input id="txtPassword" name="" type="password" />';
			echo '<input id="btnLogin"  name="" type="button" value="Connect" />';
		echo '</div>';
		if ( $_SESSION["login"]!= NULL || $_SESSION["login"]!=""){
		echo'<div id="result" >';
		echo 'voici votre '.$_SESSION["login"].'';
		echo'</div>';
		}
		else{
		echo"vous vous êtes trompé d'id ou mdp";
		}
	}
	
	function deconnexion(){
		
	}
}

?>