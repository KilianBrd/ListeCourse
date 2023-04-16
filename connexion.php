<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <?php include "navbar.php"; ?>
    <form method="get">
        <label for="prenom" class="mt-3"> Ton prenom </label>
        <input type="text" name="prenom" id="prenom" required>
        <br>
        <label for="nom" class="mt-3"> Ton nom :</label>
        <input type="text" name="nom" id="nom">
        <br>
        <label for="mdp" class="mt-3"> Ton mot de passe</label>
        <input type="password" name="mdp" id="mdp" required>
        <br>
        <button type="submit" class="btn btn-primary mt-3" id="submitbtn" name="submitbtn">Me connecter</button>
        <a href="inscription.php"><button class="btn btn-secondary mt-3">S'inscrire</button></a>
    </form>
    <?php 
    $prenom = $_GET['prenom'];
    $nom = $_GET['nom'];
    $mdp=$_GET['mdp'];
    $recupUser = $conn -> prepare('select mdp as password, prenom as prenom,id as id, nom as nom from utilisateur where prenom = ? and nom= ?');
    $recupUser->execute(array($prenom,$nom));
    $res = $recupUser->fetch(PDO::FETCH_ASSOC);

    $mdpHash = $res['password'];
    $id = $res['id'];
    if (isset($_GET['submitbtn'])) {
        if ($recupUser->rowCount() > 0){
            if(password_verify($mdp, $mdpHash)){
                session_start();
                echo "c'est tout bon " . $prenom . $nom;
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['mdp'] = $mdp;
                $_SESSION['id'] = $id;
                header('Location: index.php');
            } else {
                echo "mot de passe incorrect";
            }
        } else {
            echo "pseudo incorrect";
        }
}
?>
</body>
</html>