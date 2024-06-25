const express = require("express");
const bodyParser = require("body-parser");
const PORT = process.env.PORT || 3000;
const app = express();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Middleware de logging pour valider la connexion quand ca sera prêt
app.use(logger);

// Pour utilisation des routes API quand ca sera prêt aussi
app.use("/api", apiRoutes);

// Middleware gestions d'erreurs
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).send("Erreur interne du serveur");
});

// Démarrer serveur
app.listen(PORT, () => {
  console.log("Serveur démarré sur le port ${PORT}");
});
