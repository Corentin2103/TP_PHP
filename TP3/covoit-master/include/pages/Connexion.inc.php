

<?php

$_SESSION["Login"] = "";
$db = new MyPdo();
$personneManager = new PersonneManager($db);

if(!empty($_POST["per_login"]) && !empty($_POST["per_pwd"]) && !empty($_POST["validation"])
    &&  $_POST["validation"]==$_SESSION['result'] && $personneManager->EstPresent($_POST["per_login"],$_POST["per_pwd"])){
  $_SESSION["estConnecte"]= true;
  $_SESSION["Login"] = $_POST["per_login"];
  header("Location: index.php");
}


//MESSAGE D'ERREUR
if(empty($_POST["per_login"]) && !empty($_POST["per_pwd"]) && !empty($_POST["validation"]) &&  $_POST["validation"]==$_SESSION['result']){
  echo "T'as oublié ton Login jeune Padawan";
}
if(!empty($_POST["per_login"]) && empty($_POST["per_pwd"]) && !empty($_POST["validation"]) &&  $_POST["validation"]==$_SESSION['result']){
  echo "T'as oublié ton mot de passe jeune Padawan";
}
if(empty($_POST["per_login"]) && empty($_POST["per_pwd"]) && !empty($_POST["validation"]) &&  $_POST["validation"]==$_SESSION['result']){
  echo "Bravo tu es fort en maths mais tu as oublier ton login et ton mot de passe";
}
if(!empty($_POST["per_login"]) && !empty($_POST["per_pwd"]) && !empty($_POST["validation"]) &&  $_POST["validation"]!=$_SESSION['result']){
  echo "Pas de chance, tout le monde sait que ".$_SESSION["aleatoire1"]."+".$_SESSION["aleatoire2"]." ne fait pas ".$_POST["validation"]." mais bien ".$_SESSION['result'];
}



//AFFICHAGE SE CONNECTER
if (empty($_POST["per_login"]) && empty($_POST["per_pwd"]) && empty($_POST["validation"]) ){
?>
<h1>Pour vous connecter</h1>
<form action ="" method = "post" id = "AjouterVille">

      Nom d'utilisateur : <input type="text" id="per_login" name="per_login">
      Mot de passe : <input type="password" id="per_pwd" name="per_pwd">
      <?php
      $_SESSION["aleatoire2"] = rand(1, 9);
      $_SESSION["aleatoire1"] = rand(1, 9);
      $_SESSION["result"] = $_SESSION["aleatoire2"]+$_SESSION["aleatoire1"];

      ?>
      <img src="image/nb/<?php echo $_SESSION["aleatoire1"] ?>.jpg" alt="" />+
      <img src="image/nb/<?php echo $_SESSION["aleatoire2"] ?>.jpg" alt="" />=
      <input type="text" id="validation" name="validation">
      <input type="submit" id="Valider" value="Valider">

</form>
<?php }

?>
