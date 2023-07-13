<?php 
    include ('conexao.php');
    
    $error="";
    $error_email="";
    $error_password="";

    if (isset($_POST['email']) || isset($_POST['password'])) {
        if (strlen($_POST['email']) == 0) {
            $error_email = "*Preencha o email";
        } elseif (strlen($_POST['password']) == 0) {
            $error_password = "*Preencha a senha";
        } else {
            // Proteção contra hackers 
            $email = $mysqli->real_escape_string($_POST['email']);
            $password = $mysqli->real_escape_string($_POST['password']);
            // Esse é o comando
            $sql_code = "SELECT * FROM cadastro.usuarios WHERE email = '$email' AND senha = '$password'"; 
            // Esse é quem executa o comando
            $sql_query = $mysqli->query($sql_code) or die("Falha ma conexão SQL: " . $mysqli->error);
            
            // Verificação se esse E-mail existe
            $quantidade = $sql_query->num_rows;
            
            if ($quantidade == 1) {
                
                $usuario = $sql_query->fetch_assoc();
                
                if (!isset($_SESSION)) {
                    session_start();
                }
                
                $_SESSION['id'] = $usuario['id'];       
                $_SESSION['nome'] = $usuario['nome'];       

                header("Location: painel.php");

            } else {
                $error = "Falha ao logar! E-mail ou senha incorretos";
            }
        }
    }
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>Sign in</h1>
        <form action="" method="post">
            <label for="email">E-mail</label><span><strong><?=" $error_email"?></strong></span>
            <p><input type="email" name="email" id="email" value=""></p>
            <label for="password">Senha</label><span><strong><?=" $error_password"?></strong></span>
            <p><input type="password" name="password" id="password" value=""></p>
            <input type="submit" value="Enviar">
            <p><?=$error?></p>
        </form>
        <p><a href="index.html">Voltar</a></p>
    </main>
</body>
</html>