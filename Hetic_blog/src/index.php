<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: homepage.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style/index.css">
    <link rel="stylesheet" href="./assets/style/style.css">
    <title>Blog HETIC</title>
</head>
<body>
    <div class="container">
        <div class="container-content">
            <div class="content-title">
                <h1>Bienvenue Héticien</h1>
            </div>
            <div class="content-link">
                <a href="./login.php" class="link">Se connecter</a>
                <a href="./register.php" class="link">S'incrire</a>
            </div>
        </div>
    </div>
</body>
</html>