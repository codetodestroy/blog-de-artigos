<?php
    //Importando arquivos de conexão com o banco de dados, alertas e validações
    include("./bd/conexao.php");
    include("./complementos/alertas.php");
    include("./complementos/validacao.php");

    //Está puxando o dado de acordo com o numero do seu id
    if(isset($_REQUEST["id_artigo"])) {
        $id = $_REQUEST["id_artigo"];
        $sql = "SELECT * FROM artigo WHERE id_artigo = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $artigo = $stmt->fetch(\PDO::FETCH_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Editando Artigo</title>
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">

        <!-- IMPORT BOOSTRAP -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body class="p-3 mb-2 bg-dark bg-opacity-75">
        <main class="container ">
            <div class="container text-center text-dark">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <a href="index.php" class="btn btn-danger">Voltar para Artigos</a>
                </div>
            </div>
            <h1 class="text-white text-center p-4">EDITANDO ARTIGO: <?php echo $artigo["titulo"] //Informa o titulo do artigo?> </h1>
            <section class="bg-warning mt-2 p-3 rounded">
                <form action="editar.php" method="POST">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Titulo</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" aria-describedby="titulo" value="<?php echo isset($artigo["titulo"]) ? $artigo["titulo"] : "" //retorna o titulo para editar ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required><?php echo isset($artigo["descricao"]) ? $artigo["descricao"] : ""//retorna a descricao para editar ?></textarea>
                    </div>
                    <input type="hidden" name="id_artigo" value="<?php echo isset($artigo["id_artigo"]) ? $artigo["id_artigo"] : "" // Vai mandar o id que vamos alterar escondido?>">
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Editar artigo">
                    </div>
                </form>
            </section>
        </main>
        <footer>
            <p class="text-center mt-3">© 2023 Linguagem Técnica de Programação 2 - FACULDADE SENAC - Todos os direitos reservados.</p>
        </footer>

        <!-- IMPORT JS BOOSTRAP -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    </body>
</html>