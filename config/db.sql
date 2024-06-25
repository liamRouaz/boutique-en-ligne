PRAGMA foreign_keys = ON;

/* table pour données utilisateurs */
CREATE TABLE users(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    firstname VARCHAR(150) NOT NULL,
    surname VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(150) NOT NULL,
    adress VARCHAR(150) NOT NULL,
    postcode INTEGER NOT NULL,
    city VARCHAR (150) NOT NULL,
    country VARCHAR(150) NOT NULL,
    phone INTEGER,
    order_id INTEGER NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) 
);

/* Table de LIAISON entre users et products */
CREATE TABLE products_users(
    product_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    PRIMARY KEY (product_id, user_id),
    UNIQUE (product_id, user_id)
);

/* table pour données produits */
CREATE TABLE products(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    name VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255),
    price INTEGER NOT NULL,
    id_category INTEGER NOT NULL,
    FOREIGN KEY (id_category) REFERENCES categories(id)
);

/* table pour données des catégories */
CREATE TABLE categories(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    name VARCHAR(150) NOT NULL
);

/* table de LIAISON entres orders et products */
CREATE TABLE orders_products(
    order_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id),
    PRIMARY KEY (order_id, product_id),
    UNIQUE (order_id, product_id)
);

/* table pour données des commandes */
CREATE TABLE orders(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    user_id INTEGER OT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

/* table de LIAISON entres products et sizes */
CREATE TABLE products_sizes(
    product_id INTEGER NOT NULL,
    size_id INTEGER NOT NULL,
    FOREIGN KEY (product_id) REFERENCES products(id),
    FOREIGN KEY (size_id) REFERENCES sizes(id),
    PRIMARY KEY (product_id, size_id),
    UNIQUE (product_id, size_id)
);

/* table pour données des tailles */
CREATE TABLE sizes(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    name VARCHAR(150) NOT NULL
);

/* table pour gestion du rôle admin */
CREATE TABLE roles(
    id INTEGER PRIMARY KEY NOT NULL,
    title VARCHAR(150) NOT NULL,
    admin_access BOOLEAN
);

/* table de LIAISON entres sizes et stocks */
CREATE TABLE sizes_stocks(
    size_id INTEGER NOT NULL,
    stock_id INTEGER NOT NULL,
    FOREIGN KEY (size_id) REFERENCES sizes(id),
    FOREIGN KEY (stock_id) REFERENCES stocks(id),
    PRIMARY KEY (size_id, stock_id),
    UNIQUE (size_id, stock_id)
);

/* table de données des stocks */
CREATE TABLE stocks(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    quantity INTEGER DEFAULT 0 NOT NULL
);

INSERT INTO roles(title, admin_access) VALUES
    ("administrateur", true),
    ("utilisateur", false);

INSERT INTO users(firstname, surname, email, password, adress, postcode, city, country, phone, order_id, role_id) VALUES
    ("Maxence", "Ginoux", "maxence.ginoux@laplateforme.io", "root", "5 rue d'Hozier", 13002, "Marseille", "France", 0612121314,null, 1),
    ("Liam", "Rouaz", "liam.rouaz@laplateforme.io", "root", "10 boulevard de Paris", 13002, "Marseille", "France", 0621222324, null, 1),
    ("Ali Farah", "Massoumi", "ali.massoumi@laplateforme.io", "root", "15 rue Pessonnelle", 13002, "Marseille", "France", 0631323334, null, 2);

INSERT INTO categories(title) VALUES
    ("Hauts"),
    ("Bas"),
    ("Chaussures"),
    ("Accessoires");


INSERT INTO products(name, description, image, price, id_category) VALUES
    /*** ici il faudra insérer tous les produits ***/
    ("ICECREAM", "Tee shirt", "Banque_dimage\BBcicecream_shirt1.jpeg", 20, 1),
    ("FOX", "Tee shirt", "Banque_dimage\BBcicecreame_shirt2.jpeg", 15, 1),
    ("GLO GANG", "Tee shirt", "Banque_dimage\glo.webp", 25, 1),
    ("MANI", "Tee shirt", "Banque_dimage\marni.webp", 20, 1),
    ("PALACE AMG", "Tee shirt", "Banque_dimage\paceshirt1.jpg", 30, 1),
    ("PALACE DOG", "Tee shirt", "Banque_dimage\palaceshirt2.webp", 30, 1),
    ("BLUE JACKET", "Veste", "Banque_dimage\Sa717212f4f1e4ab6ba16915d88f831dbJ_1800x1800.webp", 40, 1),
    ("SUPREME", "Veste", "Banque_dimage\supr.webp", 45, 1),
    ("KANTO STARTER", "veste", "Banque_dimage\vest1.jpg", 35, 1),
    ("PINK JACKET", "Veste", "Banque_dimage\vest2.jpg", 40, 1),
    ("GREEN BEAR JACKET", "Veste", "Banque_dimage\vest3.jpg", 35, 1),
    ("RLL", "Ceinture", "Banque_dimage/ceinture.jpg", 25, 4),
    ("RALPH LAUREN", "Ceinture", "Banque_dimage\ceinture2.jpg", 30, 4),
    ("DIESEL", "Ceinture", "Banque_dimage\ceinture3.webp", 20, 4),
    ("GREEN LANCASTER", "Sac", "Banque_dimage\sac.jpg", 80, 4),
    ("DR. MARTENS", "Sac", "Banque_dimage\sac2.jpg", 40, 4),
    ("JAPAN DR. MARTENS", "Sac", "Banque_dimage\sac3.jpeg", 50, 4),
    ("GOYARD", "Sac", "Banque_dimage\sac4.jpg", 55, 4),
    ("BLUE GOYARD", "Sac", "Banque_dimage\sac5.jpg", 60, 4),
    ("PINK BAG", "Sac", "Banque_dimage\sac6.webp", 35, 4),
    ("OLD SCHOOL BAG", "Sac", "Banque_dimage\sac7.jpg", 40, 4),
    ("GEAR BAG", "Sac", "Banque_dimage\sac8.jpg", 30, 4),
    ("BURN JEAN", "Jean", "Banque_dimage\jean1.webp", 35, 2),
    ("WOODPANTS", "Pantalon", "Banque_dimage\jean2.webp", 40, 2),
    ("BAPE", "Pantalon", "Banque_dimage\jean4.jpg", 40, 2),
    ("SILVER SHOES", "Basket", "Banque_dimage\shoe1.avif", 60, 3),
    ("BAPE SNEACKERS", "Basket", "Banque_dimage\shoe3.jpg", 70, 3),
    ("ARIGATO", "Basket", "Banque_dimage\shoes2.jpg", 40, 3),
    ("NIKE", "Basket", "Banque_dimage\shoes4.jpg", 90, 3),
    ("NIKE SPECIAL EDITION", "Basket", "Banque_dimage\shoes5.jpg", 100, 3),
    ("GOTHIC SHOES", "Chaussure", "Banque_dimage\shoes6.webp", 65, 3);


INSERT INTO sizes(name) VALUES
    ("S"),
    ("M"),
    ("L");

INSERT INTO products_sizes(product_id, size_id) VALUES
    /*** ici il faudra lier chaque produit au taille correspondante ***/
    (1, 1),
    (1, 2),
    (1, 3),
    (2, 1),
    (2, 2),
    (2, 3),
    (3, 1),
    (3, 2),
    (3, 3),
    (4, 1),
    (4, 2),
    (4, 3),
    (5, 1),
    (5, 2),
    (5, 3),
    (6, 1),
    (6, 2),
    (6, 3),
    (7, 1),
    (7, 2),
    (7, 3),
    (8, 1),
    (8, 2),
    (8, 3),
    (9, 1),
    (9, 2),
    (9, 3),
    (10, 1),
    (10, 2),
    (10, 3),
    (22, 1),
    (22, 2),
    (22, 3),
    (23, 1),
    (23, 2),
    (23, 3),
    (24, 1),
    (24, 2),
    (24, 3),
    (25, 1),
    (25, 2),
    (25, 3),
    (26, 1),
    (26, 2),
    (26, 3),
    (27, 1),
    (27, 2),
    (27, 3),
    (28, 1),
    (28, 2),
    (28, 3),
    (29, 1),
    (29, 2),
    (29, 3),
    (30, 1),
    (30, 2),
    (30, 3),

/*INSERT INTO products_users(product_id, user_id) VALUES*/
    /*** ici il faudra lier chaque produit
