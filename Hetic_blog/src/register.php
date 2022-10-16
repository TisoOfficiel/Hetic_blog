<?php
session_start();

if(isset($_SESSION["user"]))
{
    header("Location: index.php");
    exit;
}
if(!empty($_POST)){
    // Form send
    if(isset($_POST["last_name"],$_POST["first_name"],$_POST["login"],$_POST["password"],$_POST["confirm_password"]) && !empty($_POST['last_name']) && !empty($_POST['first_name']) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])
    ){
        // Hash password
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $confirm_password = $_POST['confirm_password'];

        //Comparaison password and confirm password
        if(!password_verify($confirm_password,$password)){
            die ("non");
        }

        // Form complete
        $last_name = strip_tags($_POST['last_name']);
        $first_name = strip_tags($_POST['first_name']);
        $login = strip_tags($_POST['login']);
        $role = "user";
        $created_at = date('Y-m-d h:i:s');
        $updated_at = $created_at;
        require_once "./includes/connect.php";
        
        $sql = "INSERT INTO `Users` (`lastName`,`firstName`,`login`,`password`,`role`,`created_at`,`updated_at`) VALUES (:lastName, :firstName, :login, '$password','user','$created_at','$updated_at')";

        $query = $db->prepare($sql);

        $query->bindValue(":lastName", $last_name, PDO::PARAM_STR);
        $query->bindValue(":firstName", $first_name, PDO::PARAM_STR);
        $query->bindValue(":login", $login, PDO::PARAM_STR);

        $query->execute();

        // recup ID
        $id = $db->lastInsertId();
        //Connect user
        $_SESSION["user"]=[
            "id" => $id,
            "username" => $login,
            "last_name" => $last_name,
            "first_name" =>$first_name,
            "role"=>$role,
        ];

        header("Location: profile.php");
        
    }else{
        die("Formulaire incomplet");
    }
    
}    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement</title>
    <link rel="stylesheet" href="./assets/style/style.css">
    <link rel="stylesheet" href="./assets/style/register.css">
</head>
<body>
    <div class="container">
        <div class="content-left"></div>
        <div class="content-right">
            <h1>Pour s'enregistrer</h1>
            <form action="" method="post">
                <input placeholder="Nom" id="last_name" type="text" name="last_name"> </label>
                
                <input placeholder="Prénom" id="first_name" type="text" name="first_name">

                <input placeholder="Identifiant" id="login" type="text" name="login">

                <input placeholder="Mot de passe" id="password" type="password" name="password">

                <input placeholder="Confirmer le mot de passe" id="confirm_password" type="password" name="confirm_password">

                <button class="register"ype="submit" name="submit">S'inscrire</button>
            </form>
        </div>
    </div>

    <?php if (! empty($message)) { ?>
        <p class="errorMessage"><?php echo $message; ?></p>
    <?php } ?>
</body>
</html>