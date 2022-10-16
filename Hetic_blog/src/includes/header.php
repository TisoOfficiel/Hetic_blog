<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <script type="text/javascript" src="./assets/js/app.js"></script>
    <link rel="stylesheet" href="./assets/style/style.css">
    <link rel="stylesheet" href="./assets/style/homepage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>
<body>
    <nav>
        <h1>
            <img src="https://hetic.arcplex.fr/wp-content/uploads/2021/10/logo-hetic-horizontal-300x129.png" alt="logo de hetic">
        </h1>
        <div class="right">
        <?php if(isset($_SESSION["user"])): ?>
            <?php 
                printf("Bonjour %s role: %s",$_SESSION['user']['username'],$_SESSION['user']['role'])
            ?>
            <a href="./logout.php">Déconnexion</a>
        <?php endif?> 
        </div>
    </nav>