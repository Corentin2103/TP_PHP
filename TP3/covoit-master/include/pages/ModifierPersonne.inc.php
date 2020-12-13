<?php
  $db = new MyPdo();
  $personneManager = new PersonneManager($db);
  $listePers = $personneManager -> getAllPers();

  $salarieManager = new SalarieManager($db);
  $etudiantManager = new EtudiantManager($db);
  $fonctionManager = new FonctionManager($db);
  $departementManager = new DepartementManager($db);
  $villeManager = new VilleManager($db);

  if(empty($_GET["num_pers"])){


?>

<h1>Liste des personnes enregistrées</h1>
<?php
echo "Actuellement ".count($listePers)." personne(s) enregistrée(s)"
?>

<table>
 <tr><th>Numéro</th><th>Nom</th><th>Prenom</th>
<?php
 foreach ($listePers as $personne){
?>
   <tr><td><?php echo $personne->getPersNum();?>
   </td><td><?php echo $personne->getPersNom();?>
   </td><td><?php echo $personne->getPersPrenom();?>
   </td><td><a href="index.php?page=3&num_pers=<?php echo $personne->getPersNum() ?>">modifier</a>
   </td></tr>
 <?php } ?>
 </table>

 <?php
   }
if(!empty($_GET["num_pers"])){?>
  <h1> Modifier personne</h1>
  <form action ="#" method = "post" id = "AjouterPersonne">
    <div id="float">
       <label><span id="ranger">Nom :</span></label><input type="text" id="input" name="per_nom">
       <label id="milieu4"><span id="ranger">Prenom :</span></label> <input type="text" id="input" name="per_prenom"></br>
       <label><span id="ranger">Téléphone :</span></label> <input type="tel" id="input" name="per_tel">
       <label id="milieu4"><span id="ranger">Mail :</span></label><input type="Mail" id="input" name="per_mail"></br>
       <label><span id="ranger">Login :</span></label><input type="text" id="input" name="per_login">
       <label id="milieu4"><span id="ranger">Mot de passe :</span></label><input type="password" id="input" name="per_pwd"></br>
       
       <div id="milieu2">
       <input type="submit" id="Valider" value="Valider">
       </div>
     </div>
 </form>
 <?php
}
 ?>
