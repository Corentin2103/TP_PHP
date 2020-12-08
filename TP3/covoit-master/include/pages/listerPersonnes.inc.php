

  <?php
    $db = new MyPdo();
    $personneManager = new PersonneManager($db);
    $listePers = $personneManager -> getAllPers();

    $salarieManager = new SalarieManager($db);
    $etudiantManager = new EtudiantManager($db);
    $fonctionManager = new FonctionManager($db);
    $departementManager = new DepartementManager($db);
    $villeManager = new VilleManager($db);
  ?>



  <?php
  if(empty($_GET["num_pers"])){ ?>
    <h1>Liste des personnes enregistrées</h1>
    <?php
  echo "Actuellement ".count($listePers)." personne(s) enregistrée(s)"
   ?>

   <table>
     <tr><th>Numéro</th><th>Nom</th><th>Prenom</th>
   <?php
     foreach ($listePers as $personne){
   ?>
       <tr><td>
         <a href="index.php?page=2&num_pers=<?php echo $personne->getPersNum() ?>"><?php echo $personne->getPersNum();?></a>
       </td><td><?php echo $personne->getPersNom();?>
       </td><td><?php echo $personne->getPersPrenom();?>
       </td></tr>
     <?php } ?>
     </table>

  <?php



  }else {
        if ($salarieManager->EstPresent($_GET["num_pers"])){
          $listeSal = $salarieManager->getAllSal();
          $recupPers = $personneManager->RecupPers($_GET["num_pers"]);
          $recupSal = $salarieManager->RecupSalarie($_GET["num_pers"]);
          foreach($recupPers as $personne){
  ?>
          <h1>Détail sur le salarié <?php echo $personne["per_nom"] ?> </h1>
          <table>
            <tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Tel pro</th><th>Fonction</th>

              <tr><td>
                <?php
                  echo $personne["per_prenom"];
                ?>
              </td><td>
                <?php
                echo $personne["per_mail"];
                ?>
              </td><td>
                <?php
                 echo $personne["per_tel"];
               }
                 ?>
              <?php foreach($recupSal as $salarie){ ?>
               </td><td>
                <?php
                 echo $salarie["sal_telprof"];

                ?>
                </td><td>
                <?php
                 echo $fonctionManager->getRecupFonctionLibelle($salarie["fon_num"])["fon_libelle"];
                }
                ?>

              </td></tr>
         </table>
      <?php
        }
    if ($etudiantManager->EstPresent($_GET["num_pers"])){

      $recupPers = $personneManager->RecupPers($_GET["num_pers"]);
      $recupEtu = $etudiantManager->RecupEtudiant($_GET["num_pers"]);
      foreach($recupPers as $personne){
      ?>
      <h1>Détail sur l'étudiant <?php echo $personne["per_nom"] ?> </h1>
      <table>

        <tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Département</th><th>Ville</th>
          <tr><td>
            <?php
              echo $personne["per_prenom"];
            ?>
          </td><td>
            <?php
            echo $personne["per_mail"];
            ?>
          </td><td>
            <?php
             echo $personne["per_tel"];
           }
             ?>

           </td><td>
            <?php
             echo $departementManager->getDepartementNom($recupEtu["dep_num"])["dep_nom"];


            ?>
            </td><td>
            <?php
             echo  $villeManager->getVilleNom($departementManager->getVilleNumDep($recupEtu["dep_num"])["vil_num"])["vil_nom"];

            ?>

          </td></tr>
     </table>
     <?php
    }


  }
?>
