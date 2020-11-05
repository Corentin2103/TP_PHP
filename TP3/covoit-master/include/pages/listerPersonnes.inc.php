
<h1>Liste des personnes enregistrées</h1>
<?php
  $db = new MyPdo();
  $personneManager = new PersonneManager($db);
  $listePers = $personneManager -> getAllPers();
  $compteur = $personneManager -> getPersRentree();

?>
<?php
echo "Actuellement ".$compteur." personne(s) enregistrée(s)"
 ?>

 <table>
   <tr><th>Numéro</th><th>Nom</th><th>Prenom</th>
 <?php
   foreach ($listePers as $personne){
 ?>
     <tr><td><?php echo $personne->getPersNum();?>
     </td><td><?php echo $personne->getPersNom();?>
     </td><td><?php echo $personne->getPersPrenom();?>
     </td></tr>
   <?php } ?>
   </table>
