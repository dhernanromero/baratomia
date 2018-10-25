<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baratomia</title>

    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="loginestilos.css">
</head>

<body>
    <?php 
    session_start();
    if(!isset($_SESSION["usuario"])){
    header("Location:index.html");
}
 ?>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <div class="collapse navbar-collapse" id="navBar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">BARATOMIA</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    
                    	<a href="base_de_datos/cerrarsesion.php">SALIR</a>
                    
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" id="app">

        <div class="col-md-3">
            <?php echo $_SESSION["usuario"]; ?>
        </div>
        <div class="col-md-6">
            <input v-model="palabraBuscar" @change="buscarPalabra" class="form-control" placeholder="Buscar...">
        </div>

        <div class="col-md-3">
            <button v-on:click="iniciarBusqueda" class="btn btn-success">Buscar</button>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="col-md-2">
            <h4>Publicidad</h4>
        </div>
        <div class="col-md-7">
            <div class="row">


            </div>
            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Sitio</th>
                            <th>Precio</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="articulo in articulos">
                            <td>{{articulo.nombre}}</td>
                            <td><a v-bind:href="articulo.url" v-text="articulo.url"></a></td>
                            <td>{{articulo.precio}}</td>
                            <td ><img v-bind:src="articulo.imagen" ></td>

                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="col-md-offset-1 col-md-2">
            <h4>Los más Buscados</h4>
            <ul class="list-group">
                <li class="list-group-item">Camara Cannon</li>
                <li class="list-group-item">Notebook v310</li>
                <li class="list-group-item">Camra Cannon</li>
                <li class="list-group-item">Notebook Exo</li>
                <li class="list-group-item">Camra Cannon</li>
                <li class="list-group-item">Camra Cannon</li>

            </ul>
        </div>
        <div class="row">
            <pre> Buscando: {{ palabraBuscar }}</pre>
        </div>
    </div>
    
	<script src="js/jquery.js"></script>	
	<script src="lib/vue.js"></script>
    <script src="lib/vue-resource.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/funciones.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
	
</body>

</html>