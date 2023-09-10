<?php
    //Setando padrão data/hora para Brasil
    date_default_timezone_set("America/Sao_Paulo"); 
    
    //Importando arquivos de conexão com o banco de dados, alertas, validações e hora
    include("./bd/conexao.php");
    include("./complementos/alertas.php");
    include("./complementos/validacao.php");
    include("./complementos/hora.php");

    //Preparando QUERY invertido para listar - Artigos mais recentes aparecem em primeiro.
    $consultaArtigo = $con->query("SELECT * FROM artigo ORDER BY data_publicado, hora_publicado DESC");
    $artigos = $consultaArtigo->fetchAll();

    //Preparando QUERY para listar o autor
    $consultaAutor = $con->query("SELECT * FROM autor");
    $autores = $consultaAutor->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>PÁGINA INICIAL - Artigos Publicados</title>
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">

        <!-- IMPORT BOOSTRAP -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body class="p-3 mb-2 bg-dark bg-opacity-75">
        <main class="container ">
            <!-- MENU -->
            <div class="container text-center text-dark">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline-primary text-white" data-bs-toggle="modal" data-bs-target="#novoArtigo">Publicar um novo artigo</button>
                    <a href="./autores.php" class="btn btn-outline-light">Visualizar autores</a>
                </div>
            </div>

            <!-- ARTIGOS -->
            <h1 class="text-white text-center p-4">ARTIGOS PUBLICADOS</h1>
            <section class="bg-primary mt-2 p-3 rounded">
            <?php 
                if(!empty($artigos)) {//Se a tabela artigo tiver registros, vai entrar nesse if e exibir os artigos
                    foreach($artigos as $artigo) {//O ForEach vai iterar por cada artigo e puxar os dados da tabela autor, de acordo com o autor do artigo
                        $sql = "SELECT * FROM autor where autor.id_autor = :id";
                        $stmt = $con->prepare($sql);
                        $stmt->bindParam(":id", $artigo["id_autor"]);
                        $stmt->execute();
                        $autor = $stmt->fetch(\PDO::FETCH_ASSOC);
            ?>
                <article class="bg-light mb-4 p-3 rounded position-relative">
                    <div class="text-end">
                        <a href="editarArtigo.php?id_artigo=<?php echo $artigo["id_artigo"]//Retorna o ID do artigo e manda para editarArtigo.php?>" class="btn btn-warning">Editar artigo</a>
                        <a href="deletar.php?id_artigo=<?php echo $artigo["id_artigo"]//Retorna o ID do artigo e manda para deletar.php?>" class="btn btn-danger">Deletar artigo</a>
                    </div>
                    <h1 class="mb-4" style="word-wrap: break-word">
                        <?php echo $artigo["titulo"]//Retorna o titulo do artigo baseado no ID?>
                    </h1>
                    <p class="fs-5" style="word-wrap: break-word">
                        <?php echo $artigo["descricao"]//Retorna a descrição do artigo baseado no ID?>
                    </p>
                    <footer>
                        <p class="text-end">Publicado por: <span class="fw-bold"><?php echo $autor["nome"]//Retorna o nome do autor baseado no id_autor do Artigo?></span> às <?php echo $artigo["hora_publicado"]?> em <?php echo converte_data($artigo["data_publicado"])?></p>
                    </footer>
                </article>
                <?php
                    }
                } else {//Se a tabela ARTIGO estiver vazia, irá mostrar essa mensagem.
                ?>
                     <article class="bg-light p-3 rounded text-center fs-3 text">Não tem nenhum artigo publicado...</article>
                <?php
                }
                ?>
            </section>
            
            <!-- MODAL DE CADASTRAR NOVO ARTIGO -->
            <div class="modal fade" id="novoArtigo" tabindex="-1" aria-labelledby="novoArtigoLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="novoArtigoLabel">Informações do novo artigo...</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="inserir.php" method="POST">
                                <div class="mb-3">
                                    <label for="titulo" class="form-label">Titulo</label>
                                    <input type="text" class="form-control" id="titulo" name="titulo" aria-describedby="titulo" required>
                                    <div id="tituloHelp" class="form-text">Aqui você digita o título do seu artigo.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="autor" class="form-label">Autor</label>
                                    <select class="form-select" aria-label="Default select example" name="autor" id="autor" required>
                                        <option selected disabled value="0">Selecione...</option>
                                    <?php
                                        foreach($autores as $autor) {//Retorna a lista dos autores cadastrados
                                            echo "<option value=".$autor['id_autor'].">".$autor['nome']."</option>";
                                        }
                                    ?>
                                    </select>
                                </div>
                                <input type="hidden" name="data_publicado" value="<?php echo date("Y-m-d")//Data publicado?>">
                                <input type="hidden" name="hora_publicado" value="<?php echo date("H:i:s")//Hora publicado?>">
                                <input type="hidden" name="isArtigo" value="sim"><!-- Usado para identificar como artigo em inserir.php -->
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary" value="Publicar artigo">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <p class="text-center mt-3">© 2023 Linguagem Técnica de Programação 2 - FACULDADE SENAC - Todos os direitos reservados.</p>
        </footer>

        <!-- IMPORT JS BOOSTRAP -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    </body>
</html>