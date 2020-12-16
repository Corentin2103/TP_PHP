

<?php
$db = new MyPdo();
$villeManager = new VilleManager($db);
$listeVille = $villeManager -> getAllVille();
$db=new Mypdo();
$parcoursManager = new ParcoursManager($db);

/*Affichage du formulaire*/
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


        <label>Nombre de kilomètre(s) :</label> <input type="number" id="input2" name="par_km" required></br>
        <input type="submit" id="Valider" value="Valider">

      </form>
      <?php
    }
    /*Gestion des erreurs et des de l'ajout à la base*/
    if(!(empty($_POST["par_km"]))){?>
      <h1>Ajouter un parcours</h1>
      <?php

      if($_POST["vil_num1"] == $_POST["vil_num2"]){ ?>

        <label><?php echo "les villes doivent être différente"  ?></label></br>
        <?php
      }
      if($_POST["par_km"] <= 0){ ?>

        <label><?php echo "Nombre de km doit être supérieur à 0"  ?></label></br>
        <?php
      }
      if($parcoursManager->estPresent($_POST["vil_num1"],$_POST["vil_num2"]) && $_POST["vil_num1"] != $_POST["vil_num2"]){
        ?><label><img src="image/erreur.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "Parcours déjà rentré" ?></label><?php
      }

      if($_POST["vil_num1"] != $_POST["vil_num2"] && $_POST["par_km"] > 0 && !$parcoursManager->estPresent($_POST["vil_num1"],$_POST["vil_num2"])){

        $parcours = new Parcours($_POST);
        $retour=$parcoursManager->add($parcours);?>
        <label><img src="image/valid.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "le parcours a été ajouté" ?></label>
        <?php
      }
    }


    ?>
