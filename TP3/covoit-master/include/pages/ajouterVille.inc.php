<?php
$db=new Mypdo();
$villeManager = new VilleManager($db);
?>
<h1>Ajouter une ville</h1>

<form action ="#" method = "post" id = "AjouterVille">
    <?php if (empty ($_POST["vil_nom"]))  { ?>
      <label>Nom : </label><input type="text" id="input2" name="vil_nom">
      <input type="submit" id="Valider" value="Valider">
    <?php } ?>
</form>

<?php
if(!empty ($_POST["vil_nom"]) && $villeManager->estPresent($_POST["vil_nom"])){ ?>
  <label>ville déjà rentrée</label>
  <?php
}

if (!empty ($_POST["vil_nom"]) && !$villeManager->estPresent($_POST["vil_nom"]))  {


  $ville = new Ville($_POST);
  $retour=$villeManager->add($ville);
  ?>
  <label> <img src="image/valid.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "la ville \"".$_POST["vil_nom"]."\" a été ajoutée"; ?></label>
  <?php
   }


   ?>
