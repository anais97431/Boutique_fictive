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


$recup_product = recup_products_by_id($id_category);








// var_dump($recup_des_articles);
?>



<div class="container-fluid container_cat">


    <div class="row card_cat_row">
        <?php foreach ($recup_product as $row) { ?>

        <?php $picture = recup_picture(@$row->id_product); ?>

        <div class="card mb-3 card_cat_corps">

            <div class="row no-gutters card_cat">
                <div class="col-md-3 offset-1 img">
                    <img width="200" src="uploads/<?php echo @$picture->title_picture ?>" alt="">
                </div>
                <div class="col-md-7 offset-1 card_cat_contenu">
                    <form class="form-product"
                        action="category.php?id=<?php echo $id_category ?>"
                        method="post">
                        <div class="card-body">
                            <h5 class="title_cat"><?php echo stripslashes($row->title_product) ?></h5>
                            <p class="short_desc_cat"><?php echo stripslashes($row->short_desc) ?></p>
                            <p class="price_cat"><?php echo $row->price . " €" ?></p>
                            <div class="select_quantity">
                                <label for="" class="label_quantity">Quantité : </label><br>
                                <input min="1" max="<?php echo $row->stock ?>" type="number" name="quantity_cart"
                                    class="quantity" value="<?php echo $row->quantity ?>">
                            </div><br>


                            <div class="row">
                           

                                <?php if (@$_SESSION['id_user']) { ?>

                        <?php if ($row->stock == 0) { ?>
                            <button type="button" name="" value="" class="btn-home btnbloc btn-ajout-panier" data-toggle="modal" data-target=".outOfStock">Ajouter au panier</button>
                        <?php } else { ?>

                            <button type="submit" name="addcart" value="addcart" class="btn-home btnbloc btn-ajout-panier">Ajouter au panier</button> 
                            <?php } ?>
                            <?php }else{ ?>
                        <button type="button" class="btnLogin" name="connect"><a href="login.php">Ajouter au panier</button>
                            <?php } ?>
                                <button class="envoiProduct" type="submit" name="envoiProduct" value="Voir le produit"
                                    aria-expanded="false"><a href="product.php?id_product=<?php echo $row->id_product ?>&id=<?php echo $row->id_category?>">Voir le produit
                                    </a></button>
                            </div>


                            <input type="hidden" name="price" value="<?php echo $row->price ?>">
                            <input type="hidden" name="id_product" value="<?php echo $row->id_product ?>">
                                </div>
                    </form>

            
                    
                     
                    <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                </div>

            </div>
        </div>

        <?php } ?>
    </div>

    </div>

    


    <!-- <div class="col category">

            <?php $picture = recup_picture(@$row->id_product);
            ?>
            <div class="col">
                <img width="250" src="uploads/<?php echo @$picture->title_picture ?>" alt="">
            </div>
            <div class="col">
                <h2 class="title_cat"><?php echo $row->title_product ?></h2>
                <p class="short_desc_cat"><?php echo $row->short_desc ?>...<a
                        href="product.php?id_product=<?php echo $row->id_product; ?>&id=<?php echo $row->id_category ?>">Suite</a>
                </p>
                <p class="price_cat"><?php echo $row->price . " €" ?></p>
                <a href="cart.php" class="btn btn-info bouton_ajout_cat">Ajouter au panier</a>
            </div>


        </div> -->

    






<?php include "footer.php"
?>