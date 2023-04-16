<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer une liste</title>
    <?php include "navbar.php";
    $nbAliments = isset($_POST['nbAlim']) ? $_POST['nbAlim'] : 1; ?>

</head>
<body>
    <h1>Creation d'une liste</h1>
    <form method="post">
        <label for="nbAlim"> Nombre d'aliments :</label>
        <select name="nbAlim" id="nbAlim">
            <?php for ($i = 1; $i <= 100; $i++) { ?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php
            } ?>
        </select>
        <input type="submit" value="Valider" name="oknb" id="oknb" class="btn btn-primary">
    </form>
    <?php 

    // Récupération des aliments depuis la base de données
    $recupAlim = $conn->prepare('SELECT * FROM aliments');
    $recupAlim->execute();
    $aliments = $recupAlim->fetchAll();
    if (isset($_POST['oknb'])) {
        // Nombre d'aliments à afficher
        $nbAliments = isset($nbAliments) ? $nbAliments : $_POST['nbAlim'];
        
        // Affichage des sélecteurs d'aliments
        
        echo '<form method="post">';
        echo '<input type="hidden" name="nbAlim" value="'.$nbAliments.'">';
        for ($i = 1; $i <= $nbAliments; $i++) {
            echo '<select name="aliment' . $i . '" id="aliment' . $i . '" class="m-3">';
            foreach ($aliments as $aliment) {
                echo '<option value="' . $aliment['nom'] . '">' . $aliment['nom'] . '</option>';
            }
            echo '</select>';
        } 
        echo '<button name="ajoutListe" id="ajoutListe" class="btn btn-primary">Ajoutez cette liste</button>';
        echo '</form>';
}
    if (isset($_POST['ajoutListe'])) {
        // Construction de la liste finale
        $nbAliments = $_POST['nbAlim'];
        $listeFinale = '';
        for ($i = 1; $i <= $nbAliments; $i++) {
            if (isset($_POST['aliment' . $i])) {
                $newAlim= $_POST['aliment' . $i] . ', ';
                $listeFinale .= $newAlim;
            }
        }
        // Suppression de la dernière virgule
        $listeFinale = rtrim($listeFinale, ', ');
        echo "<p>La liste a bien été ajouté</p>";
        // Insertion de la liste dans la base de données
       $envoyer = $conn->prepare('INSERT INTO liste(idUser, contenu) VALUES (?,?)');
       $envoyer->execute(array($_SESSION['id'], $listeFinale));
       
    }
    
    ?>
    
</body>
</html>