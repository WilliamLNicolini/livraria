<!DOCTYPE html>
<html lang="pt-br">

<head>
	<!--Tags básicas do head-->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Arrays em PHP</title>
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
     
        include_once "livroslistaview.php";
        include_once "livro.php";
        include_once "livrosDAO.php";
        include_once "navbar.php";
        
        session_start();

        $valor = "";
        $campo = "";
        $operacao = "";
        $ordenacao = "";

        if(isset($_POST["btnFiltro"])){
            $valor = $_POST["txtFiltro"];
            $campo = $_POST["selTipoFiltro"];
            $operacao = $_POST["selOperacao"];
            $ordenacao = $_POST["selOrdenacao"];

            if($_POST["btnFiltro"]=="inserir"){
                header("Location: cadastro.php");
            } else if($_POST["btnFiltro"]=="desfazer"){
                $livros = livrosDAO::getLivros("codigo", "asc", "", "");
            } else if($_POST["btnFiltro"]=="filtrar"){
                if($valor==""){
                    $livros = livrosDAO::getLivros($campo, $ordenacao, "", "");
                } else {
                    $livros = livrosDAO::getLivros($campo, $ordenacao, $operacao, $valor);
                }
            }

        } else {
            $livros = livrosDAO::getLivros("codigo", "asc", "", "");
        }

    ?>


    <div class="container">
        <div class="row text-center" id="cabecalhoLista">
            <div class="col-md-12">
                <h1>Lista de Produtos</h1>
                <hr>
                <br>
            </div>
        
            <div class="col-md-12 text-center">

                <form method="post" action="listagem.php">
                    <div class="row">
                        <div class="col-md-1">
                            Filtro
                        </div>
                        <div class="col-md-2">
                            <input class="ajustavel" type="text" name="txtFiltro" id="txtFiltro" value="">
                        </div>
                        <div class="col-md-2">
                            <select class="ajustavel" name="selTipoFiltro" id="selTipoFiltro">
                                <option value="titulo">Titulo</option>
                                <option value="valor">Preço</option>
                                <option value="autor">Autor</option>
                                
                                
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="ajustavel" name="selOperacao" id="selOperacao">
                                <option value="=">Igual</option>
                                <option value=">">Maior</option>
                                <option value=">=">Maior ou igual</option>
                                <option value="<">Menor</option>
                                <option value="<=">Menor ou igual</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="ajustavel" name="selOrdenacao" id="selOrdenacao">
                                <option value="asc">Crescente</option>
                                <option value="desc">Decrescente</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <input class="btn btn-primary" type="submit" name="btnFiltro" value="filtrar" style="padding:0px!important;">
                        </div>
                        <div class="col-md-1">
                            <input class="btn btn-danger" type="submit" name="btnFiltro" value="desfazer" style="padding:0px!important;">
                        </div>
                        <div class="col-md-1">
                            <input class="btn btn-success" type="submit" name="btnFiltro" value="inserir" style="padding:0px!important;">
                        </div>
                    </div>
                    <hr>
                </form>
            </div>  
        
        
        <hr>

    
        <?php



            LivroListaView::geraLista($livros);

            if(isset($_POST["btnFiltro"])){
                echo "
                    <script>
                        $('#txtFiltro').val('$valor');
                        $('#selTipoFiltro').val('$campo');
                        $('#selOperacao').val('$operacao');
                        $('#selOrdenacao').val('$ordenacao');
                    </script>
                ";
            }
        ?>

    
    
    
    </div>
    </div> 


</body>