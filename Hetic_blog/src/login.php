<?php

session_start();

if(isset($_SESSION["user"]))
{
    header("Location: index.php");
    exit;
}
if(!empty($_POST)){
    
    //Form send     
    if(isset($_POST["login"], $_POST["password"])
        && !empty($_POST["login"] && !empty($_POST["password"]))
    ){
        require_once "./includes/connect.php";
        
        $sql = "SELECT * FROM `Users` where `login`= :login";

        $query = $db->prepare($sql);

        $query->bindValue(":login", $_POST["login"], PDO::PARAM_STR);

        $query->execute();

        $user = $query->fetch();
        
        if(!$user){
            die("L'utilisateur et/ou le mot de passe n'existe pas");
        }
        //User exist
        if(!password_verify($_POST["password"], $user["password"])){
            die("L'utilisateur et/ou le mot de passe n'existe pas");
        }
        // Password is validate
        $_SESSION["user"]=[
            "id" => $user["id"],
            "username" => $user["login"],
            "last_name" => $user["lastName"],
            "first_name" =>$user["firstName"],
            "role"=>$user["role"],
        ];

        header("Location: homepage.php");

    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/style/style.css">
    <link rel="stylesheet" href="./assets/style/login.css">
</head>
<body>
    <div class="container">
        <div class="content-left"></div>
        <div class="content-right">
            <h1>Pour se connecter</h1>
            <form action="" method="post">
                
                <input placeholder="Identifiant" id="login" type="text" name="login">
                <input placeholder="Mot de passe" id="password" type="password" name="password">

                <button type="submit" class="login" name="submit">Se connecter</button>
            </form>
        </div>
    </div>
    

<?php
    include_once "./includes/footer.php";
?>