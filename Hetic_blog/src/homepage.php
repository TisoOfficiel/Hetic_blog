<?php
session_start();
require_once "./includes/connect.php";

if(!isset($_SESSION["user"])){
    header("Location: index.php");
    exit;
}
        $all_tweet = 'SELECT * FROM Tweets';
        $reponse = $db->query($all_tweet);
        $data = $reponse->fetchALL();
         
if(!empty($_POST)){
    // Form send
    if(isset($_POST["tweet"],) && !empty($_POST['tweet'])
    ){
        
        // Form complete
        $username = $_SESSION['user']['username'];
        $user_id = $_SESSION['user']['id'];
        $content = strip_tags($_POST['tweet']);
        $created_at = date('Y-m-d H:i:s');
        $updated_at = $created_at;

        
        $sql = "INSERT INTO `Tweets` (`user_id`,`author`,`content`,`created_at`,`updated_at`) VALUES ('$user_id','$username',:content,'$created_at','$updated_at')";

        $query = $db->prepare($sql);

        $query->bindValue(":content", $content, PDO::PARAM_STR);

        $query->execute();

        header("Refresh:0");
    };
}

    require_once "./includes/header.php";
?>
    <div class="container">
        <div class="container-left"></div>
        <div class="container-center">
            <div class="tweet-create-container">
                <div class="profil-picture"></div>
                <form action="" method="POST">
                    <input type="text" placeholder="Créer un post" name="tweet" id="tweet"></input>
                    <input id="create-tweet"type="submit" value="Tweeter">
                </form>
            </div>
            <div class="seperator"><span></span></div>
            <?php         
                foreach ($data as $key){
                    echo '<div class="container-tweet">';
                        echo '<div class="profil-picture"></div>';
                        echo '<div class="tweet-content">';
                        $input = $key['updated_at'];
                        $date = strtotime($input);
                        $updated_at= date('d M', $date);
                        $id=$key['id'];
                       
                        printf("<span>@%s</span>",$key['author']);
                        echo "\n" . $updated_at;
                        printf("<p id=$id class='tweet-content-text'>%s</p>",$key['content']);
                         if($key['user_id']==$_SESSION['user']['id']|| $_SESSION['user']['role']=='admin'){
                            echo "<div class='more-option'>";
                            printf('<button onclick=editTweet(%d,%d)>Editer</button>',$key['user_id'],$key['id']);
                             printf("
                             <form action='./deleteTweet.php' method='post'>
                                 <input type='hidden' name='tweet_id' value='%d'>
                                 <input type='hidden' name='user_id' value='%d'>
                                 <input class='submit' type='submit' name='submitDelete' value='Supprimer'>
                             </form>
                             ",$key['id'],$key['user_id']);
                             echo "</div>";
                        }
                        echo "</div>";
                    echo "</div>";
                }
                require_once "./includes/footer.php";
            ?>
        </div>
        <div class="container-right"></div>
    </div>

    <div id="modalEdit" class="containerModalBackground" style ="display:none">
        <div class="containerModal">
            <h1>Modifier votre tweet</h1>
            <i class="material-icons close" onclick="closeModal()">close</i>
            <form id="formEdit" action="./editTweet.php" method="POST">
                <input type='hidden' id="tweet_id" name='tweet_id' value="">
                <input type='hidden' id="user_id" name='user_id' value="">
                <input type="text" name="tweet_content" id="content_tweet_edit"></input>
                <input id="submitEdit" type="submit" name="submitEdit" value="Modifier">
            </form>
        </div>
    </div>
    