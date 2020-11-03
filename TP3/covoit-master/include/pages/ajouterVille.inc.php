
<h1>Ajouter une ville</h1>

<form action ="#" method = "post" id = "AjouterVille">
    <?php if (empty ($_POST["vil_nom"]))  { ?>
      Nom : <input type="text" id="vil_nom" name="vil_nom">
      <input type="submit" id="Valider" value="Valider">
    <?php } ?>
</form>

<?php if (!empty ($_POST["vil_nom"]))  {
  $db=new Mypdo();
  $villeManager = new VilleManager($db);
  $ville = new Ville($_POST);
  $retour=$villeManager->add($ville);
  echo "la ville \"".$_POST["vil_nom"]."\" a été ajoutée";
   } ?>
