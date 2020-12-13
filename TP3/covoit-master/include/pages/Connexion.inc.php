

<?php

$_SESSION["Login"] = "";
$db = new MyPdo();
$personneManager = new PersonneManager($db);

if(!empty($_POST["per_login"]) && !empty($_POST["per_pwd"]) && !empty($_POST["validation"])
    &&  $_POST["validation"]==$_SESSION['result']
    && $personneManager->EstPresent($_POST["per_login"],$_POST["per_pwd"])){
  $_SESSION["estConnecte"]= true;
  $_SESSION["Login"] = $_POST["per_login"];
  header("Location: index.php");
}
if(!empty($_POST["per_login"]) && !empty($_POST["per_pwd"]) && !empty($_POST["validation"])
    &&  $_POST["validation"]==$_SESSION['result'] && !$personneManager->EstPresent($_POST["per_login"],$_POST["per_pwd"])){?>
      <label>Mot de passe ou login incorrect</label>
  <?php
}

//MESSAGE D'ERREUR
if(empty($_POST["per_login"]) && !empty($_POST["per_pwd"]) && !empty($_POST["validation"]) &&  $_POST["validation"]==$_SESSION['result']){?>
  <label><img src="image/erreur.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "T'as oublié ton Login jeune Padawan"?> </label>
  <?php
}
if(!empty($_POST["per_login"]) && empty($_POST["per_pwd"]) && !empty($_POST["validation"]) &&  $_POST["validation"]==$_SESSION['result']){?>
  <label><img src="image/erreur.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "T'as oublié ton mot de passe jeune Padawan"?> </label>
  <?php

}
if(empty($_POST["per_login"]) && empty($_POST["per_pwd"]) && !empty($_POST["validation"]) &&  $_POST["validation"]==$_SESSION['result']){?>
  <label><img src="image/erreur.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "Bravo tu es fort en maths mais tu as oublier ton login et ton mot de passe"?> </label>
  <?php

}
if(!empty($_POST["per_login"]) && !empty($_POST["per_pwd"]) && !empty($_POST["validation"]) &&  $_POST["validation"]!=$_SESSION['result']){?>
  <label><img src="image/erreur.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "Pas de chance, tout le monde sait que ".$_SESSION["aleatoire1"]."+".$_SESSION["aleatoire2"]." ne fait pas ".$_POST["validation"]." mais bien ".$_SESSION['result']?> </label>
  <?php

}

if(empty($_POST["per_login"]) && !empty($_POST["per_pwd"]) && empty($_POST["validation"])){?>
  <label><img src="image/erreur.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "Il faut remplir tous les champs"?> </label>
  <?php

}
if(!empty($_POST["per_login"]) && empty($_POST["per_pwd"]) && empty($_POST["validation"])){?>
  <label><img src="image/erreur.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "Il faut remplir tous les champs"?> </label>
  <?php

}
if(!empty($_POST["per_login"]) && !empty($_POST["per_pwd"]) && empty($_POST["validation"])){?>
  <label><img src="image/erreur.png" alt="Logo covoiturage IUT" title="Logo covoiturage IUT Limousin" /><?php echo "Je sais que les maths c'est difficile mais fait un petit effort quand même"?> </label>
  <?php

}

//AFFICHAGE SE CONNECTER
if (empty($_POST["per_login"]) && empty($_POST["per_pwd"]) && empty($_POST["validation"]) ){
?>
<h1>Pour vous connecter</h1>
<form action ="" method = "post" id = "AjouterVille">

      <label>Nom d'utilisateur :<br/> </label><input type="text" id="input" name="per_login"><br/>
      <label>Mot de passe :<br/> </label><input type="password" id="input" name="per_pwd"><br/>
      <?php
      $_SESSION["aleatoire2"] = rand(1, 9);
      $_SESSION["aleatoire1"] = rand(1, 9);
      $_SESSION["result"] = $_SESSION["aleatoire2"]+$_SESSION["aleatoire1"];

      ?>
      <img src="image/nb/<?php echo $_SESSION["aleatoire1"] ?>.jpg" alt="" /><label id="Police">+</label>
      <img src="image/nb/<?php echo $_SESSION["aleatoire2"] ?>.jpg" alt="" /><label id="Police">=</label><br/>
      <input type="text" id="input" name="validation"><br/>
      <input type="submit" id="Valider" value="Valider">

</form>
<?php }

?>
