<?php
session_start();

// Initialisation du panier si ce n'est pas déjà fait
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Ajout d'un article au panier
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="card.css">
    <link rel="shortcut icon" href="./asset/shop.png" type="image/x-icon">
    <title>Document</title>
</head>
<body>
    <header>
        <nav id='menu'>
            <input type='checkbox' id='responsive-menu' onclick='updatemenu()'><label></label>
            <ul>
                <li><a href="index.php"><img id="logo" src="./asset/Logo_Shop.png" alt=""></a></li>
                <li><a class='dropdown-arrow' href=''>Homme</a>
                    <ul class='sub-menus'>
                        <li><a href='./Haut.php'>Hauts</a></li>
                        <li><a href='./Bas.php'>Bas</a></li>
                        <li><a href='#'>Chaussures</a></li>
                        <li><a href='#'>Accesoires</a></li>
                    </ul>
                </li>
                <li><a class='dropdown-arrow' href='#'>Femme</a>
                    <ul class='sub-menus'>
                        <li><a href='Haut.html'>Hauts</a></li>
                        <li><a href='Bas.html'>Bas</a></li>
                        <li><a href='Chaussure.html'>Chaussures</a></li>
                        <li><a href='acsecoire.html'>Accesoires</a></li>
                    </ul>
                </li>
                <li><a href="panier.php">🛒 Panier (<?php echo count($_SESSION['cart']); ?>)</a></li>
            </ul>
        </nav>
    </header>
    <div class="video-container">
        <video autoplay loop>
            <source src="./asset/deco1h.mp4" type="video/mp4">
            <source src="votre-video.webm" type="video/webm">
        </video>
    </div>
    <div class="video2">
        <video autoplay loop>
            <source src="./asset/deco2h.mp4" type="video/mp4">
            <source src="votre-video.webm" type="video/webm">
        </video>
    </div>
    <div class="wrapper">
        <div class="gallery">
            <ul>
                <li>
                    <img src="./Banque_dimage/marni.webp" alt="Marni">
                    <button class="primary" data-id="1" onclick="document.getElementById('dialog1').showModal();">Open Dialog</button>
                    <dialog id="dialog1">
                        <h4>Marni</h4>
                        <button onclick="document.getElementById('dialog1').close();" aria-label="close" class="x">❌</button>
                        <form method="post" action="">
                            <input type="hidden" name="product_id" value="1">
                            <button type="submit" name="add_to_cart">Ajouter au panier</button>
                        </form>
                    </dialog>
                </li>
                <li>
                    <img src="./Banque_dimage/BBcicecreame_shirt2.jpeg" alt="BBC Ice Cream Shirt">
                    <button class="primary" data-id="2" onclick="document.getElementById('dialog2').showModal();">Open Dialog</button>
                    <dialog id="dialog2">
                        <h2>BBC Ice Cream Shirt</h2>
                        <button onclick="document.getElementById('dialog2').close();" aria-label="close" class="x">❌</button>
                        <form method="post" action="">
                            <input type="hidden" name="product_id" value="2">
                            <button type="submit" name="add_to_cart">Ajouter au panier</button>
                        </form>
                    </dialog>
                </li>
                <li>
                    <img src="./Banque_dimage/VLOO-1.jpg" alt="VLOO Shirt">
                    <button class="primary" data-id="4" onclick="document.getElementById('dialog4').showModal();">Open Dialog</button>
                    <dialog id="dialog4">
                        <h2>VLOO Shirt</h2>
                        <button onclick="document.getElementById('dialog4').close();" aria-label="close" class="x">❌</button>
                        <form method="post" action="">
                            <input type="hidden" name="product_id" value="4">
                            <button type="submit" name="add_to_cart">Ajouter au panier</button>
                        </form>
                    </dialog>
                </li>
                <li>
                    <img src="./Banque_dimage/VLOO-1.jpg" alt="VLOO Shirt">
                    <button class="primary" data-id="3" onclick="document.getElementById('dialog3').showModal();">Open Dialog</button>
                    <dialog id="dialog3">
                        <h2>VLOO Shirt</h2>
                        <button onclick="document.getElementById('dialog3').close();" aria-label="close" class="x">❌</button>
                        <form method="post" action="">
                            <input type="hidden" name="product_id" value="3">
                            <button type="submit" name="add_to_cart">Ajouter au panier</button>
                        </form>
                    </dialog>
                </li>
                <!-- Ajoutez d'autres produits ici -->
            </ul>
        </div>
    </div>
    <footer>
     <div class="connexion">
        <form>
            <label for="">Connecter vous pour ne rien raté</label>
            <br>
            <label for="Mail" ></label><input placeholder="Entrez votre Mail" type="text">
            <label for="Mail"></label><input placeholder="Mots de passe" type="search">
            <br>
            <!-- designed by me... enjoy! -->
<div class="wrapper">
    <a class="cta move-up" href="#">
      <span >NEXT</span>
      <span>
        <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <path class="one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
            <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C
