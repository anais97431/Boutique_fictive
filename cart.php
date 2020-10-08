<?php

include "header.php";


/* 
 * PayPal and database configuration 
 */

// PayPal configuration 
define('PAYPAL_ID', 'sb-8szdr976758@business.example.com');
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 

define('PAYPAL_RETURN_URL', 'http://localhost/projet_boutique2/success.php?id_user=' . $_SESSION["id_user"] . '');
define('PAYPAL_CANCEL_URL', 'http://localhost/projet_boutique2/cancel.php?id_user=' . $_SESSION["id_user"] . '');
// define('PAYPAL_NOTIFY_URL', 'http://localhost/paypal/ipn.php');
define('PAYPAL_CURRENCY', 'EUR');


// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true) ? "https://www.sandbox.paypal.com/cgi-bin/webscr" : "https://www.paypal.com/cgi-bin/webscr");

/* 
 * Definition des variables 
 */
@$id_product = $_GET["id_product"];
@$id_user = $_SESSION["id_user"];
@$price = htmlspecialchars($_POST["price"]);
@$quantity_cart = htmlspecialchars($_POST["quantity_cart"]);
@$delete_product_cart = htmlspecialchars($_POST["delete_product"]);
@$delete_cart = htmlspecialchars($_POST["delete_cart"]);
@$name = htmlspecialchars($_POST["prenom"]);
@$last_name = htmlspecialchars($_POST["nom"]);
@$adress = htmlspecialchars($_POST["adresse"]);
@$login = htmlspecialchars($_POST["login"]);
@$validCommande = htmlspecialchars($_POST["validCommande"]);

// $quantity_cart permet de mettre a jour la quantité dans la base de donnée a partir du select de quantité

if ($quantity_cart) {
    update_quantity_cart($id_user, $id_product, $quantity_cart);
}

// $delete_product_cart permet de supprimer un produit : le rend inactif dans la base

if ($delete_product_cart) {
    disabled_product_cart($id_product);
}

// permet d'ajouter dans la table payment les infos de paiement 
if ($validCommande) {

    update_user($name, $last_name, $adress, $login, $id_user);
}

// recup de la fonction recup_all_product qui permet d'afficher les produits sur la page
@$recup_product = recup_all_product($id_user);
$select_user = recup_user($id_user);
$recup_product2 = recup_products();
?>

<?php if ($recup_product == NULL) { ?>

<h3 class="panier_vide">Votre panier est vide ! :(</h3>

<?php } else { ?>

<div class="container">
    <div class="row ligne_table">

        <table class="table">
            <thead class="entete_tableau">
                <tr>
                    <th></th>
                    <th>Nom du produit</th>
                    <th>Référence du produit</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité</th>
                    <th>TVA %</th>
                    <th>TVA incluse</th>
                    <th>Total TTC</th>
                    <th>Supprimer le produit</th>

                </tr>
            </thead>


            <tbody class="corps_tableau">
                <?php foreach ($recup_product as $row) { ?>
                <?php $liste_quantity = liste_quantity($row->id_product); ?>


                <form class="form-tableau" action="cart.php?id_product=<?php echo $row->id_product ?>" method="post">

                    <tr>
                        <th><?php $picture = recup_picture(@$row->id_product);
                                    ?>
                            <img width="60" src="uploads/<?php echo @$picture->title_picture ?>" alt=""></th>
                        <td><?php echo $row->title_product ?></td>
                        <td><?php echo $row->id_product ?></td>
                        <td><?php echo $row->price . "€" ?></td>
                        <td> <select name="quantity_cart" id="quantity_cart" onChange="submit()" class="form-control">
                                <option value="">Choix quantité</option>
                                <!-- Boucle permettant de recupérer dans le select la quant -->
                                <?php for ($q = 1; $q <= $liste_quantity->stock; $q++) { ?>
                                <option value="<?php echo $q; ?>" <?php if ($row->quantity_cart == @$q) {
                                                                                    echo " selected";
                                                                                } ?>>
                                    <?php echo stripslashes($q); ?>
                                </option>
                                <?php } ?>

                            </select></td>


                        <td><?php echo $row->tva; ?></td>
                        <td><?php echo ($row->price *$row->tva) /100 . "€"; ?></td>
                        <?php $prixQuantite = $row->price * $row->quantity_cart ?>
                        <td name="somme_product"><?php echo  $prixQuantite . "€"; ?></td>
                        <?php @$total += $prixQuantite ?>

                        <td><button class="trash" type="submit" name="delete_product" value="Supprimer"><i
                                    class="fas fa-trash-alt"></i></button></td>

                    </tr>
                </form>
                <?php } ?>
            </tbody>




            <tfoot class="pied_tableau">
                <tr>
                    <th colspan="7">Total : </th>
                    <td class="total"><input type="text" value="<?php echo $total . "€"; ?>" disabled></td>

                    <td><button id="valider" type="submit" name="validOrder" value="COMMANDER" data-toggle="collapse"
                            data-target="#collapseExample" aria-expanded="false"
                            aria-controls="collapseExample">COMMANDER</button>
                    </td>
                </tr>
            </tfoot>




        </table>

    </div>
</div>

<div class="container collapse_panier">
    <div class="col">
        <div class="collapse" id="collapseExample">
            <div class="card card-body col_corps">
                <div class="row">
                    <div class="container container_collapse_panier">
                        <label for="" class="cart_entete">Informations de votre compte : </label>

                        <form class="form_collapse" action="<?php echo PAYPAL_URL; ?>" method="post">
                            <div class="form-row form_ligne_collapse">
                                <div class="form-group col-md-6 col_nom">
                                    <label class="label_collapse" for="inputNom">Nom : </label>
                                    <input class="input_nom" type="text" class="form-control" id="inputNom" name="nom"
                                        value="<?php echo $select_user->last_name ?>">
                                </div>
                                <div class="form-group col-md-6 col_prenom">
                                    <label class="label_collapse" for="inputPrenom">Prénom : </label>
                                    <input class="input_prenom" type="text" class="form-control" id="inputPrenom"
                                        name="prenom" value="<?php echo $select_user->name ?>">
                                </div>
                            </div>
                            <div class="form-group col_adresse">
                                <label class="label_collapse" for="inputAddress">Addresse : </label><br>
                                <input class="input_adresse" type="text" class="form-control" id="inputAddress"
                                    placeholder="adresse" name="adresse" value="<?php echo $select_user->adress ?>">
                            </div>
                            <div class="form-group col_email">
                                <label class="label_collapse" for="inputAddressmail">Email :
                                </label><br>
                                <input class="input_email" type="email" class="form-control" id="inputAddressmail"
                                    placeholder="email" name="login" value="<?php echo $select_user->login ?>">
                            </div>
                            <div class="form-group col_total">
                                <label class="label_collapse" for="inputTotal">Total de votre panier :
                                </label><br>
                                <input class="input_total" type="text" class="form-control" id="inputTotal"
                                    value="<?php echo $total . "€"; ?>" disabled>
                            </div>
                            <!-- Identify your business so that you can collect the payments. -->
                            <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">

                            <!-- Specify a Buy Now button. -->
                            <input type="hidden" name="cmd" value="_xclick">

                            <!-- Specify details le nom de la personne. -->
                            <input type="hidden" name="item_name" value="<?php echo $select_user->name ?>">
                            <!-- Si IPN retour id_user -->
                            <input type="hidden" name="item_number" value="<?php echo $select_user->id_user ?>">
                            <!-- Somme a envoyer a Paypal -->
                            <input type="hidden" name="amount" value="<?php echo $total ?>">
                            <input type="hidden" name="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">

                            <!-- Specify URLs -->
                            <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                            <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                            <!-- <input type="hidden" name="notify_url" value="<?php // echo PAYPAL_NOTIFY_URL; 
                                                                                    ?>"> -->

                            <!-- Display the payment button. -->
                            <!--<input type="submit" name="submit" value="Payer par Paypal">-->

                            <button id="validerCommande" type="submit" name="validCommande" value="Payer par Paypal">Valider la
                                commande</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>


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

<div class="container nouveaute"><h5>Nos nouveauté :</h5></div>

 <div class="container-fluid center">
    <div class="row">
        <?php foreach ($recup_product2 as $row2) { ?>
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

<?php



include "footer.php";
?>