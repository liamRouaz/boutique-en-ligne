<?php
require_once 'models/User.php';

class UserController {
    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = new User($_POST);

            $errors = $user->validate();
            if (empty($errors)) {
                $user->password = password_hash($user->password, PASSWORD_BCRYPT);
                if ($user->save()) {
                    echo "Utilisateur enregistré avec succès.";
                } else {
                    echo "Erreur lors de l'enregistrement de l'utilisateur.";
                }
            } else {
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
            }
        }

        require 'views/register.php';
    }

    public function updateProfile($userId) {
        $user = User::find($userId);
        if (!$user) {
            echo "Utilisateur non trouvé.";
            return;
        }
        
        // Logique de mise à jour du profil de l'utilisateur
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $user->firstname = $_POST["firstname"];
            $user->surname = $_POST["surname"];
            $user->email = $_POST["email"];
            $user->address = $_POST["address"];
            $user->postcode = $_POST["postcode"];
            $user->city = $_POST["city"];
            $user->country = $_POST["country"];
            $user->phone = $_POST["phone"];
            $user->role_id = $_POST["role_id"];

            $errors = $user->validate();
            if (empty($errors)) {
                if ($user->update()) {
                    echo "Profil utilisateur mis à jour avec succès.";
                } else {
                    echo "Erreur lors de la mise à jour du profil utilisateur.";
                }
            } else {
                foreach ($errors as $error) {
                    echo $error . "<br>";
                }
            }
        }

        require 'views/update_profile.php';
    }
}
