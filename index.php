<?php

include "header.php";




@$id_product = $_POST["id_product"];
@$id_category = $_GET["id"];


@$id_user = $_SESSION["id_user"];
@$price = htmlspecialchars($_POST["price"]);
@$quantity_cart = htmlspecialchars($_POST["quantity_cart"]);
@$quantity_cart = htmlspecialchars($_POST["quantity_cart"]);
@$add_cart = htmlspecialchars($_POST["addcart"]);

if ($add_cart) {

    insert_cart($id_product, $id_user, $price, $quantity_cart);
}

$recup_category = select_category_index();

$recup_product = recup_products();
// var_dump($recup_product);




?>



<div class="img1">

</div>
<div class="row info">

    <div class="container">
        <h3 class="display-4 titre">LA PETITE PEPINIERE, PRODUCTEUR DE SCIONS D'ARBRES FRUITIERS BIO</h3>
        <p class="lead">Vous trouverez sur ce site des variétés anciennes de pommiers, poiriers, pruniers et cerisiers,
            adaptés aux sols et au climat des Pays de Loire.
            Les scions sont greffés en février-mars sur des porte-greffe adaptés à nos sols. Ils sont plantés début
            avril et sont binés et arrosés si besoin jusqu'en juin. Ils sont ensuite paillés et l'arrosage est arrêté
            afin de renforcer le système racinaire des scions. Le travail du sol est réalisé à l'aide de la traction
            animale.</p>
    </div>

</div>


<div class="container-fluid center">
    <div class="row">
        <?php foreach ($recup_category as $row) { ?>


            <div class="col-lg-3 col-md-6 col-12">
                <div class="card-body corps_card">
                    <div class="card card_index">
                        <img src="uploads/<?php echo $row->img ?>" class="card-img-top" alt="...">
                        <h5 class="card-title"><?php echo $row->title_category ?></h5>
                        <p class="card-text">Venez découvrir nos variétés !</p>

                        <button class="voirCat" type="submit" value="Voir le produit" aria-expanded="false"><a href="category.php?id=<?php echo $row->id_category ?>">Voir cette
                                catégorie</a></button>

                    </div>

                </div>
            </div>
        <?php } ?>
    </div>
</div>


<div class="container nouveaute">
    <h5>Nos nouveauté :</h5>
</div>

<div class="container-fluid center">
    <div class="row">
        <?php foreach ($recup_product as $row2) { ?>
            <div class="col-lg-4 col-md-6 col-12">
                <div class="card-body corps_card">

                    <div class="card card_index">
                        <?php $picture = recup_picture(@$row2->id_product);
                        ?>
                        <img src="uploads/<?php echo @$picture->title_picture ?>" class="card-img-top" alt="">

                        <h5 class="card-title"><?php echo $row2->title_product ?></h5>
                        <p class="card-text">Venez découvrir cette variété !</p>
                        <p class="card-text"><?php echo $row2->price . " €" ?></p>


                        <?php if (@$_SESSION['id_user']) { ?>

                            <?php if ($row->stock == 0) { ?>
                                <button type="button" name="" value="" class="btn-home btnbloc btn-ajout-panier" data-toggle="modal" data-target=".outOfStock">Ajouter au panier</button>
                            <?php } else { ?>

                                <button type="submit" name="addcart" value="addcart" class="btn-home btnbloc btn-ajout-panier">Ajouter au panier</button>
                            <?php } ?>
                        <?php } else { ?>
                            <button type="button" class="btnLogin" name="connect"><a href="login.php">Ajouter au panier</button>
                        <?php } ?>
                        <button class="envoiProduct" type="submit" name="envoiProduct" value="Voir le produit" aria-expanded="false"><a href="product.php?id_product=<?php echo $row2->id_product ?>&id=<?php echo $row2->id_category ?>">Voir le produit
                            </a></button>
                    </div>
                </div>


            </div>



        <?php } ?>
    </div>
</div>


<div class="container-fluid bandeau_info">
    <div class="row bandeau_horaires">
        <div class="col-md-11 offset-1 logo1">
            <p>La petite pépinière est ouverte du 15 novembre au 15 mars. Le vendredi et le samedi 9h-12h et 14h-18h</p>

        </div>
    </div>
    <div class="row bandeau">
        <div class="col-md-3 offset-1 logo1">

            <img width="50" src="photos/logo_svg/chronometer.svg" alt="chronomètre">
            <p>Votre commande est prête en 24h !</p>
        </div>
        <div class="col-md-3 offset-1 logo2">
            <img width="50" src="photos/logo_svg/paypal.svg" alt="paypal">
            <p>Paiement sécurisé avec paypal !</p>
        </div>
        <div class="col-md-3 offset-1 logo3">
            <img width="50" src="photos/logo_svg/support.svg" alt="paypal">
            <p>Une question sur un produit, n'hésitez pas contactez nous !</p>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>