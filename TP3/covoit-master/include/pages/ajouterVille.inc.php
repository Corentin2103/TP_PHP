<?php
$db=new Mypdo();
$villeManager = new VilleManager($db);
?>
<h1>Ajouter une ville</h1>

<form action ="#" method = "post" id = "AjouterVille">
    <?php if (empty ($_POST["vil_nom"]))  { ?>
      <label>Nom : </label><input type="text" id="input" name="vil_nom">
      <input type="submit" id="Valider" value="Valider">
    <?php } ?>
</form>

<?php if (!empty ($_POST["vil_nom"]) && !$villeManager->estPresent($_POST["vil_nom"]))  {


  $ville = new Ville($_POST);
  $retour=$villeManager->add($ville);
  echo "la ville \"".$_POST["vil_nom"]."\" a été ajoutée";
   }

if(!empty ($_POST["vil_nom"]) && $villeManager->estPresent($_POST["vil_nom"])){
  echo "ville déjà rentrée";
}
   ?>
