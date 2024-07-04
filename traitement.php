<?php
  $db_host = '127.0.0.1';
  $db_user = 'root';
  $db_password = 'root';
  $db_db = 'utilisateur';
  $db_port = 8889;
  $mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db,
	$db_port
  );
if(isset($_POST["ok"])){
    //extract pour créé une variable apartire d'un name 
    extract($_POST);
    echo $nom=$_POST['nom']; 
    echo $prenom=$_POST['prenom'];
    echo $pseudo=$_POST['pseudo'];
    echo $mdp=$_POST['password'];
    echo $mail=$_POST['email'];
}?>