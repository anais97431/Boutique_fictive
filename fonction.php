<?php
ob_start();
session_start();


function captcha(){

    $secretKey = '6Ld7vdYUAAAAABYdUk10ELBMiBRgMjebpfM3rQvD';
                $captcha   = $_POST['g-recaptcha-response'];

                if(empty($captcha)){

                    $_SESSION["captcha_error"] = "Merci de valider la captcha";
                    header("location:contact.php?captcha=error");
    
                } else {

                $ip             = $_SERVER['REMOTE_ADDR'];
                $response       = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
                $responseKeys   = json_decode($response,true);

}
}

// Fonction pour crypter un mot de passe
function decrypt($passe)
{
    $pass_hash = password_hash($passe, PASSWORD_DEFAULT);
    return $pass_hash;
}
// Fonction pour détecter si une adresse mail a déja été insérer dans la base.
function doublon_user($login)
{

    global $connection;

    $sql = "SELECT * FROM users WHERE login = '$login'";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);

    return $resultat->login;
}


// Fonction permettant l'ajout d'utilisateur dans la base

function  insert_user($nom, $prenom, $adresse, $login, $passe_hash)
{

    global $connection;

    $sql_ins = "INSERT INTO  users(last_name, name, adress, login, password) VALUES (:last_name, :name, :adress, :login, :password)";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':last_name' => $nom,
        ':name' => $prenom,
        ':adress' => $adresse,
        ':login' => $login,
        ':password' => $passe_hash

    ));
}

// fonction permettent la verification du login et du mot de passe au moment de la connexion
// redirection vers les pages admin ou index en fonction du role
function verif_login($login, $passe)
{

    // var_dump($passe);


    global $connection;

    // SELECT permet de recupérer le login ainsi que le passe lié

    $sqlSel =  "SELECT * FROM users WHERE login = '$login'";
    // var_dump($sql);

    $sth = $connection->prepare($sqlSel);
    $sth->execute();
    $compt = $sth->rowCount();

    if ($compt == 0) {
        echo "<h3>" . "Votre login n'est pas enregistré sur ce site !" . "<br>";
        echo "<h3>" . "Veuillez créer un compte pour vous connecter. ";

        header('Location:user.php');
        exit();
    }

    $resultat = $sth->fetch(PDO::FETCH_OBJ);

    // var_dump($resultat);
    // var_dump($resultat->password);


    // vérification du mot de passe taper et du passe dans la base de donnée
    if ($login == $resultat->login) {
        if (password_verify($passe, $resultat->password)) {


            echo "Mot de passe correct";
            if ($resultat->role == 5) {
                $_SESSION["id_user"] = $resultat->id_user;
                $_SESSION["role"] = $resultat->role;
                $_SESSION["last_name"] = $resultat->last_name;
                $_SESSION["name"] = $resultat->name;

                header('Location:admin.php');
                ob_flush();
                exit();

                // sinon on redirige vers la page index    
            } else {
                $_SESSION["id_user"] = $resultat->id_user;
                $_SESSION["role"] = $resultat->role;
                $_SESSION["last_name"] = $resultat->last_name;
                $_SESSION["name"] = $resultat->name;

                header('Location:index.php');
                exit();
            }
        } else {
            echo "Mot de passe incorrect";
            header('Location: login.php?message=1');
            exit();
        }
    } else {
        echo "Votre login est faux.";
        header('Location: login.php?message=2');
        exit();
    }
}
// si resultat est faux on redirige vers la page de login

// si le role est egale à 5 on redirige vers la page de admin

function add_product($title_product, $id_category, $short_desc, $long_desc, $price, $stock, $id_tva, $id_user)
{
    // recup de la connection
    global $connection;
    
    // insert dans la table articles
    $sql_ins = "INSERT INTO products(title_product, id_category, short_desc, long_desc, price, stock, id_tva) VALUES (:title_product, :id_category, :short_desc, :long_desc, :price, :stock, :id_tva)";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':title_product' => $title_product,
        ':id_category' => $id_category,
        ':short_desc' => $short_desc,
        ':long_desc' => $long_desc,
        ':price' => $price,
        ':stock' => $stock,
        ':id_tva' => $id_tva


    ));
    // recuperation de id_article
    $id_product = $connection->lastInsertId();

    $id_user = $_SESSION["id_user"];
    // appel la function pour passer les id
    //insert_liaison($id_product, $id_user);


    return $id_product;
}

/**
 * recuperation des id 
 */
// function insert_liaison($id_product, $id_user)
// {
//     // recup de la connection
//     global $connection;

//     $sql_ins = "INSERT INTO  carts(id_product, id_user) VALUES (:id_product, :id_user)";

//     $sth = $connection->prepare($sql_ins);
//     $sth->execute(array(
//         ':id_product' => $id_product,
//         ':id_user' => $id_user,


//     ));
// }

/**
 * Récup liste des categories
 */
// 

function liste_title_cat()
{
    global  $connection;
    $sql = "SELECT * FROM categorys ";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}

// recup liste titres actif
function liste_product()
{
    global  $connection;
    //  req ordonnée par titre du produit
    $sql = "SELECT * FROM products 
     ORDER BY title_product ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}

function liste_tva()
{
    global  $connection;
    //  req ordonnée par tva
    $sql = "SELECT * FROM tva 
     
     ORDER BY tva ASC";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}



// ajout des categories dans la table categorys
function add_category($title_category)
{
    // recup de la connection
    global $connection;
    // insert dans la table category
    $sql_ins = "INSERT INTO categorys(title_category) VALUES (:title_category)";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':title_category' => $title_category

    ));

    $id_category = $connection->lastInsertId();
    return $id_category;
}

// ajout des categories dans la table categorys


function select_category($id_category)
{
    global $connection;

    $sql = "SELECT * FROM categorys 
    WHERE id_category = $id_category";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultatCat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultatCat;
}

// ajout des categories dans la table categorys


function select_category_index()
{
    global $connection;

    $sql = "SELECT * FROM categorys ";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultatCat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultatCat;
}

function recup_category()
{
    global  $connection;

    $sql =  "SELECT *  FROM categorys
    INNER JOIN products ON products.id_category = categorys.id_category
    WHERE products.active=1";

    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}
function  update_category($id_category, $title_category)
{
    global  $connection;

    $sql =  "UPDATE categorys
    SET  title_category = '$title_category'
    WHERE id_category = $id_category";
    $sth = $connection->prepare($sql);
    $sth->execute();

    img_load_cat($id_category);

    //header('Location: admin.php');
}

// rend inactif un produit appel sur le bouton supprimer
function disabled_product($id_product)
{

    global  $connection;

    $sql =  "UPDATE products
    SET active = 0
    WHERE id_product = $id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
    header('Location: admin.php');
}

// selection du produit unique avec un inner join
function unique_product($id_product)
{
    global $connection;

    $sql = "SELECT *  FROM categorys
    INNER JOIN products ON products.id_category = categorys.id_category
    LEFT JOIN tva ON products.id_product = tva.id_tva
    LEFT JOIN pictures ON products.id_product = pictures.id_product
    WHERE products.id_product = $id_product";

    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultatUnique = $sth->fetch(PDO::FETCH_OBJ);
    return $resultatUnique;
}

// Modification du produit
function update_product($id_product, $id_category, $title_product, $long_desc, $short_desc, $price, $stock, $active)
{
    global  $connection;

    // Lien avec la checkbox si active est egale a rien la valeur est a 0
    if ($active == '') {
        $active = 0;
    }



    $sql =  "UPDATE products
    SET  id_category = $id_category, title_product = '$title_product', long_desc = '$long_desc', short_desc = '$short_desc', price =$price, stock =$stock, active=$active   
    WHERE id_product = $id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();

    // $resultat = $sth->fetch(PDO::FETCH_OBJ);

    // return $resultat;
    // modification de liaisons
    //   $sql =  "UPDATE categorys
    //   SET id_category = '$id_category'
    //   WHERE id_product = $id_product";
    //   $sth = $connection->prepare($sql);
    //      $sth->execute();


}
/**
 * permet de ciblé la tva avec l'id
 */
function select_tva($id_tva)
{
    global $connection;

    $sql = "SELECT * FROM tva  WHERE id_tva = $id_tva";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultatTva = $sth->fetch(PDO::FETCH_OBJ);
    return $resultatTva;
}
/**
 * permet l'ajout d'une tva
 */
function add_tva($tva)
{
    // recup de la connection
    global $connection;
    // insert dans la table category
    $sql_ins = "INSERT INTO tva (tva) VALUES (:tva)";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':tva' => $tva

    ));
}
/**
 * permet de mettre a jour la tva
 */
function update_tva($id_tva, $tva)
{
    global  $connection;

    $sql =  "UPDATE tva
    SET  tva = '$tva'
    WHERE id_tva = $id_tva";
    $sth = $connection->prepare($sql);
    $sth->execute();

    // $resultat = $sth->fetch(PDO::FETCH_OBJ);

    // return $resultat;
    header('Location: admin.php');
}

/**
 * permet de passer les produit en actif pour les afficher sur la page produit via la checkbox sur la page admin
 */
function active_product($id_product)
{

    global  $connection;

    $sql =  "UPDATE products
    SET active = 1
    WHERE id_product= '$id_product'";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

/**
 * recupération des images associées aux produits
 */
function unique_picture($id_product)
{
    global $connection;

    $sql ="SELECT * FROM pictures WHERE id_product = $id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultatPicture = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultatPicture;
}

/**
 * Permet le recupération des produits par l'id category pour afficher sur les pages par categorie
 */
function recup_products_by_id($id_category)
{
    global  $connection;

    $sql =  "SELECT *  FROM products
    INNER JOIN categorys ON categorys.id_category = products.id_category
    WHERE products.id_category= $id_category AND products.active = 1";

    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}

/**
 * Permet le recupération de des produits exlusifs sur la page index
 */
function recup_products()
{
    global  $connection;

    $sql =  "SELECT *  FROM products
    INNER JOIN categorys ON categorys.id_category = products.id_category
    WHERE products.active = 1 AND products.exclu=1";

    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}


/**
 * Permet le recupération les produits par les id pour afficher sur la page product
 */
function recup_all_products_by_id($id_product)
{
    global  $connection;

    $sql =  "SELECT *  FROM products
    WHERE products.id_product= $id_product AND products.active = 1";

    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}

/**
 * Permet de recupérer les images du produit et d'afficher une seule image sur le produit
 */
function recup_picture($id_product)
{
    global $connection;

    $sql = "SELECT * FROM pictures 
    INNER JOIN products ON products.id_product = pictures.id_product
    WHERE pictures.id_product = $id_product AND products.active = 1 LIMIT 1";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultatPicture = $sth->fetch(PDO::FETCH_OBJ);
    return $resultatPicture;
}

/**
 * Permet de recupérer les images du produit et d'afficher toutes les images sur la page du produit
 */
function recup_all_picture($id_product)
{
    global $connection;

    $sql = "SELECT * FROM pictures 
    INNER JOIN products ON products.id_product = pictures.id_product
    WHERE pictures.id_product = $id_product AND products.active = 1";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultatPicture = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultatPicture;
}

/**
 * Permet de recupérer les utilisateurs pour modifier un compte
 */
function recup_user($id_user)
{
    global $connection;

    $sql = "SELECT * FROM users
    WHERE users.id_user = $id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultatRecup = $sth->fetch(PDO::FETCH_OBJ);
    return $resultatRecup;
}

/**
 * Permet de mettre a jour les information du compte
 */

function update_user($name, $last_name, $adress, $login, $id_user)
{
    global  $connection;


    $sql =  "UPDATE users
    SET  name = '$name', last_name = '$last_name', adress = '$adress', login = '$login'  
    WHERE id_user = $id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

/**
 * Permet de changer le mot de passe
 */
function update_password($old_password, $new_password, $id_user)
{
    global  $connection;

    $crypt_pass = decrypt($new_password);

    $sql = "SELECT password FROM users
    WHERE users.id_user = $id_user";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);



    if (password_verify($old_password, $resultat->password)) {

        $sql =  "UPDATE users
    SET  password = '$crypt_pass'
    WHERE id_user = $id_user";
        $sth = $connection->prepare($sql);
        $sth->execute();
    } else {
        echo ("mot de passe incorrect");
    }
}


/**
 * Permet de recupérer le produit pour l'afficher dans le panier 
 */
function recup_all_product($id_user)
{
    global $connection;

    $sql = "SELECT * FROM carts 
    INNER JOIN products ON products.id_product = carts.id_product
    INNER JOIN users ON users.id_user = carts.id_user
    LEFT JOIN tva on tva.id_tva = products.id_tva
    WHERE users.id_user = $id_user  AND carts.active = 1";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);
    return $resultat;
}


/**
 * Permet l'ajout au panier des infos du produit
 * Permet de rajouter à la quantity si le produit est déjà dans le panier
 */


function  insert_cart($id_product, $id_user, $price, $quantity_cart)
{


    global $connection;

    $sql = "SELECT id_product FROM carts 
    WHERE carts.id_user = $id_user AND id_product = $id_product AND active=1";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);


    if ($resultat) {
        update_cart($id_user, $id_product, $quantity_cart);
    } else {

        $sql_ins = "INSERT INTO  carts(id_product, id_user, price, quantity_cart) VALUES (:id_product, :id_user, :price, :quantity_cart)";

        $sth = $connection->prepare($sql_ins);
        $sth->execute(array(
            ':id_product' => (int) $id_product,
            ':id_user' => (int) $id_user,
            ':price' => (int) $price,
            ':quantity_cart' => (int) $quantity_cart


        ));
    }
}

function liste_quantity($id_product)
{
    global  $connection;
    //  req ordonnée par titre du produit
    $sql = "SELECT id_product, stock FROM products
    WHERE id_product = $id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetch(PDO::FETCH_OBJ);
    return $resultat;
}

/**
 * Permet de mettre a jour la quantité des produits
 */

function update_cart($id_user, $id_product, $quantity_cart)
{

    global $connection;

    $sql =  "UPDATE carts
    SET  quantity_cart = quantity_cart + $quantity_cart
    WHERE id_user = $id_user AND id_product=$id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

function update_quantity_cart($id_user, $id_product, $quantity_cart)
{

    global $connection;

    $sql =  "UPDATE carts
    SET  quantity_cart =  $quantity_cart
    WHERE id_user = $id_user AND id_product=$id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

function disabled_product_cart($id_product)
{
    global  $connection;

    $sql =  "UPDATE carts
    SET active = 0
    WHERE id_product = $id_product";
    $sth = $connection->prepare($sql);
    $sth->execute();
}


function delet_cart($id_user)
{
    global  $connection;

    $sql =  "DELETE carts
    WHERE id_user = $id_user AND id_payment = NULL";
    $sth = $connection->prepare($sql);
    $sth->execute();
}

function  insert_payment($id_user)
{

    global $connection;

    //On sélectionne le dernier numéro de facture dans la table Payment
    $sql = "SELECT MAX(number_ordered) as number_ordered FROM payment";
    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetch(PDO::FETCH_OBJ);

    // et on l'incrémente de +1 avant de l'ajouter 
    $res =   $resultat->number_ordered + 1;

    $sql_ins = "INSERT INTO  payment(id_user, number_ordered) VALUES (:id_user, :number_ordered)";

    $sth = $connection->prepare($sql_ins);
    $sth->execute(array(
        ':id_user' => $id_user,
        ':number_ordered' => $res

    ));

    //On récupère l'id payment qui vient de se créer et qu'on ne pouvait pas connaître avant l'insert afin de le réinjecter dans l'update du cart.
    $id_payment = $connection->lastInsertId();


    // Mise à jour de l'id_payment dans le panier et changement de l'état de validation à 1 (= paiement accepté) où l'id_user correspond au paiement 
    // et où il n'y a pas encore d'id_payment qu'on vient justement MAJ via cet update après récuprération par lastInsertId(). On rédirige ensuite l'user 
    // vers l'index en faisant passer la mention success dans l'URL pour faire un _GET et déclencher une modal de confirmation de commande (cf footer)
    $sql =  "UPDATE carts
    SET id_payment = $id_payment, validation=1
    WHERE id_user = $id_user AND id_payment = 0";
    $sth = $connection->prepare($sql);
    $sth->execute();


    //MAJ des stocks produits. Dans la table cart je select tout et je cible les id_payment pour travailler sur ceux qui concordent avec l'id_payment 
    //qui vient d'être créé lors du dernier paiement. Avec un fetchAll je récupère tout dont l'id_product qui me servira ensuite à faire un UPDATE. 
    //Attention, dans la table cart il peut y avoir plusieurs id_product (autant que de produits achetés) attachées à un seul id_payment. 
    $sql = "SELECT * FROM carts 
    WHERE id_payment = $id_payment";

    $sth = $connection->prepare($sql);
    $sth->execute();
    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    // On fait tourner le résultat dans un foreach pour faire un UPDATE dans la table products : 
    //On SET le stock_product en lui retirant la quantity_cart qui vient d'être achetée en ciblant l'id_product (WHERE) concerné. 

    foreach ($resultat as $row) {

        $sql = "UPDATE products
        SET stock = stock - $row->quantity_cart  
        WHERE id_product= $row->id_product";
        $sth = $connection->prepare($sql);
        $sth->execute();
    }

    header('Location: index.php?success=true');
    exit();
}

function recherche($recherche)
{
    global  $connection;
    // req ordonnée pas titre_article

    $sql =  "SELECT *  FROM products
    INNER JOIN categorys ON categorys.id_category = products.id_category
    WHERE  products.title_product LIKE '%$recherche%' AND products.active = 1 OR products.short_desc LIKE '%$recherche%' 
    AND products.active = 1 OR products.long_desc LIKE '%$recherche%' AND products.active = 1 AND  categorys.title_category LIKE '%$recherche%'";

    // var_dump($sql);



    $sth = $connection->prepare($sql);
    $sth->execute();

    $resultat = $sth->fetchAll(PDO::FETCH_OBJ);

    return $resultat;
}



    //detruire l'image si différente de la nouvelle image uploadée

    // if ($_FILES["image"]["name"] != "") {






    //     if ($resultat->title_picture != $_FILES["image"]["name"]) {

    //         @unlink("upload/" . $resultat->title_picture);

    //         $filename = img_load($id_product);
    //     }
    // }