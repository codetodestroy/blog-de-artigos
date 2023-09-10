<?php
    //Importando arquivos de conexão com o banco de dados, alertas e validações
    include("./bd/conexao.php");
    include("./complementos/alertas.php");
    include("./complementos/validacao.php");

    //Preparando QUERY invertido para listar - Autores cadastrados mais recentes aparecem em primeiro.
    $consultaAutor = $con->query("SELECT * FROM autor ORDER BY id_autor DESC");
    $autores = $consultaAutor->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Autores Cadastrados</title>

        <link rel="icon" type="image/x-icon" href="img/favicon.ico">

        <!-- IMPORT BOOSTRAP -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body class="p-3 mb-2 text-dark bg-dark bg-opacity-75">
        <main class="container">
            <!-- MENU -->
            <div class="container text-center">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <a href="./index.php" class="btn btn-primary">Voltar para a Página Inicial</a>
                </div>
            </div>

            <!-- AUTORES -->
            <h1 class="text-white text-center p-4">AUTORES CADASTRADOS</h1>
            <section class="bg-white mt-2 p-3 rounded">
                <?php 
                if(!empty($autores)) {//Se a tabela autor tiver registros, vai entrar nesse if e exibir os autores
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOME</th>
                            <th scope="col">DATA DE NASCIMENTO</th>
                            <th scope="col">SITUAÇÃO</th>
                            <th scope="col">TELEFONE</th>
                            <th scope="col">E-MAIL</th>
                            <th scope="col">SEXO</th>
                            <th scope="col">AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($autores as $autor) {//O foreach vai iterar por cada autor e puxar os dados de cada registro e mostrar as info
                        ?>
                        <tr>
                            <td><?php echo $autor["id_autor"]?></td>
                            <td><?php echo $autor["nome"]?></td>
                            <td><?php echo $autor["data_nascimento"]?></td>
                            <td><?php echo $autor["situacao"]?></td>
                            <td><?php echo $autor["telefone"]?></td>
                            <td><?php echo $autor["email"]?></td>
                            <td><?php echo $autor["sexo"]?></td>
                            <td>
                                <a href="editarAutor.php?id_autor=<?php echo $autor["id_autor"]//Retorna o ID do autor e manda para editarAutor.php?>" class="btn btn-warning">Editar</a>
                                <a href="deletar.php?id_autor=<?php echo $autor["id_autor"]//Retorna o ID do autor e manda para deletar.php?>" class="btn btn-danger" id="btn-deletar">Deletar</a>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <?php 
                } else {//Se a tabela AUTORES estiver vazia, irá mostrar essa mensagem.
                ?>
                    <article class="bg-light p-3 rounded text-center fs-3 text">Não tem nenhum autor cadastrado...</article>
                <?php
                }
                ?>
                <!-- MODAL DE CADASTRAR NOVO AUTOR -->
                <div class="modal fade" id="novoAutor" tabindex="-1" aria-labelledby="novoAutorLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="novoAutorLabel">Informações do novo autor...</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="inserir.php" method="POST">
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" aria-describedby="nome" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" aria-describedby="data_nascimento" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="situacao" class="form-label">Situação</label>
                                        <select class="form-select" aria-label="Default select example" name="situacao" id="situacao" required>
                                            <option selected disabled>Selecione a situação do autor...</option>
                                            <option value="0">Inativo</option>
                                            <option value="1">Ativo</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="tel" class="form-control" id="telefone" name="telefone" aria-describedby="telefone" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sexo" class="form-label">Sexo</label>
                                        <select class="form-select" aria-label="Default select example" name="sexo" id="sexo" required>
                                            <option selected disabled value="0">Selecione o sexo...</option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Feminino</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-outline-success" value="Cadastrar autor">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BOTÃO PARA ABRIR MODAL DE CADASTRAR AUTOR -->
                <button class="btn btn-success mt-2" data-bs-toggle="modal" data-bs-target="#novoAutor">Cadastrar novo autor</button>
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