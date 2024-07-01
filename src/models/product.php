<?php

class Product {
    public $id;
    public $name;
    public $description;
    public $image;
    public $price;
    public $category_id;

    public function __construct($name, $description, $image, $price, $category_id) {
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->category_id = $category_id;
    }

    // Méthode de validation
    public function validate() {
        $errors = [];

        if (empty($this->name)) {
            $errors[] = "Le nom du produit est requis.";
        }

        if (empty($this->description)) {
            $errors[] = "La description du produit est requise.";
        }

        if (!is_numeric($this->price) || $this->price <= 0) {
            $errors[] = "Le prix doit être un nombre positif.";
        }

        if (!is_numeric($this->category_id) || $this->category_id <= 0) {
            $errors[] = "L'ID de la catégorie doit être un entier positif.";
        }

        return $errors;
    }

    // Méthode pour enregistrer le produit dans la base de données
    public function save() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('INSERT INTO products (name, description, image, price, category_id) VALUES (:name, :description, :image, :price, :category_id)');
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':category_id', $this->category_id);

        $stmt->execute();
    }

    // Méthode pour mettre à jour le produit dans la base de données
    public function update() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('UPDATE products SET name = :name, description = :description, image = :image, price = :price, category_id = :category_id WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':category_id', $this->category_id);

        $stmt->execute();
    }

    // Méthode pour supprimer le produit de la base de données
    public function delete() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('DELETE FROM products WHERE id = :id');
        $stmt->bindParam(':id', $this->id);

        $stmt->execute();
    }

    // Méthode statique pour trouver un produit par son ID
    public static function find($id) {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM products WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        return $product;
    }

    // Méthode statique pour récupérer tous les produits
    public static function all() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM products');
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }
 
    // méthode pour récupérer la catégorie d'un produit
    public function getCategory() {
        return Category::find($this->category_id);
    }
    

    // Fonction de liaison pour récupérer les tailles disponibles pour ce produit avec les quantités disponibles
    public function getSizesWithQuantities() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT sizes.*, stocks.quantity FROM sizes INNER JOIN stocks ON sizes.id = stocks.size_id WHERE stocks.product_id = :product_id');
        $stmt->bindParam(':product_id', $this->id);
        $stmt->execute();

        $sizes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $sizes;
    }
}

?>
