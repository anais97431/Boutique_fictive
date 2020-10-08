<?php

include "header.php";

@$id_product = $_GET["id_product"];
@$id_category = $_GET["id"];
@$id_user = $_SESSION["id_user"];



@$price = htmlspecialchars($_POST["price"]);
@$quantity_cart = htmlspecialchars($_POST["quantity_cart"]);
@$add_cart = htmlspecialchars($_POST["addcart"]);


if ($add_cart) {

        insert_cart($id_product, $id_user, $price, $quantity_cart);
    
}





// recup de la fonction recup_all_product_by_id et de la fonction recup_all_picture
$product = recup_all_products_by_id($id_product);
$recup_pictures = recup_all_picture($id_product);

$recup_product = recup_products();



// $recup_product = recup_products_by_id($id_category)
?>

<div class="row ligne_product">


    <?php foreach ($product as $row) { ?>
    <?php $liste_quantity = liste_quantity(@$row->id_product); ?>
    <div class="col-md-2 offset-5 images">



    
        <div class="container">
            <?php $picture = recup_picture(@$row->id_product);
                ?>
            <img width="250" src="uploads/<?php echo @$picture->title_picture ?>" alt="">
            <?php foreach ($recup_pictures as $row) { ?>

            <img class="vignette" width="100" src="uploads/<?php echo @$row->title_picture ?>" alt="">
            <?php } ?>

        </div>
    </div>



    <div class="col-md-4 offset-1 description">
        <form class="form-product"
            action="product.php?id=<?php echo $id_category ?>&id_product=<?php echo $id_product ?>" method="post">
            <div class="container">
                <h2 class="title_product"><?php echo stripslashes($row->title_product) ?></h2>
                <p class="short_desc_product"><?php echo stripslashes($row->short_desc) ?> </p>
                <p class="long_desc"><?php echo stripslashes($row->long_desc) ?></p>
                <p class="prix"><?php echo "Prix : " . $row->price . "euros" ?></p>
                <div class="select_quantity">
                    <label for="" class="label_quantity">Quantité : </label><br>
                    <input min="1" max="<?php echo $row->stock ?>" type="number" name="quantity_cart" class="quantity"
                        value="<?php echo $row->quantity ?>">
                </div>

              <?php if (@$_SESSION['id_user']) { ?>

                        <?php if ($row->stock == 0) { ?>
                            <button type="button" name="" value="" class="btn-home btnbloc btn-ajout-panier-product" data-toggle="modal" data-target=".outOfStock">Ajouter au panier</button>
                        <?php } else { ?>

                            <button  type="submit" name="addcart" value="addcart" class="btn-home btnbloc btn-ajout-panier-product">Ajouter au panier</button> 
                            <?php } ?>
                            <?php }else{ ?>
                        <button type="button" id="btnLoginProduct" name="connect"><a href="login.php">Ajouter au panier</a></button>
                    <?php } ?>
                               
                </div>
                
                <input type="hidden" name="price" value="<?php echo $row->price ?>">

    
    </form>
</div>
    <?php } ?>

</div>




 <div class="container nouveaute"><h5>Nos nouveauté :</h5></div>

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
                            <?php }else{ ?>
                        <button type="button" class="btnLogin" name="connect"><a href="login.php">Ajouter au panier</a></button>
                            <?php } ?>
                               <button class="envoiProduct" type="submit" name="envoiProduct" value="Voir le produit"
                                    aria-expanded="false"><a href="product.php?id_product=<?php echo $row2->id_product ?>&id=<?php echo $row2->id_category?>">Voir le produit
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
<?php


include "footer.php"; ?>