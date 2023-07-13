<?php 
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['id'])) {
        die("Você não está pode acessar essa página porque não está logaso.<p><a href=\"sign_in.php\">Entrar</a></p>");
    }
?>