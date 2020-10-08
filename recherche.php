<?php


include "header.php";




    @$boutonProduit = htmlspecialchars($_POST["envoiProduct"]);

    @$recherche = trim(htmlspecialchars($_POST["recherche"]));


if ($recherche) {
    @$result = recherche($recherche);
    var_dump($result);
}


if ($boutonProduit) {
    header('Location:product.php');
}



?>


<div class="row">
    <?php if (!empty($result)) { ?>
    <div class="search">
        <?php foreach (@$result as $row) { ?>

        <div class="col-md-6">

            <h2 class=""><?php echo $row->title_product ?></h2>
            <h5 class=""><?php echo $row->title_category ?></h5>
            <div class="">

                <p class=""><?php echo $row->short_desc ?>
                </p>
<button id="envoiProduct" type="submit" name="envoiProduct" value="product"
                                    aria-expanded="false">Voir
                                    le produit</button>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php } else { ?>
    <h3> Pas de réponse pour votre recherche </h3>
    <?php } ?>
</div>

<?php include "footer.php" ?>

<script>
$(document).ready(function() {
    $(".searchInput").mark("<?php echo @$recherche; ?>");

});
</script>