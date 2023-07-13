<?php 
    $hostname = "localhost";
    $banco_de_dados = "cadastro";
    $usuario = "root";
    $senha = "";

    $mysqli = new mysqli($hostname, $usuario, $senha, $banco_de_dados);
    if ($mysqli->error) {
        die("Falha ao conectar ao banco de dados: " . $mysqli->error);
    }
?>