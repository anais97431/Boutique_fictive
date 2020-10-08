<?php
include "include.php";
// https://developers.google.com/identity/sign-in/web/sign-in
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- META GOOGLE -->
    <meta name="google-signin-client_id" content=<?php echo key_google ?>>
    <!--  -->
    <title>Document</title>
    <!-- javascript google -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <!--jquery  -->
    <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
</head>

<body>


    <a href="#" onclick="signOut();">Sign out</a>
    <br>
    <br>
    <br>

    <div class="g-signin2" data-onsuccess="onSignIn"></div>

    <script>
    // Connexion login Goggle 
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.

        ajaxgoogle(profile.getId(), prodfile.getName(), profile.getEmail())
    }



    // Deconnexion login Goggle 
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function() {
            console.log('User signed out.');
        });
    }


    function ajaxgoogle(id, name, mail){
        $.podt("demo_test_post.php", {
            id: id,
            name: name,
            mail: mail
        },
        function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });
    }
    </script>


</body>

</html>