<?php

    include_once "conexao.php";

    class UsuarioDAO{

        public static function logar($usuario, $senha){
            $con = Conexao::getConexao();
            $sql = $con->prepare("select * from usuarios where usuario = ? and senha = ?");
            $sql->bindParam(1, $usuario);
            $sql->bindParam(2, $senha);
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();

            echo "chamou método";

            if($sql->fetch()){
                echo "achou";
                return true;
            } else {
                echo "não achou";
                return false;
            }
        }


    }
?>