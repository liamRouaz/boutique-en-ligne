<?php
  // Paramètres de connexion à la base de données
  $servername = '127.0.0.1';
  $username = 'root';
  $password = 'root';
  $db_db = 'utilisateur';
  $db_port = 8889;

  // Connexion à la base de données
  $mysqli = new mysqli(
    $servername,
    $username,
    $password,
    $db_db,
    $db_port
  );

  // Vérification de la connexion
  if ($mysqli->connect_error) {
    die("Échec de la connexion : " . $mysqli->connect_error);
  }

  // Vérification si le formulaire a été soumis
  if(isset($_POST["ok"])){
    // Extraction des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['password'];
    $mail = $_POST['email'];

    // Affichage des données pour le débogage
    echo $nom;
    echo $prenom;
    echo $pseudo;
    echo $mdp;
    echo $mail;

    // Préparation de la requête SQL
    $stmt = $mysqli->prepare("INSERT INTO users (pseudo, nom, prenom, mdp, email) VALUES (?, ?, ?, ?, ?)");
    if ($stmt) {
      // Liaison des paramètres
      $stmt->bind_param("sssss", $pseudo, $nom, $prenom, $mdp, $mail);

      // Exécution de la requête
      $stmt->execute();

      // Vérification des erreurs
      if ($stmt->error) {
        echo "Erreur : " . $stmt->error;
      } else {
        echo "Nouvel enregistrement créé avec succès";
      }

      // Fermeture de la requête
      $stmt->close();
    } else {
      echo "Erreur de préparation de la requête : " . $mysqli->error;
    }
  }

  // Fermeture de la connexion
  $mysqli->close();
?>
