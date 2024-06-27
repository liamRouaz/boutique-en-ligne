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
                    <button class="primary" onclick="document.getElementById('dialog1').showModal();">Open Dialog</button>
                    <dialog id="dialog1">
                        <h2>Hello.</h2>
                        <p>A CSS-only modal based on the <a href="https://developer.mozilla.org/es/docs/Web/CSS/::backdrop" target="_blank">::backdrop</a> pseudo-class. Hope you find it helpful.</p>
                        <p>You can also change the styles of the <code>::backdrop</code> from the CSS.</p>
                        <button onclick="document.getElementById('dialog1').close();" aria-label="close" class="x">❌</button>
                    </dialog>
                    <button><img src="Banque_dimage/102665.png" alt=""></button>
                </li>
                <li>
                    <img src="./Banque_dimage/BBcicecreame_shirt2.jpeg" alt="BBC Ice Cream Shirt">
                    <button class="primary" onclick="document.getElementById('dialog2').showModal();">Open Dialog</button>
                    <dialog id="dialog2">
                        <h2>Hello.</h2>
                        <p>A CSS-only modal based on the <a href="https://developer.mozilla.org/es/docs/Web/CSS/::backdrop" target="_blank">::backdrop</a> pseudo-class. Hope you find it helpful.</p>
                        <p>You can also change the styles of the <code>::backdrop</code> from the CSS.</p>
                        <button onclick="document.getElementById('dialog2').close();" aria-label="close" class="x">❌</button>
                    </dialog>
                </li>
                <li>
                    <img src="./Banque_dimage/paceshirt1.jpg" alt="Pace Shirt 1">
                    <button class="primary" onclick="document.getElementById('dialog3').showModal();">Open Dialog</button>
                    <dialog id="dialog3">
                        <h2>Hello.</h2>
                        <p>A CSS-only modal based on the <a href="https://developer.mozilla.org/es/docs/Web/CSS/::backdrop" target="_blank">::backdrop</a> pseudo-class. Hope you find it helpful.</p>
                        <p>You can also change the styles of the <code>::backdrop</code> from the CSS.</p>
                        <button onclick="document.getElementById('dialog3').close();" aria-label="close" class="x">❌</button>
                    </dialog>
                </li>
                <li>
                    <img src="./Banque_dimage/palaceshirt2.webp" alt="Palace Shirt 2">
                    <button class="primary" onclick="document.getElementById('dialog4').showModal();">Open Dialog</button>
                    <dialog id="dialog4">
                        <h2>Hello.</h2>
                        <p>A CSS-only modal based on the <a href="https://developer.mozilla.org/es/docs/Web/CSS/::backdrop" target="_blank">::backdrop</a> pseudo-class. Hope you find it helpful.</p>
                        <p>You can also change the styles of the <code>::backdrop</code> from the CSS.</p>
                        <button onclick="document.getElementById('dialog4').close();" aria-label="close" class="x">❌</button>
                    </dialog>
                </li>
                <li>
                    <img src="./Banque_dimage/vest1.jpg" alt="Vest 1">
                    <button class="primary" onclick="document.getElementById('dialog5').showModal();">Open Dialog</button>
                    <dialog id="dialog5">
                        <h2>Hello.</h2>
                        <p>A CSS-only modal based on the <a href="https://developer.mozilla.org/es/docs/Web/CSS/::backdrop" target="_blank">::backdrop</a> pseudo-class. Hope you find it helpful.</p>
                        <p>You can also change the styles of the <code>::backdrop</code> from the CSS.</p>
                        <button onclick="document.getElementById('dialog5').close();" aria-label="close" class="x">❌</button>
                    </dialog>
                </li>
                <li>
                    <img src="./Banque_dimage/vest2.jpg" alt="Vest 2">
                    <button class="primary" onclick="document.getElementById('dialog6').showModal();">Open Dialog</button>
                    <dialog id="dialog6">
                        <h2>Hello.</h2>
                        <p>A CSS-only modal based on the <a href="https://developer.mozilla.org/es/docs/Web/CSS/::backdrop" target="_blank">::backdrop</a> pseudo-class. Hope you find it helpful.</p>
                        <p>You can also change the styles of the <code>::backdrop</code> from the CSS.</p>
                        <button onclick="document.getElementById('dialog6').close();" aria-label="close" class="x">❌</button>
                    </dialog>
                </li>
                <li>
                    <img src="./Banque_dimage/supr.webp" alt="Supreme">
                    <button class="primary" onclick="document.getElementById('dialog7').showModal();">Open Dialog</button>
                    <dialog id="dialog7">
                        <h2>Hello.</h2>
                        <p>A CSS-only modal based on the <a href="https://developer.mozilla.org/es/docs/Web/CSS/::backdrop" target="_blank">::backdrop</a> pseudo-class. Hope you find it helpful.</p>
                        <p>You can also change the styles of the <code>::backdrop</code> from the CSS.</p>
                        <button onclick="document.getElementById('dialog7').close();" aria-label="close" class="x">❌</button>
                    </dialog>
                </li>
                <li>
                    <img src="./Banque_dimage/glo.webp" alt="Glo">
                    <button class="primary" onclick="document.getElementById('dialog8').showModal();">Open Dialog</button>
                    <dialog id="dialog8">
                        <h2>Hello.</h2>
                        <p>A CSS-only modal based on the <a href="https://developer.mozilla.org/es/docs/Web/CSS/::backdrop" target="_blank">::backdrop</a> pseudo-class. Hope you find it helpful.</p>
                        <p>You can also change the styles of the <code>::backdrop</code> from the CSS.</p>
                        <button onclick="document.getElementById('dialog8').close();" aria-label="close" class="x">❌</button>
                    </dialog>
                </li>
                <li>
                    <img src="./Banque_dimage/Sa717212f4f1e4ab6ba16915d88f831dbJ_1800x1800.webp" alt="Sample Image">
                    <button class="primary" onclick="document.getElementById('dialog9').showModal();">Open Dialog</button>
                    <dialog id="dialog9">
                        <h2>Hello.</h2>
                        <p>A CSS-only modal based on the <a href="https://developer.mozilla.org/es/docs/Web/CSS/::backdrop" target="_blank">::backdrop</a> pseudo-class. Hope you find it helpful.</p>
                        <p>You can also change the styles of the <code>::backdrop</code> from the CSS.</p>
                        <button onclick="document.getElementById('dialog9').close();" aria-label="close" class="x">❌</button>
                    </dialog>
                </li>
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
            <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
            <path class="three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
          </g>
        </svg>
      </span> 
    </a>
  </div>
        </form>
    </div>
        <h6>Copyright © Rouaz Liam 2024</h6>
    </footer>
</body>
</html>
