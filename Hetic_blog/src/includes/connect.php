<?php
    
    define("DBHOST", "database:3306");
    define("DBUSER", "root");
    define("DBPASS", "password");
    define("DBNAME", "php_db");

    // Define DSN of connexion
    $dsn = "mysql:host=".DBHOST.";dbname=" . DBNAME;

    try{
        // Connect to the bdd with PDO
        $db = new PDO($dsn, DBUSER, DBPASS);

        // define method fetch data
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        
        echo "Connection failed: " . $e->getMessage();
    }
?>