<?php
$db = new MyPdo();
$villeManager = new VilleManager($db);
$listeVille = $villeManager -> getVille1Parcours();

?>
<h1>Proposer un trajet</h1>
<?php
if(empty($_POST["vil_num1"])&& empty($_POST["vil_num2"])&& empty($_POST["DateDep"])&& empty($_POST["HeureDep"])&& empty($_POST["NbrPlaces"])){
?>
<form action ="#" method = "post" id = "FormTrajet">
  Ville de départ :</br>
  <select class="champ" id="vil_num1" name="vil_num1" >
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
    Ville de départ : <?php echo $villeManager->getVilleNom($_POST["vil_num1"])["vil_nom"] ?>
    Ville d'arrivée :
    <select class="champ" id="vil_num2" name="vil_num2" >
      <option value="">Choisissez</option>
      <?php foreach ($listeVille2 as $ville){ ?>

                <option value="<?php echo $ville["vil_num"] ?>">
                               <?php echo $ville["vil_nom"] ?></option>

      <?php } ?>
    </select></br>
    Date de départ : <input type="datetime" id="DateDep" name="DateDep" value="<?php echo date('d/m/Y'); ?>">

    Heure de départ : <input type="datetime" id="HeureDep" name="HeureDep" value="<?php echo date('H:i:s'); ?>"></br>
    Nombre de places :<input type="text" id="NbrPlaces" name="NbrPlaces"></br>
    <input type="submit" id="Valider" value="Valider">
</form>
<?php
}
if(!empty($_POST["vil_num2"])&& !empty($_POST["DateDep"])&& !empty($_POST["HeureDep"])&& !empty($_POST["NbrPlaces"])){
   $personneManager = new PersonneManager($db);
   $proposeManager = new ProposeManager($db);
   $parcoursManager = new ParcoursManager($db);
   $propose = new Propose($_POST);
   $sens = $parcoursManager->getSens($_SESSION["vil_num1"],$_POST["vil_num2"]);
   $par_num = $parcoursManager->getParcours($_SESSION["vil_num1"],$sens)["par_num"];
   $propose->setProSens($sens);
   $propose->setParNum($par_num);
   $propose->setPerNum($personneManager->RecupPersNum($_SESSION["Login"])["per_num"]);
   $propose->setProDate(getEnglishDate($_POST["DateDep"]));
   $propose->setProTime(getEnglishDate($_POST["HeureDep"]));
   $propose->setProSens(getEnglishDate($_POST["NbrPlaces"]));
   $retour=$proposeManager->add($propose);
}
?>
