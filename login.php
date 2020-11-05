<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!--Tags básicas do head-->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!--Link dos nossos arquivos CSS e JS padrão-->
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/scripts.js"></script>
    <!--Link dos arquivos CSS e JS do Bootstrap-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<body >

    <?php

    include "usuarioDAO.php";

    session_start();
    $_SESSION["logado"] = false;

    if(isset($_POST["entrar"])){
        $usuario = $_POST["txtUsuario"];
        $senha = $_POST["txtSenha"];
        
        if(UsuarioDAO::logar($usuario, $senha)){
            $_SESSION["logado"] = true;
            session_cache_expire(10);
            header("Location: listagem.php");
        }
    }

    ?>


    
    <div class="container">
    <form method="post" action="login.php">
        <div class="row">


            <div class="col-md-10 offset-md-3 text-align:justify;">
                <br><br><br><br><br>
                <strong><label for="login" class="offset-md-2" style="margin-left: 270px; font-size: 25px;">LOGIN</label></strong>
                
                <div class="col-md-4 text-center offset-md-2">
                <hr>
					Usuário:	
				</div>
				<div class="col-md-8">
					<input class='ajustavel' type='text' name='txtUsuario' value='' style="color:black">	
                </div>
                <br>
				<div class="col-md-4 text-center offset-md-2">
					Senha:
                </div>
                
				<div class="col-md-8 ">
                    <input class='ajustavel' type='password' name='txtSenha' value='' style="color:black">	
                    <hr>
                </div>
                
				<div class="col-md-2 offset-md-3" style="margin-left: 260px;">
					<button  class='btn' type='submit' name='entrar' value='entrar'style="background-color:rgb(0, 255, 204)" >Entrar</button>	
                </div>
             </div>

        </div>
    </form>

    </div>





</body>

</html>