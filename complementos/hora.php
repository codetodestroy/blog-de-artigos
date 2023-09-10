<?php 
    //Função que converte a data da publicação
    function converte_data($data) {
        $timestamp = strtotime($data);
        $new_date = date("d/m/Y", $timestamp);
        return $new_date;
    }
?>