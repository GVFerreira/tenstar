<?php
    include('connect.php');

    if(isset($_POST['email']) || isset($_POST['senha'])) {

        if(strlen($_POST['email']) == 0) {
            echo '
                <div style="display: flex; justify-content: center">
                    <h1 style="color: red;">Preencha seu e-mail</h1>
                </div>
            ';
        } else if(strlen($_POST['senha']) == 0) {
            echo '
            <div style="display: flex; justify-content: center">
                <h1 style="color: red;">Preencha sua senha</h1>
            </div>
        ';
        } else {

            $email = $mysqli->real_escape_string($_POST['email']);
            $senha = $mysqli->real_escape_string($_POST['senha']);

            $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

            $quantidade = $sql_query->num_rows;

            if($quantidade == 1) {
                
                $usuario = $sql_query->fetch_assoc();

                if(!isset($_SESSION)) {
                    session_start();
                }

                $_SESSION['id'] = $usuario['id'];
                $_SESSION['nome'] = $usuario['nome'];

                header("Location: aulas/videos.php");

            } else {
                echo '
                <div style="display: flex; justify-content: center">
                    <h1 style="color: red;">Falha ao logar. Dados incorretos</h1>
                </div>
            ';
            }

        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1">
        
        <link rel="stylesheet" type="text/css" href="./css/login.css">
        <script src="https://kit.fontawesome.com/baecbeb80d.js" crossorigin="anonymous"></script>

        <title>Portal de Acesso</title>

    </head>
    <body>
        <div class="container">
            <div class="fundo" style="background: url(./img/fundo-login.png) no-repeat center center; background-size: cover">

            </div>
            <div class="formulario">
                <a href="index.php"  class="logo-color-2"><span class="logo-color-1">Ten</span>Star 1.0</a>
                <h2 class="titulo-formulario">Log in</h2>

                <form action="" method="POST">
                    <div class="input-formulario">
                        <i class="fa-solid fa-user"></i>
                        <input id="usuario-formulario" name="email" placeholder="E-mail" type="text">
                    </div>
                    
                    
                    <div class="input-formulario">
                            <i class="fa-solid fa-lock"></i>
                        <input id="senha-formulario" name="senha" placeholder="Senha" type="password">
                    </div>
            
                    
                    <div id="inscricao-btn">
                        <button id="enviar" type="submit" value="Enviar">Entrar</button>
                    </div>
                </form>
                <p id="invalido">Dados inválidos</p>
                <span class="copyright">© 2022 Todos os direitos reservados</span>
            </div>
        </div>  
    </body>
</html>