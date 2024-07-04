<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
</head>
<body>
    <style>
        input{
            margin-bottom: 10px;
        }
    </style>
    <!-- name reference des variable -->
    <form method="POST" action="traitement.php">
        <label for="name">Nom</label>
        <input type="text" placeholder="Entrez votre nom" name="nom" id="nom" required>
        <br>
        <label for="">Prenom</label>
        <input type="text" placeholder="Entrez votre prenom" name="prenom" id="prenom"required>
        <br>
        <label for="">Pseudo</label>
        <input type="text" placeholder="Entrez votre pseudo" name="pseudo" id="pseudo"required>
        <br>
        <label for="email">Email</label>
        <input type="email" placeholder="Entrez votre mail" id="email" name="email" required />
        <br>
        <label for="password">Mots de passe</label>
        <input type="password" placeholder="Entrez votre mots de passe" id="password" name="password" required />
        <input type="submit" value="m'inscricre" name="ok">
    </form>
</body>
</html>