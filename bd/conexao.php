<?php
    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "");
    define("DBNAME", "blog");
    define("PORT", "3307");

    //Cria a conexão com banco de dados usando o PDO
    $con = new pdo("mysql:host=".HOST.";dbname=".DBNAME, USER, PASS);

    if($con) {
        //echo "Conectado com sucesso no banco de dados!";
    } else {
        echo "Não conseguimos conectar no banco de dados!";
    }
?>