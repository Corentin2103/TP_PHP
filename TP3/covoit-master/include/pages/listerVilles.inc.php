
<?php
  $db = new MyPdo();
  $villeManager = new VilleManager($db);
  $listeVille = $villeManager -> getAllVille();
  $compteur = $villeManager -> getVilleRentree();
?>
<h1>Lister des villes</h1>

<?php
echo "Actuellement ".$compteur." ville(s) sont enregistrée(s)"
 ?>
  <table>
		<tr><th>Numéro</th><th>Nom</th>
	<?php
		foreach ($listeVille as $ville){
  ?>
			<tr><td><?php echo $ville->getVilleNum();?>
			</td><td><?php echo $ville->getVilleNom();?>
			</td></tr>
		<?php } ?>
		</table>
