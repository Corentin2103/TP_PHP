<?php

if($_SESSION["estConnecte"]){
  ?>

  <?php
  $db = new MyPdo();
  $villeManager = new VilleManager($db);
  $listeVille = $villeManager -> getVille1Parcours();
  date_default_timezone_set('Europe/Paris');
  ?>
  <h1>Proposer un trajet</h1>

  <?php
  if(empty($_POST["vil_num1"])&& empty($_POST["vil_num2"])&& empty($_POST["DateDep"])&& empty($_POST["HeureDep"])&& empty($_POST["NbrPlaces"])){
    ?>
    <form action ="#" method = "post" id = "FormTrajet">
      <label>Ville de départ :</label></br>
      <select class="champ" id="input" name="vil_num1" >
        <option value="">Choisissez</option>
        <?php foreach ($listeVille as $ville){ ?>

          <option value="<?php echo $ville["vil_num"] ?>">
            <?php echo $ville["vil_nom"] ?></option>
          <?php } ?>
        </select></br>
        <input type="submit" id="Valider" value="Valider">
      </form>
      <?php
    }
    ?>


    <?php
    if(!empty($_POST["vil_num1"])){
      $listeVille2 = $villeManager -> getVille2Parcours($_POST["vil_num1"]);
      $_SESSION["vil_num1"]= $_POST["vil_num1"];
      ?>
      <form action ="#" method = "post" id = "FormTrajet">
        <div id="float">
          <label><span>Ville de départ : </span><?php echo $villeManager->getVilleNom($_POST["vil_num1"])["vil_nom"] ?></label>
          <label id="milieu3"><span>Ville d'arrivée :</span></label>
          <select class="champ" id="input" name="vil_num2" >
            <option value="">Choisissez</option>
            <?php foreach ($listeVille2 as $ville){ ?>

              <option value="<?php echo $ville["vil_num"] ?>">
                <?php echo $ville["vil_nom"] ?></option>

              <?php } ?>
            </select></br>
            <label><span>Date de départ :</span></label> <input type="date" id="input" name="DateDep" value="<?php echo date('Y-m-d'); ?>">

            <label><span>Heure de départ :</label><input type="datetime" id="input" name="HeureDep" value="<?php echo date('H:i:s'); ?>"></br>
              <label><span>Nombre de places :</span></label><input type="text" id="input" name="NbrPlaces"></br>
              <div id="milieu2">
                <input type="submit" id="Valider" value="Valider">
              </div>
            </div>

          </form>
          <?php
        }


        if(!empty($_POST["vil_num2"])&& !empty($_POST["DateDep"])&& !empty($_POST["HeureDep"])&& !empty($_POST["NbrPlaces"])){
          $personneManager = new PersonneManager($db);
          $proposeManager = new ProposeManager($db);
          $parcoursManager = new ParcoursManager($db);
          $propose = new Propose($_POST);
          $sens = $parcoursManager->getSens($_SESSION["vil_num1"],$_POST["vil_num2"]);
          $par_num = $parcoursManager->getParcours($_SESSION["vil_num1"],$_POST["vil_num2"],$sens)["par_num"];
          $propose->setProSens($sens);
          $propose->setParNum($par_num);
          $propose->setPerNum($personneManager->RecupPersNum($_SESSION["Login"])["per_num"]);
          $propose->setProDate($_POST["DateDep"]);
          $propose->setProTime($_POST["HeureDep"]);
          $propose->setProPlace($_POST["NbrPlaces"]);
          $retour=$proposeManager->add($propose);
          ?>
          <label><img src="image/valid.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "le trajet été ajoutée" ?></label>

          <?php
        }
      }else{
        header("Location: index.php");
      }
      ?>
