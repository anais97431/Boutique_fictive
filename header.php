<?php
require "conect.php";
require "fonction.php";



$categoryMenu = select_category_index();


@$menu = $_GET["id"];
switch ($menu) {
    case 1:
        $active[$menu] = " active";
        break;
    case 2:
        $active[$menu] = " active";
        break;
    case 3:
        $active[$menu] = " active";
        break;
    case 4:
        $active[$menu] = " active";
        break;
    case 5:
        $active[$menu] = " active";
        break;
    case 10:
        // $active[$menu] = " active";
        break;

    default:
        $active["0"] = " active";
}


    
    


if ($_POST) {

    @$recherche = htmlspecialchars($_POST["recherche"]);
    @$compte = htmlspecialchars($_POST["compte"]);
    @$deconnexion = htmlspecialchars($_POST["deconnexion"]);
    @$creation = htmlspecialchars($_POST["creation"]);
    // @$connection = htmlspecialchars($_POST["connection"]);


    // if ($compte) {
    //     header('Location: compte.php');
    // }

    // if ($deconnexion) {
    //     header('Location: deconnection.php');
    // }


    // if ($creation) {
    //     header('Location: user.php');
    // }

    // if ($connection) {
    //     header('Location: login.php');
    // }
}
@$recup_product = recup_all_product($id_user);
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

    <!-- Fontawesome-->
    <script src="https://kit.fontawesome.com/f8af9f7155.js" crossorigin="anonymous"></script>

    <!--script_captcha-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    <!-- googlefont-->
    <link
        href="https://fonts.googleapis.com/css?family=Aclonica|Rochester|Courgette|Niconne|Emilys+Candy|Parisienne&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?un=<?php echo $unique ?>">

    <title>Document</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand logo" href="index.php"><img src="photos/logo_svg/logo.png" width="80" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto lien_ul ">
                <li class="nav-item lien_li">
                    <a class="nav-link lien <?php echo @$active["0"] ?>"
                        href="index.php?id=<?php echo @$active["0"] ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php $i = 1; ?>
                <?php foreach ($categoryMenu as $row) { ?>
                <li class="nav-item lien_li">
                    <a class="nav-link lien<?php echo @$active[$i]
                                                ?>"
                        href="category.php?id=<?php echo @$row->id_category ?>"><?php echo @$row->title_category ?></a>
                </li>
                <?php $i++;
                } ?>

<li class="nav-item lien_li">
                    <a class="nav-link lien "
                        href="contact.php">Contactez-nous</a>
                </li>
                <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li> -->
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
                            <?php  ?>
                            <?php foreach ($recup_product as $row) { ?>
                               
                <li><a class="nav-item nav-link cart" href="cart.php"><i class="fas fa-shopping-bag fa-3x"></i></a></li>
                <p><?php echo $row->quantity_cart ?></p>
                <?php } ?>
                <?php } else { ?>


                <li><a class="nav-item nav-link " href="login.php?menu=2"><input type="submit"
                            class="btn btn-outline-success" name="connection" value="Se connecter"></a></li>
                <li><a class="nav-item nav-link" href="user.php"><input type="submit" class="btn btn-outline-info"
                            name="creation" value="Créer un compte"></a></li>


                <?php } ?>
            </ul>
        </div>
    </nav>
    <!-- debut du container -->
    <!-- <div class="container-fluid header"> -->