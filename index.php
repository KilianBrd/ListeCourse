<?php 

include "navbar.php"; 
echo "Bonjour " . $_SESSION['prenom'] . " " . $_SESSION['nom'];
$recupListe = $conn->prepare('SELECT * FROM liste WHERE idUser = ?');
$recupListe->execute(array($_SESSION['id']));
$listes = $recupListe->fetchAll();

$a = 0;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de course</title>
</head>
<body>
    <h1 class="display-h1">Bienvenue sur ce site de liste de courses</h1>

    <?php
    if (isset($_SESSION['prenom'])) {?>
        <a href="nouvelleListe.php" class="link-light">
            <button class="btn btn-primary">Créer une nouvelle liste +</button>
        </a>
        <br><br>
        <div class="d-flex flex-wrap">
            <?php foreach($listes as $liste) { ?>
                <div class="card m-3" style="width: 18rem;">
                <div class="card-body">
                    <?php
                    $date = date("d/m/Y", strtotime($liste['date']));;
                    ?>
                    <h5 class="card-title">Liste du <?php echo $date; ?></h5>
                    <p class="card-text"><?php echo "<p>" . $liste['contenu'] . "</p>"; ?></p>
                    <form method="post">
                        <input type="hidden" name="listeId" value="<?php echo $liste['contenu']; ?>">
                        <button type="submit" class="btn btn-danger" name="supprimerListe">Supprimer</button>
                    </form>
                </div>
                </div>
                <?php $a++; ?>
            <?php }?>
        </div>
    <?php } else {
        echo "<p><a href='inscription.php'>Creer toi un compte</a> ou 
        <a href='connexion.php'>connecte toi </a> pour utiliser la totalité du site !</p>";
    }
    if (isset($_POST['supprimerListe'])) {
        $contenuSuppr = $_POST['listeId'];
        $supprListe = $conn -> prepare('DELETE FROM liste WHERE contenu = ?');
        $supprListe -> execute(array($contenuSuppr));
        echo "<meta http-equiv='refresh' content='0'>";
    }
 
 ?>
</body>
</html>
