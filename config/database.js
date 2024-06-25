const mysql = require('mysql');

// Configuration de la connexion à MySQL
const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "boutique_en_ligne"
});

// Connexion à MySQL
connection.connect((err) => {
  if (err) {
    console.error('Erreur de connexion à MySQL : ', err);
    return;
  }
  console.log('Connecté à MySQL avec succès.');
};

module.exports = connection;
