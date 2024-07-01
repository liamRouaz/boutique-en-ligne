<?php

require 'Database.php';
require 'Product.php';
require 'Size.php';

class Stock {
    public $id;
    public $product_id;
    public $size_id;
    public $quantity;

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

        if (!is_numeric($this->product_id) || $this->product_id <= 0) {
            $errors[] = "L'ID du produit est requis et doit être un entier positif.";
        }

        if (!is_numeric($this->size_id) || $this->size_id <= 0) {
            $errors[] = "L'ID de la taille est requis et doit être un entier positif.";
        }

        if (!is_numeric($this->quantity) || $this->quantity < 0) {
            $errors[] = "La quantité doit être un nombre positif ou zéro.";
        }

        return $errors;
    }

    // Méthode pour enregistrer le stock dans la base de données
    public function save() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('INSERT INTO stocks (product_id, size_id, quantity) VALUES (:product_id, :size_id, :quantity)');
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':size_id', $this->size_id);
        $stmt->bindParam(':quantity', $this->quantity);

        $stmt->execute();
        $this->id = $pdo->lastInsertId();
    }

    // Méthode pour mettre à jour le stock dans la base de données
    public function update() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('UPDATE stocks SET product_id = :product_id, size_id = :size_id, quantity = :quantity WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':size_id', $this->size_id);
        $stmt->bindParam(':quantity', $this->quantity);

        $stmt->execute();
    }

    // Méthode pour supprimer le stock de la base de données
    public function delete() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('DELETE FROM stocks WHERE id = :id');
        $stmt->bindParam(':id', $this->id);

        $stmt->execute();
    }

    // Méthode statique pour trouver un stock par son ID
    public static function find($id) {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM stocks WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $stock = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stock) {
            return new self($stock);
        }

        return null;
    }

    // Méthode statique pour récupérer tous les stocks
    public static function all() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM stocks');
        $stmt->execute();

        $stocks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stockObjects = [];
        foreach ($stocks as $stock) {
            $stockObjects[] = new self($stock);
        }

        return $stockObjects;
    }

    // Méthode pour récupérer la quantité de stock pour un produit et une taille spécifiques
    public static function findByProductAndSize($product_id, $size_id) {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM stocks WHERE product_id = :product_id AND size_id = :size_id');
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':size_id', $size_id);
        $stmt->execute();

        $stock = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stock) {
            return new self($stock);
        }

        return null;
    }
}

?>
