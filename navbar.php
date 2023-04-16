<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.js"></script>

<?php
session_start();
if(isset($_SESSION['prenom'])) { ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#btn" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="index.php">Acceuil</a>

  <div class="collapse navbar-collapse" id="btn">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="nouvelleListe.php">Creer une liste</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nouvelAliment.php">Ajouter un aliment</a>
      </li>
    </ul>
      <a href="deconnexion.php"><button class="btn btn-secondary"> Deconnexion</button></a>
  </div>
</nav> <?php
} elseif (!isset($_SESSION['prenom'])) { ?>
  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="index.php">Acceuil</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <a href="connexion.php"><button class="btn btn-outline-success my-2 my-sm-0"> Me connecter </button></a>
      <a href="inscription.php"><button class="btn btn-outline-success my-2 my-sm-0"> M'inscrire </button></a>
  </div>
</nav>
<?php
};
include "database.php";