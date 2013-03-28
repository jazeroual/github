<?php

 try {
    $bdd = new PDO('mysql:host=localhost;dbname=restonumerik', 'root', '');

} catch (PDOException $e) {
    echo 'Connexion échouée : '.$e->getMessage();
}


//$connexion=mysql_connect("localhost","root",""); // Connexion à MySQL
//mysql_select_db("restoNumerik",$connexion); // Sélection de la base coursphp
?>