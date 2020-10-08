<?php
include "header.php";

 
$nom = $prenom = $login = $message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $login = $_POST["login"];
    $message = $_POST["message"];
}


    	
	
		

?>

<div class="col-md-5 offset-1 form_contact">
        <div class="container">

        <div>
            <?php if(isset($_GET["captcha"])) if($_GET["captcha"] == "error") echo $_SESSION["captcha_error"];?>
        </div>
            <label for="" class="label_entete"> N'hésitez pas, contactez nous !</label>

            <form id="form_contact" class="form-login" action="phpmailer.php" method="post">

                <label for="" class="label_contact">Nom : </label><br>
                <input type=" text" class="form-control input" name="nom"
                    value=""><br>

                <label for="" class="label_contact">Prénom : </label><br>
                <input type=" text" class="form-control input" name="prenom"
                    value=""><br>

                <label for="" class="label_contact">Adresse Mail : </label><br>
                <input type=" text" class="form-control input" name="login"
                    value=""><br>

                    <label for="" class="label_contact">Tapez votre texte : </label><br>

                    <textarea class="form-control textarea" name="message" id="login" cols="30" rows="10"></textarea><br>
                    <div class="g-recaptcha" data-sitekey="6Ld7vdYUAAAAADN9pcXMkZZTaBo3KgsbY5MDjcEs"></div>

                <input type="submit" class="btn btn-info g-recaptcha" name="send_mail" value="Envoyer">

            </form>
        </div>
    </div>
