<?php

include "header_admin.php";
include "upload.php";
include "upload_cat.php";





if ($_SESSION["role"] != 5) {
    header('Location: login.php');
}




// var_dump($_POST);


//$liste_cat = liste_cat();


// var_dump($liste_titre);
$resultatCat = array();


if ($_POST) {

    // var_dump($_POST);

    // recup des post
    // il faut proteger les posts

    @$collapse1  =  $_POST["collapse1"];
    @$collapse2  =  $_POST["collapse2"];
    @$active  =  $_POST["active"];
    @$id_product = htmlspecialchars($_POST["id_product"]);
    @$id_category = htmlspecialchars($_POST["id_category"]);
    @$id_tva = htmlspecialchars($_POST["id_tva"]);
    @$title_category =  htmlspecialchars($_POST["title_cat"]);
    @$title_product = htmlspecialchars($_POST["title_product"]);
    @$tva = htmlspecialchars($_POST["tva"]);
    @$id_user = htmlspecialchars($_POST["id_user"]);
    @$long_desc =  $_POST["long_desc"];
    @$short_desc = $_POST["short_desc"];
    @$tva = $_POST["tva"];
    @$add_product =  htmlspecialchars($_POST["add_product"]);
    @$add_tva =  htmlspecialchars($_POST["add_tva"]);
    @$add_category =  htmlspecialchars($_POST["add_category"]);
    @$update_category =  htmlspecialchars($_POST["update_category"]);
    @$update_tva =  htmlspecialchars($_POST["update_tva"]);
    @$update_product = htmlspecialchars($_POST["update_product"]);
    @$disabled_product =  htmlspecialchars($_POST["delete_product"]);
    @$img  = $_FILES;
    @$tags = htmlspecialchars($_POST["tags"]);
    @$price = htmlspecialchars($_POST["price"]);
    @$stock = htmlspecialchars($_POST["stock"]);
    @$active = htmlspecialchars($_POST["active"]);
    @$photos = htmlspecialchars($_POST["photos[]"]);

    if ($collapse1) {
        $show1 = " show";
    } else {
        $show2 = " show";
    }
    //var_dump($img);

    // si on clic sur le bouton disabled_product: permet l'appel de la fonction disabled_product pour desactiver le produit

    if ($disabled_product) {
        disabled_product($id_product);
    }

    if ($active) {
        active_product($id_product);
    }

    // if ($photos) {
    //     $resultatPicture = select_pictures($id_picture);
    // }
    // si on selectionne un produit dans le select: permet l'appel de la fonction article_unique pour appeler un article ainsi que les images associées 

    if (isset($_POST["id_product"])) {
        $unique_product = unique_product($id_product);
        $resultatPicture = unique_picture($id_product);
    }
    // si on selectionne une categorie dans le select: permet l'appel de la fonction select_category pour appeler une category dans l'input
    if (isset($_POST["id_category"])) {
        $resultatCat = select_category($id_category);

        
    }

    // si on selectionne une categorie dans le select: permet l'appel de la fonction select_category pour appeler une category dans l'input
    if ($id_tva) {
        $resultatTva = select_tva($id_tva);
    }

    //var_dump($article_unique);

    // Protege l'entrée d'un article
    //si on clic sur le bouton ajouter: permet l'appel de la fonction add_product et insert_tags pour ajouter dans la base un nouvel article et un nouveau tag
    if ($add_product) {
        $id_product = add_product(addslashes($title_product), addslashes($id_category), addslashes($short_desc), addslashes($long_desc), addslashes($price), addslashes($stock), addslashes($id_tva), addslashes($id_user));
        img_load($id_product);

        //insert_tags($id_article, $tags);
    }
    if ($add_category) {
        $id_category = add_category(addslashes($title_category));
        img_load_cat($id_category);
    }

    if ($add_tva) {
        $tva = add_tva(addslashes($tva));
    }

    // si on clic sur le bouton update_product: permet l'appel de la fonction updateproduct pour modifier un produit 
    // Protege l'entrée
    if ($update_product) {
        update_product(addslashes($id_product), addslashes($id_category), addslashes($title_product), addslashes($long_desc), addslashes($short_desc), addslashes($price), addslashes($stock), addslashes($active));
        update_tva($id_tva, $tva);
        img_load($id_product);
        $resultatPicture = unique_picture($id_product);
    }

    // si on clic sur le bouton update_category: permet l'appel de la fonction update_category pour modifier une category 
    if ($update_category) {
        update_category($id_category, $title_category, $img);
        img_load_cat($id_category);
        //var_dump(img_load_cat($id_category));
    }

    // si on clic sur le bouton update_tva: permet l'appel de la fonction update_tva pour modifier une tva
    if ($update_tva) {
        update_tva($id_tva, $tva);
    }
}
// permet de faire apparaite les titres des articles
$liste_product =  liste_product();
$liste_category = liste_title_cat();
$liste_tva = liste_tva();
?>

<h1 class="page">PAGE ADMIN :</h1><br><br>
<div class="row">
    <div class="col">
        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample1"
                aria-expanded="true" aria-controls="multiCollapseExample1" name="collaspse1">
                <h3>Ajouter ou modifier une catégorie</h3>
            </button></p>
        <p><button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2"
                aria-expanded="false" aria-controls="multiCollapseExample2" name="collaspse2">
                <h3>Ajouter ou modifier une TVA</h3>
            </button></p>

    </div>


    <div class="col">
        <div class="collapse multi-collapse" <?php echo @$show1 ?>id="multiCollapseExample1">
            <div class="card card-body">
                <h3>ENTRER UNE CATEGORIE</h3>

                <form class="form-admin" action="admin.php" method="post" id="target" enctype="multipart/form-data">
                    <div class="form-group">
                        <!-- LISTE DES CATEGORIES -->
                        <label class="formulaire" for="">Choix de la catégorie*</label><br>
                        <select name="id_category" id="id_category" onChange="submit()" class="form-control">
                            <option value="">Choix catégorie</option>
                            <!-- Boucle permettant de recupérer dans le select le titre de l'article -->
                            <?php foreach ($liste_category as $row) { ?>
                            <option value="<?php echo $row->id_category; ?>" <?php if ($row->id_category == @$_POST["id_category"]) {
                                                                                        echo " selected";
                                                                                    } ?>>
                                <?php echo stripslashes($row->title_category); ?>
                            </option>
                            <?php } ?>

                        </select>

                    </div>
                    <br>
                    <div class="form-group">
                        <label class="formulaire" for="">Ajouter une categorie*</label><br>
                        <input type="text" value="<?php echo stripslashes(@$resultatCat->title_category); ?>"
                            name="title_cat" class="form-control" required>
                    </div>

                    <br>
                    <!-- IMAGE: permet de charger une image, le echo permet d'afficher l'image déjà présente dans l'article-->
                    <input type="file" name="photos[]" multiple><br><br>

                    <img width="100" src="uploads/<?php echo @$resultatCat->img; ?>" alt=""><br>
                    <?php echo @$resultatCat->img; ?><br><br><br>




                    <?php if (@$id_category) { ?>


                    <input type="submit" class="btn btn-warning" name="update_category" value="Modifier">

                    <?php } else { ?>
                    <input type="submit" class="btn btn-info" name="add_category" value="Ajouter">
                    <?php } ?>
                </form>
            </div>
        </div>


        <div class="col">
            <div class="collapse multi-collapse" <?php echo @$show2 ?> id="multiCollapseExample2">
                <div class="card card-body">
                    <h3>ENTRER UNE TVA</h3>

                    <form class="form-admin" action="admin.php" method="post" id="target" enctype="multipart/form-data">
                        <div class="form-group">
                            <!-- LISTE DES TITRES -->
                            <label class="formulaire" for="">Choix de la TVA*</label><br>
                            <select name="id_tva" id="id_tva" onChange="submit()" class="form-control">
                                <option value="">Choix TVA</option>
                                <!-- Boucle permettant de recupérer dans le select le titre de l'article -->
                                <?php foreach ($liste_tva as $row) { ?>
                                <option value="<?php echo $row->id_tva; ?>" <?php if ($row->id_tva == @$_POST["id_tva"]) {
                                                                                    echo " selected";
                                                                                } ?>>
                                    <?php echo stripslashes($row->tva); ?>
                                </option>
                                <?php } ?>

                            </select>

                        </div>
                        <br>
                        <div class="form-group">
                            <label class="formulaire" for="">Ajouter une TVA*</label><br>
                            <input type="text" value="<?php echo stripslashes(@$resultatTva->tva); ?>" name="tva"
                                class="form-control" required>
                        </div>

                        <br>

                        <?php if (@$id_tva) { ?>


                        <input type="submit" class="btn btn-warning" name="update_tva" value="Modifier">

                        <?php } else { ?>
                        <input type="submit" class="btn btn-info" name="add_tva" value="Ajouter">
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="container">


    <div class="container">
        <h3>ENTRER UN ARTICLE</h3>
        <br>
        <!-- Formulaire permettant de selectionner les titre, les catégories et de creer de nouveaux articles -->
        <form class="form-admin" action="admin.php" method="post" id="target" enctype="multipart/form-data">
            <div class="form-group">
                <!-- LISTE DES TITRES -->
                <label class="formulaire" for="">Choix du titre*</label><br>
                <select name="id_product" id="id_product" onChange="submit()" class="form-control">
                    <option value="">Choix du titre</option>
                    <!-- Boucle permettant de recupérer dans le select le titre de l'article -->
                    <?php foreach ($liste_product as $row) { ?>
                    <option value="<?php echo $row->id_product; ?>" <?php if ($row->id_product == @$_POST["id_product"]) {
                                                                            echo " selected";
                                                                        } ?>>
                        <?php echo stripslashes($row->title_product); ?>
                    </option>
                    <?php } ?>

                </select>

            </div>
            <div class="form-group">
                <!-- LISTE CATEGORIES -->
                <label class="formulaire" for="">Choix des categories*</label><br>
                <select name="id_category" id="id_category" class="form-control" required>
                    <option value="">Choix de votre catégorie</option>
                    <?php foreach ($liste_category as $row) { ?>

                    <option value="<?php echo $row->id_category; ?>" <?php if ($row->id_category == @$unique_product->id_category) {
                                                                                echo " selected";
                                                                            } ?>><?php echo $row->title_category; ?>
                    </option>

                    <?php } ?>
                </select>

            </div>
            <br>

            <div class="form-group">
                <!-- LISTE TVA -->
                <label class="formulaire" for="">Choix tva*</label><br>
                <select name="id_tva" id="id_tva" class="form-control">
                    <option value="">Choix tva</option>
                    <?php foreach ($liste_tva as $row) { ?>

                    <option value="<?php echo $row->id_tva; ?>" <?php if ($row->id_tva == @$unique_product->id_tva) {
                                                                        echo " selected";
                                                                    } ?>><?php echo $row->tva; ?></option>

                    <?php } ?>
                </select>

            </div>


            <br>
            <!--Titre article: le echo permet de recupérer la valeur qui est dans le base de donnée -->
            <div class="form-group">
                <label class="formulaire" for="">Titre du produit*</label><br>
                <input type="text" value="<?php echo stripslashes(@$unique_product->title_product); ?>"
                    name="title_product" class="form-control" required>
            </div>

            <!-- Article court le echo permet de recupérer la valeur qui est dans le base de donnée-->
            <div class="form-group">
                <label class="formulaire" for="">Descrition courte*</label><br>
                <textarea name="short_desc" maxlength="300" id="" class="form-control" cols="30"
                    rows="5"><?php echo stripslashes(@$unique_product->short_desc); ?></textarea>
            </div>
            <!-- Article le echo permet de recupérer la valeur qui est dans le base de donnée-->
            <div class="form-group">
                <label class="formulaire" for="">Description complète du Produit*</label><br>
                <textarea name="long_desc" id="editor" class="form-control" cols="30"
                    rows="10"><?php echo stripslashes(@$unique_product->long_desc); ?></textarea><br>


                <?php // echo @$article_unique->commentaire; 
                ?>
            </div>

            <br><br>
            <label for="">Prix du produit</label><br>
            <input type="text" value="<?php echo @$unique_product->price; ?>" class="form-control" name="price">
            <br><br>
            <label for="">Stock produit</label><br>
            <input type="text" value="<?php echo @$unique_product->stock; ?>" class="form-control" name="stock">
            <br>

            <!--Permet d'afficher id_user qui est connecté (cacher avec le type hidden)-->
            <input type="hidden" name="id_user" class="form-control" value="<?php echo @$_SESSION["id_user"]; ?>"
                required><br>

            <!--Permet de coché si on veut activer ou désactiver le produit -->

            <?php if (@$unique_product->active == 1) {
                $checked1 = " checked ";
            } else {
                $checked1 = "";
            } ?>

            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value="1" id="customCheck1" name="active"
                    <?php echo @$checked1 ?>>
                <label class="custom-control-label" for="customCheck1">Rendre le produit visible sur le site</label>
            </div>
            <br>
            <!-- IMAGE: permet de charger une image, le echo permet d'afficher l'image déjà présente dans l'article-->
            <input type="file" name="photos[]" multiple><br><br>
            <div>
                <?php if (@$id_product) { ?>
                <!--Via le foreach on accède à $image_unique sous forme de "tableau" qu'on segmente ensuite en ligne (row)-->
                <?php foreach (@$resultatPicture as $row) { ?>
                <!--Et dans le row on va chercher le champ name_image_product pour l'afficher dans une balise image via un echo-->
                <img width="100" src="uploads/<?php echo @$row->title_picture ?>" alt="">
                <?php } ?>
                <?php } ?>

            </div>
            <!-- si id_article est vrai on affiche les boutons modifier et supprimer sinon on affiche le bouton ajouter-->
            <?php if (@$id_product) { ?>


            <input type="submit" class="btn btn-warning" name="update_product" value="Modifier">


            <input type="submit" id="supprimer" class="btn btn-danger" name="delete_product" value="Supprimer">
            <?php } else { ?>
            <input type="submit" class="btn btn-info" name="add_product" value="Ajouter">
            <?php } ?>





        </form>
    </div>




    <!-- Script JODIT pour l'editeur de texte-->
    <script>
    var getUrl = window.location;
    var baseUrl = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];




    var editor = new Jodit('#editor', {
        uploader: {
            url: baseUrl + '/connector/index.php?action=fileUpload'
        },

        filebrowser: {
            ajax: {
                url: baseUrl + '/connector/index.php'
            }
        },
        "buttons": "|,source,bold,strikethrough,underline,italic,|,ul,ol,|,outdent,indent,|,font,fontsize,brush,paragraph,|,video, image,table,link,|,align,undo,redo,\n,hr,eraser,copyformat,|,symbol"

        //"buttons": "|,source,bold,strikethrough,underline,italic,|,superscript,subscript,|,ul,ol,|,outdent,indent,|,font,fontsize,brush,paragraph,|,image,file,video,table,link,|,align,undo,redo,\n,cut,hr,eraser,copyformat,|,symbol,fullsize,selectall,print,about"               
    });
    </script>


    <?php
    include "footer.php";
    ?>

    <!-- Script permettant l'affichage de la fenetre de confirmation si on clic sur le bouton supprimer-->
    <script>
    $(document).ready(function() {

        $("#supprimer").on("click", function(e) {


            if (confirm("voulez-vous vraiment supprimer ?")) {
                // Code à éxécuter si le l'utilisateur clique sur "OK"
                exit();
            } else {
                // Code à éxécuter si l'utilisateur clique sur "Annuler" 
                e.preventDefault();
                exit();

            }
        });

    });
    </script>