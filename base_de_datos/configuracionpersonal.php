<body>
    <?php 
    session_start();
    if(!isset($_SESSION["email"])){
    header("Location:index.php");
}
$picture="";
if (isset($_SESSION['access_token'])){
    $picture=$_SESSION['picture'];
}
else{
    $picture="ensesion.png";
}

 ?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../loginestilos.css">
    <link rel="stylesheet" href="centrar.css">
    <link rel="stylesheet" href="../css/estilos.css">
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
                <a class="navbar-brand" href="./../">BARATOMIA</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                
                </ul>

            <ul class="nav navbar-nav navbar-right">
            <?php 
                    // Menu Usuario Logueado
                    echo('
                    
                    <img class="imagenmediana" src='.$picture.'>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">' . $_SESSION["email"] . '<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="cerrarsesion.php">Salir</a></li>
                        </ul>
                    </li>
                    ');
                
            ?>
            </ul>
            </div>
        </div>
    </nav>


    
<div class="centrado">
<form action="activar-desactivar-envio.php" method="POST" id="formconfigpersonal">
    <h4>Activar las notificaciones por mail de los productos mas buscados de la semana</h4>
    <input type="radio" name="seleccionar" value="activar" id="radio-activado"> activar<br>
    <input type="radio" name="seleccionar" value="desactivar" id="radio-desactivado"> desactivar<br>
    <br>
    <input type="submit" value="guardar configuracion" class="btn btn-primary btn-block">
</form>
<button id="volver" class="btn btn-info"><i aria-hidden="true"></i> Volver</button>
</div>

<script src="../js/jquery.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>    
    <script src="../lib/vue.js"></script>
    <script src="../lib/vue-resource.min.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/funciones.js"></script> 
</body>


</html>


