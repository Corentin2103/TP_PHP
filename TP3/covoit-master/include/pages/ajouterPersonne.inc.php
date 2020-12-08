  <?php
  $db = new MyPdo();
  $divisionManager = new DivisionManager($db);
  $listeDiv = $divisionManager -> getAllDiv();
  $departementManager = new DepartementManager($db);
  $listeDep = $departementManager -> getAllDep();
  $fonctionManager = new FonctionManager($db);
  $listeFon = $fonctionManager -> getAllFonction();
  $villeManager = new VilleManager($db);
  ?>

  <?php
  if (empty ($_POST["per_nom"]) || empty ($_POST["per_prenom"]) || empty ($_POST["per_tel"]) || empty ($_POST["per_mail"])
  || empty ($_POST["per_login"]) || empty ($_POST["per_pwd"]) || empty($_POST["annee"])
  || empty($_POST["departement"]) || empty($_POST["fon_num"])
  || empty($_POST["sal_telprof"]))
  {
   ?>
     <h1>Ajouter une personne</h1>
     <form action ="#" method = "post" id = "AjouterPersonne">
       <div id="float">
          <label><span id="ranger">Nom :</span></label><input type="text" id="input" name="per_nom">
          <label id="milieu4"><span id="ranger">Prenom :</span></label> <input type="text" id="input" name="per_prenom"></br>
          <label><span id="ranger">Téléphone :</span></label> <input type="tel" id="input" name="per_tel">
          <label id="milieu4"><span id="ranger">Mail :</span></label><input type="Mail" id="input" name="per_mail"></br>
          <label><span id="ranger">Login :</span></label><input type="text" id="input" name="per_login">
          <label id="milieu4"><span id="ranger">Mot de passe :</span></label><input type="password" id="input" name="per_pwd"></br>
          <label id="milieu">Catégorie :</label> <input type="radio" name="Categorie" id="Etu" value="Etu" /> <label  id="">Etudiant</label>
                      <input type="radio" name="Categorie" id="Perso" value="Perso" /> <label id="">Personnel</label></br>
          <div id="milieu2">
          <input type="submit" id="Valider" value="Valider">
          </div>
        </div>
    </form>
  <?php


  }
  ?>
<?php
  /*Ajouter un etudiant*/
?>
  <?php
  if (!empty($_POST["Categorie"]) && $_POST["Categorie"] == "Etu" && empty($_POST["departement"]) && empty($_POST["annee"]) && !empty ($_POST["per_nom"]) && !empty ($_POST["per_prenom"])
  && !empty ($_POST["per_tel"]) && !empty ($_POST["per_mail"])
  && !empty ($_POST["per_login"]) && !empty ($_POST["per_pwd"]))
  {
    $personne = new Personne($_POST);
    $_SESSION["personne"]=serialize($personne);

    ?>
    <h1>Ajouter un étudiant</h1>

    <form action ="#" method = "post" id = "FormEtudiant">
    <label>Année :</label>
        <select class="champ" id="input" name="annee" >
          <?php
          foreach ($listeDiv as $div)
          {

            ?>
                    <option value="<?php echo $div->getDivNum() ?>">
                                   <?php echo $div->getDivNom() ?></option>
          <?php
          } ?>
        </select></br>

    <label>Département :</label>
        <select class="champ" id="input" name="departement" >
          <?php foreach ($listeDep as $departement)
          { ?>
                    <option value="<?php echo $departement->getDepNum() ?>">
                                   <?php echo $departement->getDepNom()." (".$villeManager->getVilleNom($departement->getVilleNum())["vil_nom"].")" ?></option>
          <?php
          } ?>
            </select></br>
      <input type="submit" id="Valider" value="Valider">
  </form>
  <?php
  }

  ?>

<?php
  /*Ajouter un personnel*/
  ?>
  <?php
  if (!empty($_POST["Categorie"]) && $_POST["Categorie"] == "Perso" && empty($_POST["sal_telprof"]) && empty($_POST["fon_num"]) && !empty ($_POST["per_nom"]) && !empty ($_POST["per_prenom"])
  && !empty ($_POST["per_tel"]) && !empty ($_POST["per_mail"])
  && !empty ($_POST["per_login"]) && !empty ($_POST["per_pwd"]))
  {
    $personne = new Personne($_POST);
    $_SESSION["personne"]=serialize($personne);

    ?>
    <h1>Ajouter un salarié</h1>

    <form action ="#" method = "post" id = "FormSalarie">
    <label>Téléphone professionnel :</label>

          <input type="tel" id="input" name="sal_telprof">
        </br>

    <label>Fonction :</label>
        <select class="champ" id="input" name="fon_num" >
          <?php foreach ($listeFon as $fonction)
          { ?>
                    <option value="<?php echo $fonction->getFonNum() ?>">
                                   <?php echo $fonction->getFonLibelle() ?></option>
          <?php
          } ?>
            </select></br>
      <input type="submit" id="Valider" value="Valider">
  </form>
  <?php
  }

  ?>


  <?php



        if ((!empty($_POST["annee"]) && !empty($_POST["departement"]))||(!empty($_POST["fon_num"]) && !empty($_POST["sal_telprof"])))
        {
          $personne = unserialize($_SESSION["personne"]);
          $personneManager = new PersonneManager($db);
          $num_pers=$personneManager->add($personne);
            if (!empty($_POST["annee"]) && !empty($_POST["departement"])){
              $etudiantManager = new EtudiantManager($db);
              $etudiant = new Etudiant($_POST);
              $etudiant->setPersNum($num_pers);
              $etudiant->setDivNum($_POST["annee"]);
              $etudiant->setDepNum($_POST["departement"]);
              ?>
              <label><img src="image/valid.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "la personne a été ajoutée" ?></label>

              <?php
              $retour=$etudiantManager->add($etudiant);
            }
            if (!empty($_POST["fon_num"]) && !empty($_POST["sal_telprof"])){
              $salarieManager = new SalarieManager($db);
              $salarie = new Salarie($_POST);
              $salarie->setPersNum($num_pers);
              $salarie->setSalTelProf($_POST["sal_telprof"]);
              $salarie->setFonNum($_POST["fon_num"]);
              ?>
              <label><img src="image/valid.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "la personne a été ajoutée" ?></label>

              <?php
              $retour=$salarieManager->add($salarie);
            }


        }
      ?>
