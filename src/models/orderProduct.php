<?php

require_once 'Database.php';
require_once 'Order.php';
require_once 'Product.php';

class OrderProduct {
    public $order_id;
    public $product_id;
    public $quantity;

    public function __construct($order_id, $product_id, $quantity) {
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    // Méthode de validation
    public function validate() {
        $errors = [];

        if (empty($this->order_id) || !is_numeric($this->order_id)) {
            $errors[] = "L'ID de la commande est requis et doit être un entier.";
        }

        if (empty($this->product_id) || !is_numeric($this->product_id)) {
            $errors[] = "L'ID du produit est requis et doit être un entier.";
        }

        if (empty($this->quantity) || !is_numeric($this->quantity) || $this->quantity <= 0) {
            $errors[] = "La quantité doit être un nombre positif.";
        }

        return $errors;
    }

    // Méthode pour enregistrer la relation dans la base de données
    public function save() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('INSERT INTO orders_products (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)');
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);

        return $stmt->execute();
    }

    // Méthode pour mettre à jour la relation dans la base de données
    public function update() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('UPDATE orders_products SET quantity = :quantity WHERE order_id = :order_id AND product_id = :product_id');
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);

        return $stmt->execute();
    }

    // Méthode pour supprimer la relation de la base de données
    public function delete() {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('DELETE FROM orders_products WHERE order_id = :order_id AND product_id = :product_id');
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':product_id', $this->product_id);

        return $stmt->execute();
    }

    // Méthode statique pour trouver une relation par l'ID de la commande et l'ID du produit
    public static function find($order_id, $product_id) {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM orders_products WHERE order_id = :order_id AND product_id = :product_id');
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();

        $relation = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($relation) {
            return new self($relation['order_id'], $relation['product_id'], $relation['quantity']);
        }

        return null;
    }

    // Méthode statique pour récupérer toutes les relations pour une commande donnée
    public static function findByOrder($order_id) {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM orders_products WHERE order_id = :order_id');
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode statique pour récupérer toutes les relations pour un produit donné
    public static function findByProduct($product_id) {
        $pdo = Database::getInstance()->getConnection();

        $stmt = $pdo->prepare('SELECT * FROM orders_products WHERE product_id = :product_id');
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
