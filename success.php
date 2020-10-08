<?php
include "header.php";

@$id_user = $_GET["id_user"];

if ($id_user) {

    insert_payment($id_user);
}


?>


<h3>Merci pour votre commande !</h3>