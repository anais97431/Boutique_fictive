<?php
include "header.php";

$id_user = $_GET["id"];

if ($id_user) {

    insert_payment($id_payment, $number_ordered, $id_user);
   
}

?>


<h3>Merci pour votre commande !</h3>