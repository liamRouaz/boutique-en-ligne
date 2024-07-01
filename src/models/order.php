<?php
require_once 'Role.php';

class Order {
    public $id;
    public $user_id;
    public $total_amount;
    public $status;
    public $date;
    public $order_number;

    public function __construct($data = []) {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    // méthode pour enregistrer la commande dans la base de données
    public function save() {
        $pdo = Database::getInstance()->getConnection();

        if ($this->id) {
            $stmt = $pdo->prepare('UPDATE orders SET user_id = :user_id, total_amount = :total_amount, status = :status, date = :date, order_number = :order_number WHERE id = :id');
            $stmt->bindParam(':id', $this->id);
        } else {
            $stmt = $pdo->prepare('INSERT INTO orders (user_id, total_amount, status, date, order_number) VALUES (:user_id, :total_amount, :status, :date, :order_number)');
        }

        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':total_amount', $this->total_amount);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':order_number', $this->order_number);

        $stmt->execute();

        // pour mettre à jour l'ID si c'est une nouvelle insertion
        if (!$this->id) {
            $this->id = $pdo->lastInsertId();
        }
    }

    // Méthode pour mettre à jour le statut de la commande
    public function updateStatus($newStatus) {
        // Vérifier si l'utilisateur actuel est administrateur
        if ($this->getRoleByEmail()) {
            $this->status = $newStatus;
            $this->save(); 
            return true; // Retourner vrai si la mise à jour est réussie
        } else {
            return false; // Retourner faux si l'utilisateur n'est pas autorisé à mettre à jour le statut
        }
    }

    // Méthode pour ajouter un produit à la commande
    public function addProduct($productId, $quantity) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('INSERT INTO order_products (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)');
        $stmt->bindParam(':order_id', $this->id);
        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();
    }

    // Méthode pour retirer un produit de la commande
    public function removeProduct($productId) {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('DELETE FROM order_products WHERE order_id = :order_id AND product_id = :product_id');
        $stmt->bindParam(':order_id', $this->id);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
    }

    // Méthode pour récupérer tous les produits de la commande
    public function getProducts() {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('SELECT p.* FROM products p JOIN order_products op ON p.id = op.product_id WHERE op.order_id = :order_id');
        $stmt->bindParam(':order_id', $this->id);
        $stmt->execute();

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    // méthode pour calculer le montant total de la commande
    public function getTotalAmount() {
        $totalAmount = 0;
        $products = $this->getProducts();
        foreach ($products as $product) {
            $totalAmount += $product['price'] * $product['quantity'];
        }
        return $totalAmount;
    }
}

?>
