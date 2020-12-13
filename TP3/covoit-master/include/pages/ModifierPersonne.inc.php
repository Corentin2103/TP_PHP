<?php
  $db = new MyPdo();
  $personneManager = new PersonneManager($db);
  $divisionManager = new DivisionManager($db);
  $salarieManager = new SalarieManager($db);
  $etudiantManager = new EtudiantManager($db);
  $fonctionManager = new FonctionManager($db);
  $departementManager = new DepartementManager($db);
  $villeManager = new VilleManager($db);
  $listePers = $personneManager -> getAllPers();
  $listeFon = $fonctionManager -> getAllFonction();
  $listeDep = $departementManager -> getAllDep();
  $listeDiv = $divisionManager -> getAllDiv();
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
if(!empty($_GET["num_pers"])){
$personne = $personneManager->RecupPers($_GET["num_pers"]);
$perlogin = $personneManager->RecupPersLogin($_GET["num_pers"]);
$etudiant = $etudiantManager->RecupEtudiant($_GET["num_pers"]);
print_r($personne);
foreach ($personne as $personne){
  ?>

  <h1> Modifier personne</h1>
  <form action ="#" method = "post" id = "AjouterPersonne">
    <div id="float">
       <label><span id="ranger">Nom :</span></label><input type="text" id="input" name="per_nom" value="<?php echo $personne["per_nom"]?>">
       <label id="milieu4"><span id="ranger">Prenom :</span></label> <input type="text" id="input" name="per_prenom" value="<?php echo $personne["per_prenom"] ?>"></br>
       <label><span id="ranger">Téléphone :</span></label> <input type="tel" id="input" name="per_tel" value="<?php echo $personne["per_tel"] ?>">
       <label id="milieu4"><span id="ranger">Mail :</span></label><input type="Mail" id="input" name="per_mail" value="<?php echo $personne["per_mail"] ?>"></br>
       <label><span id="ranger">Login :</span></label><input type="text" id="input" name="per_login" value="<?php echo $perlogin["per_login"] ?>">
       <label id="milieu4"><span id="ranger">Mot de passe :</span></label><input type="password" id="input" name="per_pwd" ></br>
       <?php
     }
       if($etudiantManager->EstPresent($_GET["num_pers"])){?>
         <form action ="#" method = "post" id = "FormEtudiant">
         <label>Année :</label>
             <select class="champ" id="input" name="annee" >
               <?php

               foreach ($listeDiv as $div)
               {

                 ?>
                         <option value="<?php echo $div->getDivNum() ?>">
                                        <?php echo $div->getDivNom() ?></option>
               <?php
               } ?>
             </select></br>

         <label>Département :</label>
             <select class="champ" id="input" name="departement" >
               <?php foreach ($listeDep as $departement)
               { ?>
                         <option value="<?php echo $departement->getDepNum() ?>">
                                        <?php echo $departement->getDepNom()." (".$villeManager->getVilleNom($departement->getVilleNum())["vil_nom"].")" ?></option>
               <?php
               } ?>
                 </select></br>

       </form>
       <?php
       }
       if($salarieManager->EstPresent($_GET["num_pers"])){?>
         <form action ="#" method = "post" id = "FormSalarie">
         <label>Téléphone professionnel :</label>

               <input type="tel" id="input" name="sal_telprof">
             </br>

         <label>Fonction :</label>
             <select class="champ" id="input" name="fon_num" >
               <?php foreach ($listeFon as $fonction)
               { ?>
                         <option value="<?php echo $fonction->getFonNum() ?>">
                                        <?php echo $fonction->getFonLibelle() ?></option>
               <?php
               } ?>
                 </select></br>

       </form>
         <?php
       }
       ?>
       <div id="milieu2">
       <input type="submit" id="Valider" value="Valider">
       </div>
     </div>
 </form>
 <?php
}
 ?>
