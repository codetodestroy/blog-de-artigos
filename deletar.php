<?php
    //Importando para conectar no banco
    include("./bd/conexao.php");

    if($_REQUEST["id_artigo"]) { //Se no POST estiver o id do artigo vai entrar nesse if e deletar
        $id_artigo = $_REQUEST["id_artigo"];

        $sql = "DELETE FROM artigo WHERE id_artigo = :id_artigo";
    
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":id_artigo", $id_artigo);
    
        if($stmt->execute()){
            header("Location: index.php?deletarArtigo=1");//Quando deletar algum artigo, ele vai mandar pro index e subirá um alerta
        } 
    } else { //Senão entra nessa condição e vai deletar o autor
        $id_autor = $_REQUEST["id_autor"];

        $sql = "DELETE FROM autor WHERE id_autor = :id_autor";
    
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":id_autor", $id_autor);
    
        if($stmt->execute()){
            header("Location: autores.php?deletarAutor=1");//Quando deletar algum autor, ele vai mandar pro autores e subirá um alerta
        }
    }
?>