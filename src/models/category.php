<?php

class Category {
    public $id;
    public $name;
    public $description;

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

        if (empty($this->name)) {
            $errors[] = "Le nom de la catégorie est requis.";
        }

        if (empty($this->description)) {
            $errors[] = "La description de la catégorie est requise.";
        }

        return $errors;
    }

    // Méthode pour enregistrer la catégorie dans la base de données
    public function save() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('INSERT INTO categories (name, description) VALUES (:name, :description)');
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);

        $stmt->execute();
        $this->id = $pdo->lastInsertId();
    }

    // Méthode pour mettre à jour la catégorie dans la base de données
    public function update() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('UPDATE categories SET name = :name, description = :description WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);

        $stmt->execute();
    }

    // Méthode pour supprimer la catégorie de la base de données
    public function delete() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('DELETE FROM categories WHERE id = :id');
        $stmt->bindParam(':id', $this->id);

        $stmt->execute();
    }

    // Méthode statique pour trouver une catégorie par son ID
    public static function find($id) {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($category) {
            return new self($category);
        }

        return null;
    }

    // Méthode statique pour récupérer toutes les catégories
    public static function all() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM categories');
        $stmt->execute();

        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categoryObjects = [];
        foreach ($categories as $category) {
            $categoryObjects[] = new self($category);
        }

        return $categoryObjects;
    }

    // Méthode pour obtenir tous les produits d'une catégorie
    public function getProducts() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM products WHERE category_id = :category_id');
        $stmt->bindParam(':category_id', $this->id);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productObjects = [];
        foreach ($products as $product) {
            $productObjects[] = new Product($product);
        }

        return $productObjects;
    }


?>
