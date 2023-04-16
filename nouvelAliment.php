<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel aliment</title>
</head>
<body>
    <?php include "navbar.php"; ?>
    <h1>Creer un nouvel aliment</h1>
    <form method="get">
        <input type="text" name="nouvelAliment" id="nouvelAliment">
        <button type="submit" class="btn btn-primary" name="ok" id="ok">Ajouter cet aliment</button>
    </form>
    <?php
    $nouvelAlim = $_GET['nouvelAliment'];
    if (isset($_GET['ok'])) {
        $verifAlim = $conn->prepare('SELECT COUNT(*) FROM aliments WHERE nom = ?');
        $verifAlim->execute(array($nouvelAlim));
        $result = $verifAlim->fetchColumn();
        if ($result > 0) {
            // L'aliment existe déjà, afficher un message d'erreur
            echo "<p>Cet aliment existe déjà dans la base de données.</p>";
        } else {
            // L'aliment n'existe pas encore, l'ajouter à la base de données
            $ajoutAlim = $conn->prepare('INSERT INTO aliments(nom) VALUES (?)');
            $ajoutAlim->execute(array($nouvelAlim));
            echo "<p>Aliment bien ajouté !</p>";
        }
    }
    ?>
</body>
</html>