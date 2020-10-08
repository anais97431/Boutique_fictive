<?php
include "header.php";



$id_user = $_SESSION["id_user"];
@$update_password = htmlspecialchars($_POST["update_password"]);
@$update_user = htmlspecialchars($_POST["update_compte"]);
@$old_password = htmlspecialchars($_POST["old_password"]);
@$new_password = htmlspecialchars($_POST["new_password"]);
@$name = htmlspecialchars($_POST["prenom2"]);
@$last_name = htmlspecialchars($_POST["nom2"]);
@$adress = htmlspecialchars($_POST["adresse2"]);
@$login = htmlspecialchars($_POST["login2"]);




if ($update_user) {
    update_user($name, $last_name, $adress, $login, $id_user);
}

if ($update_password) {
    update_password($old_password, $new_password, $id_user);
}


$select_user = recup_user($id_user);
// var_dump($select_user);
?>
<div class="row compte">
<!-- <div class="row compte"> -->

    <div class="col-md-3 offset-1 form1">

        



            <label for="" class="label1_entete"> Votre compte : </label>
            <form class="form-login">

                <label for="" class="label1">Nom : </label><br>
                <input type="text" class="form-control" name="nom" value="<?php echo $select_user->last_name ?>"
                    disabled><br>

                <label for="" class="label1">Prénom : </label><br>
                <input type="text" class="form-control" name="prenom" value="<?php echo $select_user->name ?>"
                    disabled><br>

                <label for="" class="label1">Adresse : </label><br>
                <input type="text" class="form-control" name="adresse" value="<?php echo $select_user->adress ?>"
                    disabled><br>

                <label for="" class="label1">Adresse Mail : </label><br>
                <input type="text" class="form-control" name="login" value="<?php echo $select_user->login ?>"
                    disabled><br>
            </form>
        </div>
   


    <div class="col-md-3 offset-1 form2">
        
            <label for="" class="label2_entete"> Modification de votre compte :</label>

            <form class="form-login" action="compte.php" method="post">

                <label for="" class="label2">Nom : </label><br>
                <input type=" text" class="form-control input" name="nom2"
                    value="<?php echo $select_user->last_name ?>"><br>

                <label for="" class="label2">Prénom :</label><br>
                <input type=" text" class="form-control input" name="prenom2"
                    value="<?php echo $select_user->name ?>"><br>

                <label for="" class="label2">Adresse :</label><br>
                <input type=" text" class="form-control input" name="adresse2"
                    value="<?php echo $select_user->adress ?>"><br>

                <label for="" class="label2">Adresse Mail :</label><br>
                <input type=" text" class="form-control input" name="login2"
                    value="<?php echo $select_user->login ?>"><br>

                <input type="submit" class="btn btn-info" name="update_compte" value="Modifier cordonnées">
            </form>
       
    </div>


    <div class="col-md-3 offset-1 form1">

       



            <label for="" class="label1_entete"> Mot de passe : </label>
            <form class="form-login" action="compte.php" method="post">

                <label for="" class="label1">Ancien mot de passe : </label><br>
                <input type="password" class="form-control" name="old_password" value="" required><br>

                <label for="" class="label1">Nouveau mot de passe : </label><br>
                <input type="password" class="form-control" name="new_password" value="" required><br>

                <input type="submit" class="btn btn-info" name="update_password" value="Modifier mot de passe">
            </form>
        </div>
    <!-- </div> -->
</div>

<?php
include "footer.php";
?>