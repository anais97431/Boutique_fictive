<!-- fin du container -->
<footer>

    <div class="container-fluid ">
        <div class="row bandeau_footer">
            <div class="col-md-3 offset-1 bandeau_footer_col1">
                <h5>Producteurs partenaires :</h5>
                <a href="https://www.beaufort-jeunes-plants.fr/">Beaufort Jeunes Plants</a><br>
                <a href="https://www.ribanjou.com/">Ribanjou</a><br>
                <a href="http://www.plantez-bio.fr/">Plants bio</a><br>
            </div>
            <div class="col-md-3 offset-1 bandeau_footer_img">
                <h5> La petite pépinière :</h5>
                <img src="photos/logo_svg/AB.png" width="120" height="70" alt="logo">
            </div>


            <div class="col-md-3 offset-1 bandeau_footer_col2">
                <h5>Associations :</h5>
                <a href="http://www.croqueurs-anjou.org/">Les croqueurs de pommes de l'Anjou</a><br>
                <a href="http://www.foretscomestibles.com/">La forêt nourricière</a><br>
                <a href="https://terre-paille.fr/">Terre paille et compagnie</a><br>
            </div>


        </div>
    </div>







</footer>
<!-- </div> -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.min.js"></script>




<script>
    $(document).ready(function() {


        <?php if (@$add_cart) { ?>
            $('.modalAjoutPanier').modal('show');
        <?php } ?>


        <?php if (@$endStock) { ?>
            $('.outOfStock').modal('show');
        <?php } ?>


        // Modal success pour paiement réussi

        <?php $success =  isset($_GET["success"]) ?>

        <?php if (@$success) { ?>
            $('.modalSuccess').modal('show');
        <?php } ?>


// Modalcancel pour paiement echec

        <?php $cancel =  isset($_GET["cancel"]) ?>

        <?php if (@$cancel) { ?>
            $('.modalCancel').modal('show');
        <?php } ?>
     
  

    
    });
</script>



<!--Modal (.modalSuccess) pour confirmation de commande-->
<div class="modal fade modalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-register">Confirmation de commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM INSCRIPTION-->
                <form action="index.php" method="post">
                    <h5>Merci pour votre achat <?php echo $_SESSION['name'] ?> !</h5>
                    <p>A bientôt !</p>
                    <br>
                </form>
                <!--FIN FORM-->
            </div>
        </div>
    </div>
</div>

<!--Modal (.modalCancel) pour confirmation de commande-->
<div class="modal fade modalCancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-register">Echec de la commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM INSCRIPTION-->
                <form action="index.php" method="post">
                    <h4>Un problème est survenu lors de votre paiement.</h3>
                    <p>Veuillez réitérer votre commande ou nous contacter.</p>
                    <p>Merci pour votre confiance !</p>
                    <br>
                </form>
                <!--FIN FORM-->
            </div>
        </div>
    </div>
</div>

<!--Modal (.modalAjoutPanier) pour informer que le produit à bien été ajouté-->
<div class="modal fade modal modalAjoutPanier" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-register">Confirmation de commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM INSCRIPTION-->
                <form action="index.php" method="post">
                    <h5>Panier <?php echo $_SESSION['name'] ?> !</h5>
                    <p>Votre article à bien été ajouter !</p>
                    <br>
                </form>
                <!--FIN FORM-->
            </div>
        </div>
    </div>
</div>


<!--Modal (.modalEndStock) pour informer que le produit à bien été ajouté-->
<div class="modal fade outOfStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-register">Epuisement des stocks !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--FORM INSCRIPTION-->
                <form action="index.php" method="post">
                    <h5>Cet article n'est plus en stock :(</h5>
                    
                    <br>
                </form>
                <!--FIN FORM-->
            </div>
        </div>
    </div>
</div>
</body>

</html>