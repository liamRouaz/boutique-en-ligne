<?php

class User {
    private $id;
    private $firstname;
    private $surname;
    private $email;
    private $password;
    private $address;
    private $postcode;
    private $city;
    private $country;
    private $phone;
    private $role_id;

    public function __construct($firstname, $surname, $email, $password, $address, $postcode, $city, $country, $phone, $role_id, $id = null) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->address = $address;
        $this->postcode = $postcode;
        $this->city = $city;
        $this->country = $country;
        $this->phone = $phone;
        $this->role_id = $role_id;
    }

    public function save() {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO users (firstname, surname, email, password, address, postcode, city, country, phone, role_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$this->firstname, $this->surname, $this->email, $this->password, $this->address, $this->postcode, $this->city, $this->country, $this->phone, $this->role_id]);
    }

    public function update() {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('UPDATE users SET firstname = ?, surname = ?, email = ?, password = ?, address = ?, postcode = ?, city = ?, country = ?, phone = ?, role_id = ? WHERE id = ?');
        $stmt->execute([$this->firstname, $this->surname, $this->email, $this->password, $this->address, $this->postcode, $this->city, $this->country, $this->phone, $this->role_id, $this->id]);
    }

    public static function delete($id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
        $stmt->execute([$id]);
    }

    public static function findById($id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findAll() {
        $pdo = Database::getConnection();
        $stmt = $pdo->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findByEmail($email) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRole() {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM roles WHERE id = ?');
        $stmt->execute([$this->role_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function validate() {
        $errors = [];

        // Vérifier que le prénom n'est pas vide
        if (empty($this->firstname)) {
            $errors[] = "Le prénom est requis.";
        }

        // Vérifier que le nom de famille n'est pas vide
        if (empty($this->surname)) {
            $errors[] = "Le nom de famille est requis.";
        }

        // Vérifier que l'email est valide
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Une adresse email valide est requise.";
        }

        // Vérifier que le mot de passe est valide
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

        // Vérifier que l'adresse n'est pas vide
        if (empty($this->address)) {
            $errors[] = "Une adresse postale est requise.";
        }

        // Vérifier que le code postal est valide
        if (empty($this->postcode) || !is_numeric($this->postcode)) {
            $errors[] = "Un code postal valide est requis.";
        }

        // Vérifier que la ville n'est pas vide
        if (empty($this->city)) {
            $errors[] = "Une ville est requise.";
        }

        // Vérifier que le pays n'est pas vide
        if (empty($this->country)) {
            $errors[] = "Un pays est requis.";
        }

        // Vérifier que le téléphone est valide
        if (!empty($this->phone) && !is_numeric($this->phone)) {
            $errors[] = "Un numéro de téléphone valide est requis.";
        }

        return $errors;
    }
    
}
?>
