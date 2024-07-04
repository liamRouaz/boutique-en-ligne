<?php 
if(isset($_POST["ok"])){
    //extract pour créé une variable apartire d'un name 
    extract($_POST);
    echo $nom=$_POST['nom']; 
    echo $prenom=$_POST['prenom'];
    echo $pseudo=$_POST['pseudo'];
    echo $mdp=$_POST['password'];
    echo $mail=$_POST['email']; 
}?>