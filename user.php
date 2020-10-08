<?php

include "header.php";



if ($_POST) {

    @$nom = htmlspecialchars($_POST["nom"]);
    @$prenom = htmlspecialchars($_POST["prenom"]);
    @$adresse = htmlspecialchars($_POST["adresse"]);
    @$login = htmlspecialchars($_POST["login"]);
    @$passe = htmlspecialchars($_POST["passe"]);
    @$connexion = htmlspecialchars($_POST["creer"]);
    @$passe_hash =  decrypt($passe);
    @$doublon = doublon_user($login);

    if ($connexion) {

        if ($login == $doublon) {
            echo "Utilisateur déjà existant !";
        } else {
            insert_user($nom, $prenom, $adresse, $login, $passe_hash);
            echo "Utilisateur enregistré !";
        }
    }
}

?>



<div class="container">
    <h1>Créer votre compte</h1>

    <form class="form-login" action="user.php" method="post">

        <label for="">Votre Nom</label><br>
        <input type="text" class="form-control" name="nom" value="" required><br>

        <label for="">Votre Prénom</label><br>
        <input type="text" class="form-control" name="prenom" value="" required><br>

        <label for="">Votre adresse</label><br>
        <input type="text" class="form-control" name="adresse" value="" required><br>

        <label for="">Adresse Mail</label><br>
        <input type="text" class="form-control" name="login" value="" required><br>

        <label for="">Votre Mot de passe</label><br>
        <input type="password" class="form-control" name="passe" value="" required><br><br>

        <input type="submit" class="btn btn-info" name="creer" value="Créer mon compte">


    </form>
</div>
<a href="kill.php">Session</a>
<?php
include "footer.php";
?>