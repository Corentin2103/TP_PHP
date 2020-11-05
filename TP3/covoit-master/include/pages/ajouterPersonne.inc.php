<?php
$db = new MyPdo();
$divisionManager = new DivisionManager($db);
$listeDiv = $divisionManager -> getAllDiv();
$departementManager = new DepartementManager($db);
$listeDep = $departementManager -> getAllDep();
?>

<?php
if (empty ($_POST["per_nom"]) && empty ($_POST["per_prenom"]) && empty ($_POST["per_tel"]) && empty ($_POST["per_mail"])
&& empty ($_POST["per_login"]) && empty ($_POST["per_pwd"]) && empty($_POST["Categorie"]) && empty($_POST["annee"])
&& empty($_POST["departement"]))
{
 ?>
   <h1>Ajouter une personne</h1>
   <form action ="#" method = "post" id = "AjouterPersonne">

        Nom : <input type="text" id="per_nom" name="per_nom">
        Prenom : <input type="text" id="per_prenom" name="per_prenom"></br>
        Téléphone : <input type="tel" id="per_tel" name="per_tel">
        Mail : <input type="Mail" id="per_mail" name="per_mail"></br>
        Login : <input type="text" id="per_login" name="per_login">
        Mot de passe : <input type="password" id="per_pwd" name="per_pwd"></br>
        catégorie : <input type="radio" name="Categorie" id="Etudiant" value="Etu" /> Etudiant
                    <input type="radio" name="Categorie" id="Personnel" value="Perso" /> Personnel</br>
        <input type="submit" id="Valider" value="Valider">

  </form>
<?php
}
?>
<?php
/*Ajouter un etudiant*/
?>
<?php
if (!empty($_POST["Categorie"]) && $_POST["Categorie"] == "Etu" && empty($_POST["departement"]) && empty($_POST["annee"]))
{ ?>
  <h1>Ajouter un étudiant</h1>
  <form action ="#" method = "post" id = "FormEtudiant">
  <label>Année :</label>
      <select class="champ" id="annee" name="annee" >
        <?php foreach ($listeDiv as $div)
        { ?>
                  <option value="<?php echo $div->getDivNum() ?>">
                                 <?php echo $div->getDivNom() ?></option>
        <?php
        } ?>
      </select></br>

  <label>Département :</label>
      <select class="champ" id="departement" name="departement" >
        <?php foreach ($listeDep as $departement)
        { ?>
                  <option value="<?php echo $departement->getDepNum() ?>">
                                 <?php echo $departement->getDepNom() ?></option>
        <?php
        } ?>
          </select></br>
    <input type="submit" id="Valider" value="Valider">
</form>
<?php
}
?>

<?php
/*Ajouter un personnel*/
?>
<?php
if (!empty($_POST["Categorie"]) && $_POST["Categorie"] == "Perso")
{?>
  <h1>Ajouter un salarié</h1>
<?php
}
?>


<?php
if (!empty($_POST["departement"]) && !empty($_POST["annee"]))
{
  echo "TEST";
}



      if (!empty ($_POST["per_nom"]) && !empty ($_POST["per_prenom"]) && !empty ($_POST["per_tel"]) && !empty ($_POST["per_mail"])
      && !empty ($_POST["per_login"]) && !empty ($_POST["per_pwd"]) && !empty($_POST["Categorie"]))
      {
        $personneManager = new PersonneManager($db);
        $personne = new Personne($_POST);
        $retour=$personneManager->add($personne);

      }
