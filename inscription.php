<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M'inscrire</title>
</head>
<body>
    <?php include "navbar.php" ?>
    <form method="get">
        <label for="prenom" class="mt-3">Ton prénom !</label>
        <input type="text" name="prenom" id="prenom" required>
        <br>
        <label for="nom" class="mt-3">Ton nom !</label>
        <input type="text" name="nom" id="nom" required>
        <br>
        <label for="mdpClair" class="mt-3">Tom mot de passe</label>
        <input type="password" name="mdpClair" id="mdpClaire" required>
        <br>
        <label for="mdpClairVerif" class="mt-3">Retape ton mot de passe</label>
        <input type="password" name="mdpClairVerif" id="mdpClaireVerif" required>
        <br>
        <button type="submit" class="btn btn-primary p-2">S'inscrire</button>
        <a href="connexion.php"><button type="submit" class="btn btn-secondary">Se connecter</button></a>
    </form>
    <?php
        $prenom = $_GET['prenom'];
        $nom = $_GET['nom'];
        $mdpClair = $_GET['mdpClair'];
        $mdpClairVerif = $_GET['mdpClairVerif'];
        $mdp = password_hash($_GET['mdpClair'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE nom=? and prenom=?");
        $stmt->execute(array($nom, $prenom)); 
        $user = $stmt->fetch();
        if ($mdpClair == $mdpClairVerif) {
            if ($user) {
                // le nom d'utilisateur existe déjà
                echo "<p>Cet utilisateur exitse déjà</p>";
            } else {
                $insertUser = $conn -> prepare('INSERT INTO utilisateur(prenom, nom, mdp) VALUES(?, ?, ?)');
                $insertUser -> execute(array($prenom, $nom, $mdp));
                echo "<p>Compte créé !</p>";
                $recupId = $conn -> prepare('SELECT id FROM utilisateur where nom=? and prenom=?');
                $recupId -> execute(array($nom, $prenom));
                $id = $recupId->fetch()['id'];
                $_SESSION['id'] = $id;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['nom'] = $nom;
                echo "<meta http-equiv='refresh' content='0'>";
                header('Location: index.php');

            } 
        } else {
            echo "Les deux mots de passes ne correspondent pas";
    }
    ?>
</body>
</html>