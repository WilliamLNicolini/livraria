<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!--Tags básicas do head-->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caverna do Saber</title>
    <!--Link dos nossos arquivos CSS e JS padrão-->
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <script src="js/scripts.js"></script>
    <!--Link dos arquivos CSS e JS do Bootstrap-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</head>

<body>



    <?php
    include_once "navbar.php";
    include_once "livro.php";
    include_once "livrosDAO.php";
    include_once "imagem.php";



    session_start();


    if (isset($_SESSION["logado"])) {
        if ($_SESSION["logado"] == false) {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }


    if (!isset($_SESSION["modo"])) {
        $_SESSION["modo"] = 1;
    }

    $codigo = "";
    $titulo = "";
    $autor = "";
    $valor = "";
    $formato = "";
    $descricao = "";
    $genero = "";
    $editora = "";
    $foto = "semfoto.jpg";
    $sinopse = "";

    if (isset($_POST["botaoAcao"])) {
        if ($_POST["botaoAcao"] == "Gravar") {

            $codigo = null;
            $titulo = $_POST["titulo"];
            $autor = $_POST["autor"];
            $valor = $_POST["valor"];
            $formato = $_POST["formato"];
            $descricao = $_POST["descricao"];
            $genero = $_POST["genero"];
            $editora = $_POST["editora"];
            $arquivo = $_FILES["fileFoto"];
            $foto = null;
            if($arquivo!="" && $arquivo!=null)
                    $foto = Imagem::uploadImagem($arquivo, 2000, 2000, 5000, "img/"); 
                else
                    $foto = "";
            $sinopse = $_POST["sinopse"];

            $pAux = new Book(
                $codigo,
                $titulo,
                $autor,
                $valor,
                $formato,
                $descricao,
                $genero,
                $editora,
                $foto,
                $sinopse

            );
            if ($_SESSION["modo"] == 1)
                livrosDAO::inserir($pAux);
            else
                livrosDAO::atualizar($pAux);
        } else if ($_POST["botaoAcao"] == "Excluir") {
            livrosDAO::excluir($_POST["titulo"]);
        }

        //Coloca em modo de inserção caso for clicado no botão Excluir ou Inserir
        //Assim, a próxima vez que o botão gravar for clicado, sabemos se devemos
        //Inserir ou Atualizar o livro. Além disso, também conseguimos saber se
        //devemos recarregar os valores dos inputs ou trazer somente vazio
        if (isset($_POST["botaoAcao"])) {
            if ($_POST["botaoAcao"] == "Excluir" || $_POST["botaoAcao"] == "Inserir") {
                $_SESSION["modo"] = 1; //insercao
            }else if($_POST["botaoAcao"]=="Cancelar"){
                header("Location: listagem.php");
            } 
            else {
                $_SESSION["modo"] = 2; //atualização
            }
        }
    }
    if (isset($_POST["selLivro"])) {
        $livros = livrosDAO::getLivro($_POST["selLivro"]);
        $titulo = $livros->getTitulo();
        $autor = $livros->getAutor();
        $valor = $livros->getValor();
        $formato = $livros->getFormato();
        $descricao = $livros->getDescricao();
        $genero = $livros->getGenero();
        $editora = $livros->getEditora();
        $foto = $livros->getFoto();
        $sinopse = $livros->getSinopse();
        $_SESSION["modo"] = 2;
    } else {
        $_SESSION["modo"] = 1;
    }

    ?>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <br>
                <h1> Gerenciamento de Produtos</h1>
                <hr>
            </div>
        </div>


        <form method="post" action="cadastro.php" enctype="multipart/form-data">

            <div class="row " id="areaCadastro">
                <div class="col-md-6">
                    <div class="row">

                        <div class="col-md-8 ">
                            <br>
                            <strong><label for="titulo">Titulo</label></strong>
                            <input type="text" name="titulo" value="<?php echo $titulo; ?>">
                        </div>

                        <div class="col-md-4">
                            <br>
                            <strong><label for="autor">Autor</label></strong>
                            <input type="text" name="autor" value="<?php echo $autor; ?>">

                        </div>
                        <div class="col-md-4 ">
                            <br>
                            <strong><label for="valor">Valor</label></strong>
                            <input type="text" name="valor" value="<?php echo $valor; ?>">
                        </div>
                        <div class="col-md-4">
                            <br>
                            <strong><label for="formato">Formato</label></strong>
                            <input type="text" name="formato" value="<?php echo $formato; ?>">
                        </div>
                        <div class="col-md-4 ">
                            <br>
                            <strong><label for="descricao">Descricao</label></strong>
                            <input type="text" name="descricao" value="<?php echo $descricao; ?>">
                        </div>
                        <div class="col-md-4 ">
                            <br>
                            <strong><label for="genero">Genero</label></strong>
                            <input type="text" name="genero" value="<?php echo $genero; ?>">
                        </div>
                        <div class="col-md-4 ">
                            <br>
                            <strong><label for="editora">Editora</label></strong>
                            <input type="text" name="editora" value="<?php echo $editora; ?>"></div>
                    </div>
                </div>
                <div class="col-md-6">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 ">
                            <br>
                            <strong><label for="sinopse">Sinopse</label></strong>
                            <textarea name="sinopse" rows="8" cols="28"><?php echo $sinopse; ?></textarea>


                        </div>
                        

                        <div class="col-md-6" style="margin-top:31px ; ">

                            <br>

                            <img src="img/<?php echo $foto?>" style="width:59%; height:80%;">
                            
                                <input type="file" name="fileFoto">
                            

                            <br>

                        </div>
                    </div>

                </div>
           </div>

            </div>
            <hr>
            <div class="row text-center ">

                <div class="col-md-2 offset-md-2">
                    <input type="submit" name="botaoAcao" value="Inserir" class="btn btn-primary" />
                </div>

                <div class="col-md-2">
                    <input type="submit" name="botaoAcao" value="Gravar" class="btn btn-success" />
                </div>

                <div class="col-md-2">
                    <input type="submit" name="botaoAcao" value="Excluir" class="btn btn-danger" />
                </div>

                <div class="col-md-2">
                    <input type="submit" name="botaoAcao" value="Cancelar" class="btn  btn-warning" />
                </div>
            </div>
    </div>






    </form>


    </div>



</body>