<!-- ARTIGOS -->
<?php
    if(isset($_REQUEST["cadastrarArtigo"])) { //Se cadastrou um artigo, vai subir esse alerta
?>
   <div id="cadastrarArtigo" class="alert alert-success alert-dismissible fade show position-absolute bottom-0 end-0 me-2" style="z-index: 2" role="alert">
        <strong>Artigo cadastrado com sucesso!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("cadastrarArtigo").style.display = "none";
            window.history.pushState("", "", "?");
        }, 3000);
    </script>
<?php
    }
    if(isset($_REQUEST["editarArtigo"])) { //Se editou um artigo, vai subir esse alerta
?>
    <div id="editarArtigo" class="alert alert-warning alert-dismissible fade show position-absolute bottom-0 end-0 me-2" style="z-index: 2" role="alert">
        <strong>Artigo editado com sucesso!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("editarArtigo").style.display = "none";
            window.history.pushState("", "", "?");
        }, 3000);
    </script>
<?php
    }
?>
<?php
    if(isset($_REQUEST["deletarArtigo"])) { //Se deletar um artigo, vai subir esse alerta
?>
   <div id="deletarArtigo" class="alert alert-danger alert-dismissible fade show position-absolute bottom-0 end-0 me-2" style="z-index: 2" role="alert">
        <strong>Artigo deletado com sucesso!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("deletarArtigo").style.display = "none";
            window.history.pushState("", "", "?");
        }, 3000);
    </script>
<?php
}
?>

<!-- AUTORES -->
<?php 
    if(isset($_REQUEST["autorCadastrado"])) { //Se cadastrou um autor, vai subir esse alerta
?>
    <div id="autorCadastrado" class="alert alert-success alert-dismissible fade show position-absolute bottom-0 end-0 me-2" style="z-index: 2" role="alert">
        <strong>Autor cadastrado com sucesso!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("autorCadastrado").style.display = "none";
            window.history.pushState("", "", "?");
        }, 3000);
    </script>
<?php
    }
    if(isset($_REQUEST["editarAutor"])) { //Se editou um autor, vai subir esse alerta
?>
    <div id="autorEditado" class="alert alert-warning alert-dismissible fade show position-absolute bottom-0 end-0 me-2" style="z-index: 2" role="alert">
        <strong>Informações do Autor alteradas com sucesso!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("autorEditado").style.display = "none";
            window.history.pushState("", "", "?");
        }, 3000);
    </script>
<?php
    }
    if(isset($_REQUEST["deletarAutor"])) { //Se deletou um autor, vai subir esse alerta
?>
    <div id="deletarAutor" class="alert alert-danger alert-dismissible fade show position-absolute bottom-0 end-0 me-2" style="z-index: 2" role="alert">
        <strong>Autor deletado com sucesso!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("deletarAutor").style.display = "none";
            window.history.pushState("", "", "?");
        }, 3000);
    </script>
<?php
    }
?>