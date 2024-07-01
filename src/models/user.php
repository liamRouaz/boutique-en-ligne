<?php

class User {
    public $id;
    public $firstname;
    public $surname;
    public $email;
    public $password;
    public $address;
    public $postcode;
    public $city;
    public $country;
    public $phone;
    public $role_id;

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    // Méthode de validation
    public function validate() {
        $errors = [];

        if (empty($this->firstname)) {
            $errors[] = "Le prénom est requis.";
        }

        if (empty($this->surname)) {
            $errors[] = "Le nom de famille est requis.";
        }

        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Une adresse email valide est requise.";
        }

        if (!empty($this->password)) {
            if (strlen($this->password) < 8) {
                $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
            }
            if (!preg_match('/[A-Z]/', $this->password)) {
                $errors[] = "Le mot de passe doit contenir au moins une majuscule.";
            }
            if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $this->password)) {
                $errors[] = "Le mot de passe doit contenir au moins un caractère spécial.";
            }
        } else {
            $errors[] = "Le mot de passe est requis.";
        }

        if (empty($this->address)) {
            $errors[] = "L'adresse est requise.";
        }

        if (empty($this->postcode) || !is_numeric($this->postcode)) {
            $errors[] = "Un code postal valide est requis.";
        }

        if (empty($this->city)) {
            $errors[] = "La ville est requise.";
        }

        if (empty($this->country)) {
            $errors[] = "Le pays est requis.";
        }

        if (!empty($this->phone) && !is_numeric($this->phone)) {
            $errors[] = "Un numéro de téléphone valide est requis.";
        }

        return $errors;
    }

    // Méthode pour enregistrer l'utilisateur dans la base de données
    public function save() {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            INSERT INTO users (firstname, surname, email, password, address, postcode, city, country, phone, role_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("sssssisisi", $this->firstname, $this->surname, $this->email, $this->password, $this->address, $this->postcode, $this->city, $this->country, $this->phone, $this->role_id);

        // Détermine le rôle en fonction de l'email
        $this->role_id = Role::getRoleByEmail($this->email);

        if ($stmt->execute()) {
            $this->id = $stmt->insert_id;
            return true;
        } else {
            return false;
        }
    }

    // Méthode pour mettre à jour l'utilisateur dans la base de données
    public function update() {
        $db = Database::getConnection();

        $stmt = $db->prepare("
            UPDATE users SET firstname = ?, surname = ?, email = ?, password = ?, address = ?, postcode = ?, city = ?, country = ?, phone = ?, role_id = ?
            WHERE id = ?
        ");
        $stmt->bind_param("sssssisisi", $this->firstname, $this->surname, $this->email, $this->password, $this->address, $this->postcode, $this->city, $this->country, $this->phone, $this->role_id, $this->id);

        return $stmt->execute();
    }

    // Méthode pour trouver un utilisateur par son ID
    public static function find($id) {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                return new self($row);
            }
        }

        return null;
    }

    // Méthode pour trouver un utilisateur par son email
    public static function findByEmail($email) {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                return new self($row);
            }
        }

        return null;
    }

    // Méthode pour supprimer un utilisateur par son ID
    public static function delete($id) {
        $db = Database::getConnection();

        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    // Méthode pour vérifier les informations d'identification de l'utilisateur (authentification)
    public static function authenticate($email, $password) {
        $user = self::findByEmail($email);
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return null;
    }

    // Fonction de liaison pour récupérer le rôle de l'utilisateur
    public function getRole() {
        return Role::find($this->role_id);
    }

    // Fonction de liaison pour récupérer les commandes de l'utilisateur
    public function getOrders() {
        return Order::findByUserId($this->id);
    }

    // Méthode pour créer une nouvelle commande pour cet utilisateur
    public function createOrder($orderData) {
        $orderData['user_id'] = $this->id;
        $order = new Order($orderData);
        if ($order->save()) {
            return $order;
        }
        return null;
    }
}
?>
