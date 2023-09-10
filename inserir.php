<?php
    //Conectando no banco
    include("./bd/conexao.php");

    //Se vier da pagina de artigo, vai salvar nessa variavel
    $isArtigo = $_REQUEST["isArtigo"];

    //Se vier da pagina de artigo, vai entrar nesse if e inserir o artigo
    if($isArtigo == "sim") {
        $titulo = $_REQUEST["titulo"];
        $descricao = $_REQUEST["descricao"];
        $data = $_REQUEST["data_publicado"];
        $hora = $_REQUEST["hora_publicado"];
        $id_autor = $_REQUEST["autor"];

        if(isset($id_autor) != 1) { // Se o autor não for selecionado, ele vai entrar nessa condição e alertar
            header("Location: index.php?autorInvalido=1");
        } else { // Se tiver tudo ok, ele entra nessa condição e insere o artigo
            $sql = "INSERT INTO artigo (titulo, descricao, data_publicado, hora_publicado, id_autor) VALUES (:titulo, :descricao, :data_publicado, :hora_publicado, :id_autor)";

            $stmt = $con->prepare($sql);
            $stmt->bindParam(":titulo", $titulo);
            $stmt->bindParam(":descricao", $descricao);
            $stmt->bindParam(":data_publicado", $data);
            $stmt->bindParam(":hora_publicado", $hora);
            $stmt->bindParam(":id_autor", $id_autor);

            if($stmt->execute()){
                //echo "Artigo salvo com sucesso!";
                header("Location: index.php?cadastrarArtigo=1"); //Quando cadastrar o artigo, ele vai mandar pro index e subirá um alerta de confirmação
            }
        }
    } else { // Se vier da pagina de autor vai entrar nessa condição e inserir o autor
        $nome = $_REQUEST["nome"];
        $data_nascimento = $_REQUEST["data_nascimento"];
        $situacao = $_REQUEST["situacao"];
        $telefone = $_REQUEST["telefone"];
        $email = $_REQUEST["email"];
        $sexo = $_REQUEST["sexo"];

        if(isset($situacao) == NULL) { // Se a situação do autor não for selecionada, ele vai entrar nessa condição e alertar
            header("Location: autores.php?situacaoInvalido=1");
        } elseif (isset($sexo) == NULL) { // Se o sexo do autor não for selecionado, ele vai entrar nessa condição
            header("Location: autores.php?sexoInvalido=1");
        } else { // Se tiver tudo ok, ele entra nessa condição e insere o autor
            $sql = "INSERT INTO autor (nome, data_nascimento, situacao, telefone, email, sexo) VALUES (:nome, :data_nascimento, :situacao, :telefone, :email, :sexo)";
        
            $stmt = $con->prepare($sql);
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":data_nascimento", $data_nascimento);
            $stmt->bindParam(":situacao", $situacao);
            $stmt->bindParam(":telefone", $telefone);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":sexo", $sexo);
            
            if($stmt->execute()){
                //echo "Autor salvo com sucesso!";
                header("Location: autores.php?autorCadastrado=1"); //Quando cadastrar o autor, ele vai mandar pro autores e subirá um alerta de confirmação
            }
        }
    }
?>