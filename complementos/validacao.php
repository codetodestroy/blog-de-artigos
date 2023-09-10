<?php
    if(isset($_REQUEST["autorInvalido"])) { //Se não selecionarem o autor, vai alertar 
?>
    <script>
        alert("Não deu certo!\nVocê deve informar um Autor cadastrado!");
    </script>
<?php
    } else if(isset($_REQUEST["situacaoInvalido"])) { //Se não selecionarem a situação, vai alertar
?>
    <script>
        alert("Não deu certo!\nVocê deve informar a situação do Autor!");
    </script>
<?php
    } else if (isset($_REQUEST["sexoInvalido"])) { //Se não selecionarem o sexo, vai alertar
?>
    <script>
        alert("Não deu certo!\nVocê deve informar o sexo do Autor!");
    </script>
<?php
    }
?>