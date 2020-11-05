<?php
    include "conexao.php";

    class livrosDAO{
        
        //Básico de uma classe DAO
        //inserir
        //atualizar
        //excluir

        public static function inserir($livros){
            $con = Conexao::getConexao();
            $sql = $con->
                prepare("insert into livros values (null,?,?,?,?,?,?,?,?,?)");
            
            $titulo = $livros->getTitulo();
            $autor = $livros->getAutor();
            $valor = $livros->getValor();
            $formato = $livros->getFormato();
            $descricao = $livros->getDescricao();
            $genero = $livros->getGenero();
            $editora = $livros->getEditora();
            $sinopse = $livros->getSinopse();
            $foto = $livros->getFoto();
            
            $sql->bindParam(1, $titulo);
            $sql->bindParam(2, $autor);
            $sql->bindParam(3, $valor);
            $sql->bindParam(4, $formato);
            $sql->bindParam(5, $descricao);
            $sql->bindParam(6, $genero);
            $sql->bindParam(7, $editora);
            $sql->bindParam(8, $foto);
            $sql->bindParam(9, $sinopse);
            
            $sql->execute();
        }

        //Quero que o excluir possa funcionar de 3 formas:
            //Recebendo um livro
            //Recebendo o nome do livro
            //Recebendo o código do livro
        public static function excluir($livros){
            $con = Conexao::getConexao();
           
            $sql = null;
            if(is_numeric($livros)){
                $sql=$con->prepare("delete from livros where codigo = ?");
                $sql->bindParam(1, $livros);
            } else if(is_string($livros)){
                $sql=$con->prepare("delete from livros where titulo = ?");
                $sql->bindParam(1, $livros);
            } else {
                $titulo = $livros->getTitulo();
                $sql=$con->prepare("delete from livros where titulo = ?");
                $sql->bindParam(1, $titulo);
            }
            $sql->execute();  
        }

        public static function atualizar($livros){
            $con = Conexao::getConexao();

            $codigo = $livros->getCodigo();
            $titulo = $livros->getTitulo();
            $autor = $livros->getAutor();
            $valor = $livros->getValor();
            $formato = $livros->getFormato();
            $descricao = $livros->getDescricao();
            $genero = $livros->getGenero();
            $editora = $livros->getEditora();
            $foto = $livros->getFoto(); 
            $sinopse = $livros->getSinopse();
           

            if($codigo>0){
                $sql = $con->prepare("update livros set titulo=?, autor=?, 
                valor=?, formato=?, descricao=?, genero=?, editora=?, foto=?, sinopse=? where codigo=?");
                $sql->bindParam(10, $codigo);
            } else {
                $sql = $con->prepare("update livros set titulo=?, autor=?, 
                valor=?, formato=?, descricao=?, genero=?, editora=?, foto=?, sinopse=? where titulo=?");
                $sql->bindParam(10, $titulo);
            }

            $sql->bindParam(1, $titulo);
            $sql->bindParam(2, $autor);
            $sql->bindParam(3, $valor);
            $sql->bindParam(4, $formato);
            $sql->bindParam(5, $descricao);
            $sql->bindParam(6, $genero);
            $sql->bindParam(7, $editora);
            $sql->bindParam(8, $foto);
            $sql->bindParam(9, $sinopse);
            

            $sql->execute();
            
        }

        //Ao dar um get pokemon (localizando o pokemon no banco e devolvendo uma instancia)
        //queremos que se possa usar ou o código ou o nome
        public static function getLivro($identificacao){
            $con = Conexao::getConexao();
            $sql = null;

            if(is_numeric($identificacao)){
                $sql = $con->prepare("select * from livros where codigo=?");
                $sql->bindParam(1, $identificacao);
            } else {
                $sql = $con->prepare("select * from livros where titulo=?");
                $sql->bindParam(1, $identificacao);
            }

            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();

            $livros = null;
            if($registro = $sql->fetch()){
                $livros = new Book(
                    $registro["codigo"],
                    $registro["titulo"],
                    $registro["autor"],
                    $registro["valor"],
                    $registro["formato"],
                    $registro["descricao"],
                    $registro["genero"],
                    $registro["editora"],
                    $registro["foto"],
                    $registro["sinopse"]
                );
            }

            return $livros;

        }

        public static function getLivros($campo, $ordem, $operador, $valor){
            $con = Conexao::getConexao();
            if($operador=="")
            $sql = $con->prepare("select * from livros order by $campo $ordem");
        else{
            $sql = $con->prepare("select * from livros where 
                                    $campo $operador ? order by $campo $ordem");
            $sql->bindParam(1, $valor);
        }
            
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();

            $listarbook = array();

            while($registro = $sql->fetch()){
                $livros = new Book(
                    $registro["codigo"],
                    $registro["titulo"],
                    $registro["autor"],
                    $registro["valor"],
                    $registro["formato"],
                    $registro["descricao"],
                    $registro["genero"],
                    $registro["editora"],
                    $registro["foto"],
                    $registro["sinopse"]
                );
                $listarbook[] = $livros;
            }

            return $listarbook;
        }



    }

?>