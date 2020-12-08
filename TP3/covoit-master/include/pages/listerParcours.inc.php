
<h1>Liste des parcours proposés</h1>
<?php
  $db = new MyPdo();
  $parcoursManager = new ParcoursManager($db);
  $listeParcours = $parcoursManager -> getAllParcours();
  

?>
<?php
echo "Actuellement ".count($listeParcours)." parcour(s) enregistré(s)"
 ?>

 <table>
   <tr><th>Numéro</th><th>Nom Ville</th><th>Nom Ville</th><th>Nombre de Km</th>
 <?php
   foreach ($listeParcours as $parcours){
 ?>
     <tr><td><?php echo $parcours->par_num;?>
     </td><td><?php echo $parcours->vil_nom1;?>
     </td><td><?php echo $parcours->vil_nom2;?>
     </td><td><?php echo $parcours->par_km;?>
     </td></tr>
   <?php } ?>
   </table>
