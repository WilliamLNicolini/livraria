<?php
    class Book{
        //PRIMEIRO: ATRIBUTOS (CARACTERISTICAS = VARIAVEIS)
        private $codigo;
        private $titulo;
        private $autor;
        private $valor;
        private $formato;
        private $descricao;
        private $genero;
        private $editora;
        private $foto;
        private $sinopse;

        //SEGUNDO: MÉTODOS (AÇÕES = FUNCTIONS)

        //CONSTRUTOR: método que diz como um novo objeto da classe deve ser construido
        public function __construct($codigo, $titulo, $autor,$valor, $formato, $descricao, $genero, $editora, $foto, $sinopse){
            $this->codigo = $codigo;
            $this->titulo = $titulo;
            $this->autor = $autor;
            $this->valor = $valor;
            $this->formato = $formato;
            $this->descricao = $descricao;
            $this->genero = $genero;
            $this->editora = $editora;
            $this->foto = $foto;
            $this->sinopse = $sinopse;

        }

        //GETTERS: métodos que devolvem o valor de um atributo
        public function getCodigo(){
            return $this->codigo;
        }
        
        public function getTitulo(){
            return $this->titulo;
        }

        public function getAutor(){
            return $this->autor;
        }

        public function getValor(){
            return $this->valor;
        }

        public function getFormato(){
            return $this->formato;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function getGenero(){
            return $this->genero;
        }

        public function getEditora(){
            return $this->editora;
        }

        public function getFoto(){
            return $this->foto;
        }
        public function getSinopse(){
            return $this->sinopse;
        }

        //SETTERS: métodos que permitem alterar o valor de um atributo
        public function setTitulo($novotitulo){
            $this->titulo = $novotitulo;
        }
  
        public function setAutor($novoautor){
            $this->autor = $novoautor;
        }

        public function setValor($novovalor){
            $this->valor = $novovalor;
        }

        public function setFormato($novoformato){
            $this->formato = $novoformato;
        }

        public function setDescricao($novadescricao){
            $this->descricao = $novadescricao;
        }

        public function setGenero($novogenero){
            $this->genero = $novogenero;
        }

        public function setEditora($novaeditora){
            $this->editora = $novaeditora;
        }

        public function setFoto($novafoto){
            $this->foto = $novafoto;
        }
        public function setSinopse($novasinopse){
            $this->foto = $novasinopse;
        }

     

        //MÉTODOS ESPECIAIS: qualquer método que não seja construct, get, set ou toString

    }


?>