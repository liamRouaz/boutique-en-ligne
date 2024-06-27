/* Table pour les données utilisateurs */
CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    firstname VARCHAR(150) NOT NULL,
    surname VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(150) NOT NULL,
    address VARCHAR(150) NOT NULL,
    postcode INTEGER NOT NULL,
    city VARCHAR(150) NOT NULL,
    country VARCHAR(150) NOT NULL,
    phone INTEGER,
    order_id INTEGER NOT NULL,
    role_id INTEGER NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

/* Table pour les données produits */
CREATE TABLE products (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255),
    price INTEGER NOT NULL,
    category_id INTEGER NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

/* Table pour les données des catégories */
CREATE TABLE categories (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(150) NOT NULL
);

/* Table de liaison entre orders et products */
CREATE TABLE orders_products (
    order_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    quantity INTEGER NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    PRIMARY KEY (order_id, product_id),
    UNIQUE (order_id, product_id)
);

/* Table pour les données des commandes */
CREATE TABLE orders (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    order_number INT UNIQUE,
    date DATETIME,
    user_id INTEGER,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Ajout du déclencheur pour générer le numéro de commande automatiquement
DELIMITER //

CREATE TRIGGER before_insert_orders
BEFORE INSERT ON orders
FOR EACH ROW
BEGIN
    DECLARE next_order_number INT;
    SELECT COALESCE(MAX(order_number), 0) + 1 INTO next_order_number FROM orders;
    SET NEW.order_number = next_order_number;
END //

DELIMITER ;

/* Table pour la gestion des rôles admin */
CREATE TABLE roles (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    title VARCHAR(150) NOT NULL,
    admin_access BOOLEAN
);

/* Table pour les tailles */
CREATE TABLE sizes (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR(150) NOT NULL
);

/* Table pour les stocks */
CREATE TABLE stocks (
    id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    quantity INTEGER DEFAULT 0 NOT NULL,
    product_id INTEGER NOT NULL,
    size_id INTEGER NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (size_id) REFERENCES sizes(id),
    UNIQUE (product_id, size_id)
);

/* Insertion des rôles */
INSERT INTO roles (title, admin_access) VALUES
    ("administrateur", true),
    ("utilisateur", false);

/* Insertion des utilisateurs */
INSERT INTO users (firstname, surname, email, password, address, postcode, city, country, phone, role_id) VALUES
    ("Maxence", "Ginoux", "maxence.ginoux@laplateforme.io", "root", "5 rue d'Hozier", 13002, "Marseille", "France", 0612121314, 1),
    ("Liam", "Rouaz", "liam.rouaz@laplateforme.io", "root", "10 boulevard de Paris", 13002, "Marseille", "France", 0621222324, 1),
    ("Ali Farah", "Massoumi", "ali.massoumi@laplateforme.io", "root", "15 rue Pessonnelle", 13002, "Marseille", "France", 0631323334, 2);

/* Insertion des catégories */
INSERT INTO categories (name) VALUES
    ("Hauts"),
    ("Bas"),
    ("Chaussures"),
    ("Accessoires");







/* Insertion des produits */
INSERT INTO products (name, description, image, price, category_id) VALUES
    ("ICECREAM", "Tee shirt", "Banque_dimage\\BBcicecream_shirt1.jpeg", 20, 1),
    ("FOX", "Tee shirt", "Banque_dimage\\BBcicecreame_shirt2.jpeg", 15, 1),
    ("GLO GANG", "Tee shirt", "Banque_dimage\\glo.webp", 25, 1),
    ("MANI", "Tee shirt", "Banque_dimage\\marni.webp", 20, 1),
    ("PALACE AMG", "Tee shirt", "Banque_dimage\\paceshirt1.jpg", 30, 1),
    ("PALACE DOG", "Tee shirt", "Banque_dimage\\palaceshirt2.webp", 30, 1),
    ("BLUE JACKET", "Veste", "Banque_dimage\\Sa717212f4f1e4ab6ba16915d88f831dbJ_1800x1800.webp", 40, 1),
    ("SUPREME", "Veste", "Banque_dimage\\supr.webp", 45, 1),
    ("KANTO STARTER", "veste", "Banque_dimage\\vest1.jpg", 35, 1),
    ("PINK JACKET", "Veste", "Banque_dimage\\vest2.jpg", 40, 1),
    ("GREEN BEAR JACKET", "Veste", "Banque_dimage\\vest3.jpg", 35, 1),
    ("RLL", "Ceinture", "Banque_dimage/ceinture.jpg", 25, 4),
    ("RALPH LAUREN", "Ceinture", "Banque_dimage\\ceinture2.jpg", 30, 4),
    ("DIESEL", "Ceinture", "Banque_dimage\\ceinture3.webp", 20, 4),
    ("GREEN LANCASTER", "Sac", "Banque_dimage\\sac.jpg", 80, 4),
    ("DR. MARTENS", "Sac", "Banque_dimage\\sac2.jpg", 40, 4),
    ("JAPAN DR. MARTENS", "Sac", "Banque_dimage\\sac3.jpeg", 50, 4),
    ("GOYARD", "Sac", "Banque_dimage\\sac4.jpg", 55, 4),
    ("BLUE GOYARD", "Sac", "Banque_dimage\\sac5.jpg", 60, 4),
    ("PINK BAG", "Sac", "Banque_dimage\\sac6.webp", 35, 4),
    ("OLD SCHOOL BAG", "Sac", "Banque_dimage\\sac7.jpg", 40, 4),
    ("GEAR BAG", "Sac", "Banque_dimage\\sac8.jpg", 30, 4),
    ("BURN JEAN", "Jean", "Banque_dimage\\jean1.webp", 35, 2),
    ("WOODPANTS", "Pantalon", "Banque_dimage\\jean2.webp", 40, 2),
    ("BAPE", "Pantalon", "Banque_dimage\\jean4.jpg", 40, 2),
    ("SILVER SHOES", "Basket", "Banque_dimage\\shoe1.avif", 60, 3),
    ("BAPE SNEAKERS", "Basket", "Banque_dimage\\shoe3.jpg", 70, 3),
    ("ARIGATO", "Basket", "Banque_dimage\\shoes2.jpg", 40, 3),
    ("NIKE", "Basket", "Banque_dimage\\shoes4.jpg", 90, 3),
    ("NIKE SPECIAL EDITION", "Basket", "Banque_dimage\\shoes5.jpg", 100, 3),
    ("GOTHIC SHOES", "Chaussure", "Banque_dimage\\shoes6.webp", 65, 3);

/* Insertion des tailles */
INSERT INTO sizes (name) VALUES
    ("S"),
    ("M"),
    ("L"),
    ("Unique");

/* Insertion des stocks */
INSERT INTO stocks (quantity, product_id, size_id) VALUES
    (100, 1, 1), (150, 1, 2), (200, 1, 3),
    (80, 2, 1), (120, 2, 2), (160, 2, 3),
    (60, 3, 1), (100, 3, 2), (140, 3, 3),
    (50, 4, 1), (90, 4, 2), (130, 4, 3),
    (70, 5, 1), (110, 5, 2), (150, 5, 3),
    (40, 6, 1), (80, 6, 2), (120, 6, 3),
    (30, 7, 1), (70, 7, 2), (110, 7, 3),
    (20, 8, 1), (60, 8, 2), (100, 8, 3),
    (10, 9, 1), (50, 9, 2), (90, 9, 3),
    (5, 10, 1), (45, 10, 2), (85, 10, 3),
    (15, 11, 4),
    (25, 12, 4), 
    (35, 13, 4),
    (45, 14, 4),
    (55, 15, 4), 
    (65, 16, 4), 
    (75, 17, 4), 
    (85, 18, 4), 
    (95, 19, 4), 
    (105, 20,4), 
    (115, 21,4), 
    (125, 22, 1), (165, 22, 2), (205, 22, 3),
    (135, 23, 1), (175, 23, 2), (215, 23, 3),
    (145, 24, 1), (185, 24, 2), (225, 24, 3),
    (155, 25, 1), (195, 25, 2), (235, 25, 3),
    (165, 26, 1), (205, 26, 2), (245, 26, 3),
    (175, 27, 1), (215, 27, 2), (255, 27, 3),
    (185, 28, 1), (225, 28, 2), (265, 28, 3),
    (195, 29, 1), (235, 29, 2), (275, 29, 3),
    (205, 30, 1), (245, 30, 2), (285, 30, 3),
    (215, 31, 1), (255, 31, 2), (295, 31, 3);

/* Insertion des commandes */
INSERT INTO orders (order_number, date, user_id) VALUES
    (1001, '2023-06-27 10:00:00', 1),
    (1002, '2023-06-28 11:00:00', 1),
    (1003, '2023-06-29 12:00:00', 1);

/* Insertion des produits dans chaque commande */
INSERT INTO orders_products (order_id, product_id, quantity) VALUES
    (1, 1, 2),
    (1, 2, 1),
    (2, 1, 3),
    (2, 3, 1),
    (3, 2, 2),
    (3, 3, 2);
