<?php

class LivroListaView
{

    public static function geraLista($lista)
    {




        foreach ($lista as $livros){
           

            $codigolivro = $livros->getCodigo();
            $tituloLivro = $livros->getTitulo();
            $autorLivro = $livros->getAutor();
            $valorLivro = $livros->getValor();
            $formatoLivro = $livros->getFormato();
            $descricaoLivro = $livros->getDescricao();
            $generoLivro = $livros->getGenero();
            $editoraLivro = $livros->getEditora();
            $sinopselivro = $livros->getSinopse();
            $fotoLivro = $livros->getFoto();

            echo "

                   
                                
            <div class='col-md-6'>
            
                <form method='post' action='cadastro.php'>
                <div class='row'>
       
                 <div class='col-md-3 col-xs-3 col-sm-3 hrv ' style='margin-left: 2px' '>
                    <div>
                       <br>
                       <button class='btn' type='submit' name='selLivro' value= $codigolivro style='height:100%; width:100%; padding:0px!important;'>
                            <img src='img/$fotoLivro' style='width: 100%; height: 100%;'> 
                       </button>
                     </div>
                 </div>
             
                    <div class='col-md-6'>
                    <p>
                            <h2 style='font-size: 1.7em; height:85px'><p>$tituloLivro <br></h2>
                           
                            <p style='font-size:0.8em; height:20px '>$autorLivro</p>
                            <h2 style='font-size:1.5em;height:20px '> R$ $valorLivro</h2>
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
                   </div>
               </div>
                           
         </form>
           </div>
                                  ";
        }

        echo "";
    }
}
?>
