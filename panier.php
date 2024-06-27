<?php
session_start();

// Liste des produits disponibles (id => nom)
$products = [
    1 => 'Marni',
    2 => 'BBC Ice Cream Shirt',
    // Ajoutez plus de produits ici
];

// Si un produit doit être retiré du panier
if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    if (($key = array_search($product_id, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
</head>
<body>
    <h1>Votre panier</h1>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($_SESSION['cart'] as $product_id): ?>
                <li>
                    <?php echo $products[$product_id]; ?>
                    <form method="post" action="">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <button type="submit" name="remove_from_cart">Retirer</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="index.php">Retour à la boutique</a>
</body>
</html>
