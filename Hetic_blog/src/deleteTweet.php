<?php
    session_start();
    require_once "./includes/connect.php";
    if(!isset($_SESSION["user"])){
    header("Location: login.php");
    exit;
    }
    

    if(!empty($_POST)){
        if(isset($_POST["tweet_id"]) && !empty($_POST['tweet_id'])){
                switch ($_SESSION['user']['role']) {
                    case 'admin':
                        $id = $_POST['tweet_id'];
                        
                        $sql = "DELETE FROM `Tweets` WHERE `id` = $id";

                        $requete = $db->query($sql);
                        break;
                    case 'user':
                        if($_SESSION['user']['id']==$_POST['user_id']){
                            $id = $_POST['tweet_id'];

                            $sql = "DELETE FROM `Tweets` WHERE `id` = $id";

                            $requete = $db->query($sql);
                        }
                        break;
                    default:
                        print('non');
                        break;
                }
        }
        
        header("Location: homepage.php"); 
    }
    
    
?>