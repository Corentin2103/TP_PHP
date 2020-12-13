<?php
$db = new MyPdo();
$personneManager = new PersonneManager($db);
$listePers = $personneManager -> getAllPers();

$salarieManager = new SalarieManager($db);
$etudiantManager = new EtudiantManager($db);
$fonctionManager = new FonctionManager($db);
$departementManager = new DepartementManager($db);
$villeManager = new VilleManager($db);

if(empty($_GET["num_pers"])){


  ?>

  <h1>Liste des personnes enregistrées</h1>
  <?php
  echo "Actuellement ".count($listePers)." personne(s) enregistrée(s)"
  ?>

  <table>
    <tr><th>Numéro</th><th>Nom</th><th>Prenom</th>
      <?php
      foreach ($listePers as $personne){
        ?>
        <tr><td><?php echo $personne->getPersNum();?>
        </td><td><?php echo $personne->getPersNom();?>
        </td><td><?php echo $personne->getPersPrenom();?>
        </td><td><a href="index.php?page=4&num_pers=<?php echo $personne->getPersNum() ?>">Supprimer</a>
        </td></tr>
      <?php } ?>
    </table>

    <?php
  }
  if(!empty($_GET["num_pers"])){

    $login = $personneManager->RecupPersLogin($_GET["num_pers"])["per_login"];
    if($salarieManager->EstPresent($_GET["num_pers"])){
      $personneManager->SupprimerPers($_GET["num_pers"],0);
    }
    if($etudiantManager->EstPresent($_GET["num_pers"])){
      $personneManager->SupprimerPers($_GET["num_pers"],1);
    }
    if($_SESSION["Login"] != ""){
      if($login == $_SESSION["Login"]){
        $_SESSION["estConnecte"]= false;
        $_SESSION["Login"] = "";
        header("Location: index.php");

      }else{
        ?>
        <label><img src="image/valid.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "la personne a été supprimé" ?></label>
        <?php

      }
    }else{
      ?>
      <label><img src="image/valid.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "la personne a été supprimé" ?></label>
      <?php

    }

  }
  ?>
