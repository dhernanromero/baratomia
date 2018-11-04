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
    if(isset($_SESSION["usuario"])){
        header("Location:index2.php");
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
                    <button id="registro" type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#formregistro">REGISTRARSE</button>
                    <button id="login" type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#formlogin">LOGUEARSE
                    </button>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" id="app">
        <div class="col-md-3">
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
                            <td><img v-bind:src="articulo.imagen" ></td>
                            <td><input type="checkbox"></td>
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
    


    <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  			<div class="modal-dialog" role="document">
  				<div class="modal-content">
  					<div class="modal-header">
  						<h5 class="modal-title" id="exampleModalLabel">Registrate</h5>
  						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
  						</button>
  					</div>
  					<div class="modal-body">
  						<form class="form-horizontal" method="POST" id="formulario" action="" >
						<h2>Email</h2>
						<input type="email" required="" id="mail" name="mail">
						<h2>Password</h2>
						<input id="passwordLogin" type="password" required="" maxlength="12" minlength="12" name="passlogin" style="display:none;">

						<input id="password" type="password" required="" maxlength="12" minlength="12" name="pass">
						<img src="" alt="" class="imagenchica">
						<div id="ocultar">
						<h2>Repetir Password</h2>
						<input id="passwordR" class="" type="password" maxlength="12" minlength="12">
						<img src="" alt="" class="imagenchica"><br>
						</div>
						<input  id="estado"  type="submit">
                        <h3 id="incompleto"></h3>
                     
						</form>
      				</div>
      				<div class="modal-footer">
        			<button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
      				</div>
    			</div>
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