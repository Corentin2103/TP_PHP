
<h1>Rechercher un trajet</h1>
<?php
$db = new MyPdo();
$proposeManager = new ProposeManager($db);
$listeVilleNum = $proposeManager->getAllVilleDepart();
$villeManager = new VilleManager($db);

if(empty($_POST["vil_num1"])&& empty($_POST["vil_num2"])&& empty($_POST["DateDep"])&& empty($_POST["Precision"])&& empty($_POST["APartirDe"])){
?>
<form action ="#" method = "post" id = "FormTrajet">
  <label>Ville de départ :</label></br>
  <select class="champ" id="input" name="vil_num1" >
    <option value="">Choisissez</option>
    <?php foreach ($listeVilleNum as $ville){ ?>

              <option value="<?php echo $ville["vil_num"] ?>">
                             <?php echo $villeManager->getVilleNom($ville["vil_num"])["vil_nom"] ?></option>
    <?php } ?>
  </select></br>
  <input type="submit" id="Valider" value="Valider">
</form>
<?php
}
?>
