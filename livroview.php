<body>

    <?php
    

    class LivrosView
    {

        




        public static function gerarLivros($livros)
        
        {
            $tituloLivro = $livros->getTitulo();
            $autorLivro = $livros->getAutor();
            $valorLivro = $livros->getValor();
            $formatoLivro = $livros->getFormato();
            $descricaoLivro = $livros->getDescricao();
            $generoLivro = $livros->getgenero();
            $editoraLivro = $livros->getEditora();
            $fotoLivro = $livros->getFoto();
            $sinopselivro = $livros->getSinopse();

            echo "

            
     <div class='col-md-6'>
     
        <div class='row'>

             <div class='col-md-3 col-xs-3 col-sm-3 hrv ' style='margin-left: 2px' '>
                <div class='' >
                <br>
                    <img src='img/$fotoLivro' style='width: 50%; height: 50px; margin-left: 30px; '> 
                </div>
                </div>
            </div>
            

                <div class='col-md-8'style='margin-left: 20px  '>
                <p>
                        <h2 style='font-size: 1.7em; height:85px '><p>$tituloLivro <br></h2>
                       
                        <p style='font-size:0.8em; text-align: justify;height:20px '>$autorLivro</p>
                        <h2 style='font-size:1.5em; text-align: justify;height:20px '> R$ $valorLivro</h2>
                        <br>
                        <a class='btn btn-white' style='border: 2px solid rgb(46, 184, 184); border-radius: 5px; color: rgb(46, 184, 184)' data-toggle='collapse' href='#multiCollapseExample1' role='button' aria-expanded='false' aria-controls='multiCollapseExample1'>Sinopse</a>
                        <div class='collapse multi-collapse' id='multiCollapseExample1'>
                    <div class='card card-body'>
                    $sinopselivro
                    </div>
                    </div>
                        <p style='font-size: 1em; '> $formatoLivro </p>
                        <p style='font-size: 1em; color:blue; '> $descricaoLivro </p>
                        <p style='font-size: 1em; '> $generoLivro </p>
                        <p style='font-size: 1em; '>Editora: $editoraLivro </p>
                        <hr>
                        </p>
                </div>  
        </div>
        
    </div>
           
            ";
        }
    }
    ?>

</body>