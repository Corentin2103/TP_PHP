
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

              <option value="<?php echo $ville ?>">
                             <?php echo $villeManager->getVilleNom($ville)["vil_nom"] ?></option>
    <?php } ?>
  </select></br>
  <input type="submit" id="Valider" value="Valider">
</form>
<?php
}
if(!empty($_POST["vil_num1"])&& empty($_POST["vil_num2"])&& empty($_POST["DateDep"])&& empty($_POST["Precision"])&& empty($_POST["APartirDe"])){
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

      <label><span>Précision : </label>
      <select class="champ" id="input" name="Precision" >
        <option value="0">Ce jour</option>
        <option value="1">+/- 1 jour</option>
        <option value="2">+/- 2 jour</option>
        <option value="3">+/- 3 jour</option>
      </select></br>
      <label><span>A partir de :</span></label>
      <select class="champ" id="input" name="APartirDe" >
        <?php
        for ($i = 0; $i <24;$i++){ ?>
            <option value="<?php echo $i ?>"><?php echo $i."h" ?></option>

        <?php
        }
        ?>
      </select>
      <div id="milieu2">
        <input type="submit" id="Valider" value="Valider">
        </div>
    </div>

  </form>
  <?php
}
if(empty($_POST["vil_num1"]) && !empty($_POST["vil_num2"])&& !empty($_POST["DateDep"])&& !empty($_POST["Precision"])&& !empty($_POST["APartirDe"])){
  $listeTrajet=$proposeManager->getAllTrajet($_SESSION["vil_num1"],$_POST["vil_num2"]);
  print_r($listeTrajet);
}

?>
