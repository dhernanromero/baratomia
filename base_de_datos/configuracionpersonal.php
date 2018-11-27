<body>
    <?php 
    session_start();
    if(!isset($_SESSION["usuario"])){
    header("Location:index.php");
}
 ?>

<?php 
                    // Menu Usuario Logueado
                    echo('
                    <li class="dropdown">
                        <h3 id="mailsesion">' . $_SESSION["usuario"] . '</h3>
                    </li>
                    ');
                
            ?>  

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="../text/css" href="loginestilos.css">
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
    <h2>desea activar las notificaciones por mail de los productos mas buscados de la semana</h2>
<form action="activar-desactivar-envio.php" method="POST">
    <input type="radio" name="seleccionar" value="activar" id="radio-activado"> activar<br>
    <input type="radio" name="seleccionar" value="desactivar" id="radio-desactivado"> desactivar<br>
    <input type="submit" value="guardar configuracion">
</form>
<script src="../js/jquery.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>    
    <script src="../lib/vue.js"></script>
    <script src="../lib/vue-resource.min.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/funciones.js"></script> 
</body>


</html>


