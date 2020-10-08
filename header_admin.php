<?php
include "conect.php";
include "fonction.php";

@$menu = $_GET["menu"];
switch ($menu) {
    case 1:
        $active_1 = " active";
        break;
    case 2:
        $active_2 = " active";
        break;
    default;
}

//pour que les css ne passe pas en memoire
$unique = uniqid();
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- jodit -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.2.65/jodit.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.2.65/jodit.min.js"></script>


    <link href="https://fonts.googleapis.com/css?family=Aclonica|Rochester|Parisienne&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?un=<?php echo $unique; ?>">

    <title>Document</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">BackOffice</a>
        <img src="photos/logo_svg/logo.png" width="60" height="60" alt="logo">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav mr-auto lien_ul ">
                <li class="nav-item lien_li">
                <a class="nav-item nav-link lien <?php echo @$active_1 ?>" href="admin.php?menu=1">Admin <span
                        class="sr-only">(current)</span></a></li>
                <li class="nav-item lien_li"><a class="nav-item nav-link lien <?php echo @$active_2 ?>" href="index.php?menu=2">La petite pépinière<span
                        class="sr-only">(current)</span></a></li>
</ul>

            <ul class="navbar-nav lien_ul ">
           
                <form class="form-inline my-2 my-lg-0 form_search" action="recherche.php" method="post">
                    <input class="form-control mr-sm-2 searchInput" type="text" placeholder="Search"
                        aria-label="Search" name="recherche" >
                    <button class="search" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <?php if (@$_SESSION["id_user"]) { ?>
                <p class="bienvenue">Bienvenue <?php echo @$_SESSION["name"] ?></p>



                <li><a class="nav-item nav-link " href="compte.php"><input type="submit" class="btn btn-outline-success"
                            name="compte" value="Mon compte"></a></li>
                <li><a class="nav-item nav-link" href="deconnection.php"><input type="submit"
                            class="btn btn-outline-info" name="deconnexion" value="Déconnexion"></a></li>
                            <?php @$total += $quantite_cart ?>
                <li><a class="nav-item nav-link cart" href="cart.php"><i class="fas fa-shopping-bag fa-3x"></i></a></li>

                <?php } else { ?>


                <li><a class="nav-item nav-link " href="login.php?menu=2"><input type="submit"
                            class="btn btn-outline-success" name="connection" value="Se connecter"></a></li>
                <li><a class="nav-item nav-link" href="user.php"><input type="submit" class="btn btn-outline-info"
                            name="creation" value="Créer un compte"></a></li>


                <?php } ?>
            </ul>
        </div>
    </nav>
    <br><br><br><br><br>
    <!-- debut du container -->
    <div class="container">
        <br><br><br><br><br>