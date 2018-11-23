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
                if(!isset($_SESSION["usuario"])){
                    // Menu Para Usuario No Logueado
                    echo('<li><a id="registro" class="menuOpcion" href="#" data-toggle="modal" data-target="#formregistro">Registrarse</a></li>');
                    echo('<li><a id="login" class="menuOpcion" href="#"  data-toggle="modal" data-target="#formlogin">Loguearse</a></li>');
                } else {
                    // Menu Usuario Logueado
                    echo('
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">' . $_SESSION["usuario"] . '<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Perfil</a></li>
                            <li><a href="#">Salir</a></li>
                        </ul>
                    </li>
                    ');
                }
            ?>
            </ul>
            </div>
        </div>
    </nav>
  <div class="container">
  <div class="col-sm-12 col-md-6 card-r">
    <div class="card card-producto"  data-codigo="0">
      <img class="card-img-top" src=""  alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Articulo 1</h5>
        <a href="#" class="btn btn-primary">mas info</a>
      </div>
    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 card-r">
                    <div class="card card-producto"  data-codigo="1">
                        <img class="card-img-top" src=""  alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Articulo 2</h5>
                            <a href="#" class="btn btn-primary">mas info</a>
                        </div>
                    </div>
                  </div> 
  </div>

<!--      CODIGO PHP CON LA FUNCION SCRAPING -->
<?php
  /*
   *  1. OBTIENE LA URL.
   *  2. CREA ARRAY CON CADA ARTICULO PASADO.
   *  3. ITERA EL ARRAY, DECODIFICA y AGREGA AL ARRAY $listaArticulos
   *  4. IMPRIME CADA OBJETO JSON DEL ARRAY
   * 
   */
  $url = $_SERVER['REQUEST_URI'];
  $parametros = explode('?', $url)[1];
  $articulos = explode('url=', $parametros );
  $listaArticulos = array();  // Tendras los json dentro.
  unset($articulos[0]);

  //print_r($articulos);  


 echo('<br>');
 echo('<p>Listas de Articulos');

 echo('<p>---------------------------------------</p>');

  foreach ($articulos as $valor) {
    echo('<br>');
    echo( '<p>'.  strstr(base64_decode( $valor ), '}', true) . "}" . '</p>');
    array_push( $listaArticulos, 
        (
            strstr(base64_decode( $valor ), '}', true) . "}"  
        )
      );
    echo('<br>');
  }

 echo('<br>');
 echo('<br>');
 echo('Array JSON:');
 echo('<br>');
  
  print_r($listaArticulos);


?>
<!--/      CODIGO PHP CON LA FUNCION SCRAPING -->

  <script src="js/jquery.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>    

	
</body>

</html>