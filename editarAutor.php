<?php
    //Importando arquivos de conexão com o banco de dados, alertas e validações
    include("./bd/conexao.php");
    include("./complementos/alertas.php");
    include("./complementos/validacao.php");

    //Está puxando o dado de acordo com o numero do seu id
    if(isset($_REQUEST["id_autor"])) {
        $id = $_REQUEST["id_autor"];
        $sql = "SELECT * FROM autor WHERE id_autor = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $autor = $stmt->fetch(\PDO::FETCH_ASSOC);
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Editando Informações do Autor</title>
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">

        <!-- IMPORT BOOSTRAP -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body class="p-3 mb-2 text-dark bg-dark bg-opacity-75">
        <main class="container">
            <div class="container text-center">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <a href="./autores.php" class="btn btn-danger">Voltar para Autores</a>
                </div>
            </div>
            <h1 class="text-white text-center p-4">EDITANDO INFORMAÇÕES DO AUTOR: <?php echo $autor["nome"] //Informa o nome do autor?></h1>
            <section class="bg-warning mt-2 p-3 rounded">
                <!-- Vai retornar os dados do autor para editar -->
                <form action="editar.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" aria-describedby="nome" value="<?php echo isset($autor["nome"]) ? $autor["nome"] : ""?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" aria-describedby="data_nascimento" value="<?php echo isset($autor["data_nascimento"]) ? $autor["data_nascimento"] : "" ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="situacao" class="form-label">Situação</label>
                        <select class="form-select" aria-label="Default select example" name="situacao" id="situacao" required>
                            <option disabled>Selecione a situação do autor...</option>
                            <?php 
                                if($autor["situacao"] == 0) {
                                    echo "<option selected value='0'>Inativo</option>";
                                    echo "<option value='1'>Ativo</option>";
                                } else {
                                    echo "<option value='0'>Inativo</option>";
                                    echo "<option selected value='1'>Ativo</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" aria-describedby="telefone" value="<?php echo isset($autor["telefone"]) ? $autor["telefone"] : "" ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="<?php echo isset($autor["email"]) ? $autor["email"] : "" ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select" aria-label="Default select example" name="sexo" id="sexo" required>
                            <option disabled>Selecione o sexo...</option>
                            <?php 
                                if($autor["sexo"] == "M") {
                                    echo "<option selected value='M'>Masculino</option>";
                                    echo "<option value='F'>Feminino</option>";
                                } else {
                                    echo "<option value='M'>Masculino</option>";
                                    echo "<option selected value='F'>Feminino</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="id_autor" value="<?php echo isset($autor["id_autor"]) ? $autor["id_autor"] : "" ?>">
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Editar autor">
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