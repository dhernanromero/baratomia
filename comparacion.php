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
                            <li><a href="#">Perfil</a></li>
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
        foreach ($listaArticulos as $key => $item) {
/*             echo('<br>');
            
            echo('<br>');
            echo( $item->nombre);
            echo('<br>');
            echo($item->url);
            echo('<br>');
            echo($item->imagen);

            echo('<br>');
            echo($item->precio);

            echo('<br>');
            echo($item->codpagina);
            echo('<br>');
 */
            //print_r(obtenerDetallesProducto($item->url, $item->codpagina));
            $detalle = obtenerDetallesProducto($item->url, $item->codpagina);
            $rating = $detalle->rating;
            $detalles = $detalle->caracteristicas;
            
            echo('
            <div class="col-sm-12 col-md-6 card-r">
            <div class="card card-producto"  data-codigo="'.$item->codpagina.'">
                <img class="card-img-top img-responsive" src="'.$item->imagen.'"  alt="Card image cap">
    
                    <div class="card-body">
                        <h4 class="card-title">'.$item->nombre.'</h4>
                        <h4> $ ' .$item->precio .'</h4>
                        <a href="'.$item->url.'" class="btn btn-success" target="_blank">Ir al Sitio</a>
                        <ul class="list-group">
            '); 
      /*       foreach ($detalles as $key => $value) {
                    echo($value);
                }  */              
                  

             echo ' <li class="list-group-item">Carcateristicas</li>';
         
             echo '<h3>Rating: ' . $rating . '</h3>';
             echo '<table border="1"><thead><tr><th>caracteristica</th><th>valor</th></tr></thead><tbody>';
             foreach($detalles as $clave=>$valor)
             {
                 echo '<tr><td>' . $clave . '</td><td>' . $valor . '</td></tr>';
             }
             echo '</tbody></table>';
 
                       echo '</ul>
                    </div>
                </div>
            </div>
            
            ';
        }
    ?>


  </div>


  <script src="js/jquery.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>    

	
</body>

</html>