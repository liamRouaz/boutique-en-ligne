<?php

class Size {
    public $id;
    public $name;

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
            $errors[] = "Le nom de la taille est requis.";
        }

        return $errors;
    }

    // Méthode pour enregistrer la taille dans la base de données
    public function save() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('INSERT INTO sizes (name) VALUES (:name)');
        $stmt->bindParam(':name', $this->name);

        $stmt->execute();
        $this->id = $pdo->lastInsertId();
    }

    // Méthode pour mettre à jour la taille dans la base de données
    public function update() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('UPDATE sizes SET name = :name WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);

        $stmt->execute();
    }

    // Méthode pour supprimer la taille de la base de données
    public function delete() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('DELETE FROM sizes WHERE id = :id');
        $stmt->bindParam(':id', $this->id);

        $stmt->execute();
    }

    // Méthode statique pour trouver une taille par son ID
    public static function find($id) {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM sizes WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $size = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($size) {
            return new self($size);
        }

        return null;
    }

    // Méthode statique pour récupérer toutes les tailles
    public static function all() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM sizes');
        $stmt->execute();

        $sizes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sizeObjects = [];
        foreach ($sizes as $size) {
            $sizeObjects[] = new self($size);
        }

        return $sizeObjects;
    }

    // Méthode pour obtenir les produits associés à une taille
    public function getProducts() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('
            SELECT p.*
            FROM products p
            JOIN stocks s ON p.id = s.product_id
            WHERE s.size_id = :size_id
        ');
        $stmt->bindParam(':size_id', $this->id);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $productObjects = [];
        foreach ($products as $product) {
            $productObjects[] = new Product($product);
        }

        return $productObjects;
    }
}

?>
