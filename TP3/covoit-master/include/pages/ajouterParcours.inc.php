

<?php
  $db = new MyPdo();
  $villeManager = new VilleManager($db);
  $listeVille = $villeManager -> getAllVille();
  $db=new Mypdo();
  $parcoursManager = new ParcoursManager($db);


if(empty($_POST["par_km"]) && empty($_POST["vil_num1"]) && empty($_POST["vil_num2"])) {
  ?>

  <h1>Ajouter un parcours</h1>
  <form action ="#" method = "post" id = "FormParcours">
      <label>Ville 1 :</label>
          <select class="champ" id="input2" name="vil_num1" >
            <?php foreach ($listeVille as $ville){ ?>
                      <option value="<?php echo $ville->getVilleNum() ?>">
          						               <?php echo $ville->getVilleNom() ?></option>
            <?php } ?>
          </select>

      <label>Ville 2 :</label>
          <select class="champ" id="input2" name="vil_num2" >
            <?php foreach ($listeVille as $ville){ ?>
                      <option value="<?php echo $ville->getVilleNum() ?>">
          						               <?php echo $ville->getVilleNom() ?></option>
            <?php } ?>
          </select>


            <label>Nombre de kilomètre(s) :</label> <input type="number" id="input2" name="par_km"></br>
            <input type="submit" id="Valider" value="Valider">

  </form>
  <?php
  }
  if(!(empty($_POST["par_km"])) && $_POST["vil_num1"] != $_POST["vil_num2"] && $_POST["par_km"]>= 0){?>
    <h1>Ajouter un parcours</h1>
    <?php

    if($parcoursManager->estPresent($_POST["vil_num1"],$_POST["vil_num2"])){
    ?><label><img src="image/erreur.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "Parcours déjà rentré" ?></label><?php
        }
        else{

          $parcours = new Parcours($_POST);
          $retour=$parcoursManager->add($parcours);?>
          <label><img src="image/valid.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "le parcours a été ajouté" ?></label>
        <?php
      }
  }

?>
