<?php
    //Conectando no banco de dados
    include("./bd/conexao.php");

    if(isset($_REQUEST["id_artigo"])) {
        $titulo = $_REQUEST["titulo"];
        $descricao = $_REQUEST["descricao"];
        $data_publicado = $_REQUEST["data_publicado"];
        $hora_publicado = $_REQUEST["hora_publicado"];
        $id_artigo = $_REQUEST["id_artigo"];
    
        $sql = "UPDATE artigo SET titulo = :titulo, descricao = :descricao WHERE id_artigo = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":titulo", $titulo);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":id", $id_artigo);
    
        if($stmt->execute()) {
            //echo "Artigo editado com sucesso!";
            header("Location: index.php?editarArtigo=1"); //Quando editar algum artigo, ele vai mandar pro index e subirá um alerta
        }
    }

    if(isset($_REQUEST["id_autor"])) {
        $nome = $_REQUEST["nome"];
        $data_nascimento = $_REQUEST["data_nascimento"];
        $situacao = $_REQUEST["situacao"];
        $telefone = $_REQUEST["telefone"];
        $email = $_REQUEST["email"];
        $sexo = $_REQUEST["sexo"];
        $id_autor = $_REQUEST["id_autor"];
    
        $sql = "UPDATE autor SET nome = :nome, data_nascimento = :data_nascimento, situacao = :situacao, telefone = :telefone, email = :email, sexo = :sexo WHERE id_autor = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":data_nascimento", $data_nascimento);
        $stmt->bindParam(":situacao", $situacao);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":sexo", $sexo);
        $stmt->bindParam(":id", $id_autor);
    
        if($stmt->execute()) {
            //echo "Autor editado com sucesso!";
            header("Location: autores.php?editarAutor=1"); //Quando editar algum autor, ele vai mandar pro autores e subirá um alerta
        }
    } 
?>