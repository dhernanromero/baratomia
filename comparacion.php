<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baratomia</title>

    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="loginestilos.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/comparacion.css">
</head>

<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">BARATOMIA</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                
                </ul>

            <ul class="nav navbar-nav navbar-right">
            <?php  
                session_start();
                if(isset($_SESSION["usuario"])){
                    echo('
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">' . $_SESSION["usuario"] . '<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="base_de_datos/configuracionpersonal.php">Perfil</a></li>
                            <li><a href="base_de_datos/cerrarsesion.php">Salir</a></li>
                        </ul>
                    </li>
                    ');
                } 
            ?>
            </ul>
            </div>
        </div>
    </nav>


<!--      CODIGO PHP CON LA FUNCION SCRAPING -->
<?php
  /*
   *  1. OBTIENE LA URL.
   *  2. CREA ARRAY CON CADA ARTICULO PASADO.
   *  3. ITERA EL ARRAY, DECODIFICA y AGREGA AL ARRAY $listaArticulos
   *  4. IMPRIME CADA OBJETO JSON DEL ARRAY
   * 
   */
    require_once 'clases/classWeb_scraping.php';

    $url = $_SERVER['REQUEST_URI'];
    $parametros = explode('?', $url)[1];
    $articulos = explode('url=', $parametros );
    $listaArticulos = array();  // Tendras los json dentro.
    unset($articulos[0]);

    //print_r($articulos);  
    foreach ($articulos as $valor) {
    // echo('<br>');
    // echo( '<p>'.  strstr(base64_decode( $valor ), '}', true) . "}" . '</p>');
        array_push( $listaArticulos, 
            (
                json_decode( strstr(base64_decode( $valor ), '}', true) . "}")  
            )
        );
  }

    function obtenerDetallesProducto($urlProducto, $sitio){
        $webScraping = new WebScraping;
       // echo($sitio);
       // echo($urlProducto);

        switch ($sitio) {
            case 'GBO':
                return $webScraping->obtenerDetalleProductoGarbarino($urlProducto);
                break; 
            case 'MLA': 
                return $webScraping->obtenerDetalleProductoMercadoLibre($urlProducto);
                break;
            case 'FRV':
                //echo('sraping fraverga');
                return $webScraping->obtenerDetalleProductoFravega($urlProducto);
                break;
            
            default:
                # code...
                break;
        }

    }

?>
<!--/      CODIGO PHP CON LA FUNCION SCRAPING -->


  <div class="container">

    <?php
        //  Itera $listaArticulos, muestra Nombre, Precio, Imagen; y realiza nuevo scraping por medio de URL
        // para obtener datos que se mostrar para la comparacion
        echo '<h1 id="centrar">Comparación de productos</h1><br>';

        $arrayImgDimensiones = array();
        $ancho1 = 0;
        $alto1 = 0;
        $ancho2 = 0;
        $alto2 = 0;
        $ancho = 150;
        $alto = 150;
        if($listaArticulos[0]->codpagina === 'GBO')
        {
            $listaArticulos[0]->imagen = substr($listaArticulos[0]->imagen, 0, strpos($listaArticulos[0]->imagen, '.jpg') + 4);
        }
        if($listaArticulos[1]->codpagina === 'GBO')
        {
            $listaArticulos[1]->imagen = substr($listaArticulos[1]->imagen, 0, strpos($listaArticulos[1]->imagen, '.jpg') + 4);
        }
        $arrayImgDimensiones[] = getimagesize($listaArticulos[0]->imagen);
        $arrayImgDimensiones[] = getimagesize($listaArticulos[1]->imagen);

//imprime resultado de array que trae metodo getimagesize (con GBO no quiere andar)
/*
        foreach($arrayImgDimensiones as $arrays)
        {
            foreach($arrays as $item)
            {
                echo $item . '<br>';
            }
        }
*/
        $ancho1 = $arrayImgDimensiones[0][0];
        $alto1 = $arrayImgDimensiones[0][1];
        $ancho2 = $arrayImgDimensiones[1][0];
        $alto2 = $arrayImgDimensiones[1][1];

        if($ancho1 != null && $ancho2 != null)
        {
            if($ancho1 <= $ancho2)
            {
                $ancho = $ancho1;
                $alto = $alto1;
            }
            if($ancho1 >= $ancho2)
            {
                $ancho = $ancho2;
                $alto = $alto2;
            }
        }
        else
        {
            if($ancho1 != null)
            {
                $ancho = $ancho1;
                $alto = $alto1;
            }
            if($ancho2 != null)
            {
                $ancho = $ancho2;
                $alto = $alto2;
            }
        }

        $i = 0;
        foreach ($listaArticulos as $key => $item) {

            $detalle = obtenerDetallesProducto($item->url, $item->codpagina);
            if($detalle->rating != '')
            {
                $rating = $detalle->rating;
            }
            else
            {
                $rating = 'No posee';
            }
            $detalles = $detalle->caracteristicas;

            if($i === 1)
            {
                echo 
                '<div class="col-sm-12 col-md-2">
                    <br><br><br><br><br><br><br><br><br><br><br>
                    <img class="card-img-top img-responsive center-block" src="img/vs.jpg">
                    <br><br><br><br><br><br><br><br><br><br><br>
                </div>';
            }

            echo('
            <div class="col-sm-12 col-md-5 card-r">
                <div class="card card-producto"  data-codigo="'.$item->codpagina.'">
                    <img class="card-img-top img-responsive center-block" src="'.$item->imagen.'" alt="Card image cap" width="' . $ancho . '" height="' . $alto . '">
        
                    <div class="card-body" id="centrar">
                        <h4 class="card-title">'.$item->nombre.'</h4>
                        <h3>Puntuación: ' . $rating . '</h3>
                        <h2> $ ' .$item->precio .'</h2>
                        <img src="' . $item->pagina . '"><br>
                        <a href="'.$item->url.'" class="btn btn-success" target="_blank"><h4>Visitar el Sitio del producto</h4></a>
                        <br><br>');

            echo ' <li class="list-group-item" id="fondo-verde"><h4>Especificaciones técnicas</h4></li>';
            echo 
            '<table class="table table-striped table-bordered">
                <tbody>';
                    foreach($detalles as $clave=>$valor)
                    {
                        echo '<tr><td>' . $clave . '</td><td>' . $valor . '</td></tr>';
                    }
            echo 
                '</tbody>
            </table>';
                       
            echo
                    '</div>
                </div>
            </div>';
            $i++;
        }
    ?>

  </div>


  <script src="js/jquery.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>    

	
</body>

</html>