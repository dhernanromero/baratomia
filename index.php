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
<?php
    session_start();
    if(isset($_SESSION["usuario"])){
        header("Location:index2.php");
    }
 ?>
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

    <div class="container" id="app">

        <div class="col-md-3">
        </div>
        <form v-on:submit.prevent="iniciarBusqueda">
            <div class="col-md-6">
                <input v-model="palabraBuscar" class="form-control" require placeholder="Buscar...">
            </div>

            <div class="col-md-3">
                <button class="btn btn-info" type="submit"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
            </div>
        </form>
        <div class="row">
            <hr>
            <div id="loading" style="display:none;">
            <ul class="bokeh">
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="row">
                    <p v-text="mensajeEstado"></p>

                </div>
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th v-on:click="ordenarPorNombre" v-bind:class="thead.nombre == true ? 'th-seleccionado' : ''" class="col-md-5">Nombre <i class="fa fa-sort-alpha-asc btn-order" aria-hidden="true"></i> </th>
                                <th v-on:click="ordenarPorSitio" v-bind:class="thead.sitio == true ? 'th-seleccionado' : ''" class="col-md-2">Sitio <i class="fa fa-sort-alpha-asc btn-order" aria-hidden="true"></i> </th>
                                <th v-on:click="ordenarPorPrecio" v-bind:class="thead.precio == true ? 'th-seleccionado' : ''" class="col-md-2">Precio <i class="fa fa-sort-numeric-asc btn-order" aria-hidden="true"></i></th>
                                <th class="col-md-2">imagen</th>
                                <th class="col-md-1">Comparar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(articulo, indexArticulo) in articulos">
                                <td><a v-bind:href="articulo.url" target="_blank" v-text="articulo.nombre"></a></td>
                                <!-- <td><a v-bind:href="articulo.url" target="_blank" >Ver en Sitio</a></td> -->
                                <td><img class="img-responsive" v-bind:src="articulo.pagina" ></a></td>
                                <td>$ <span v-text="articulo.precio"></span></td>
                                <td><img class="img-responsive" v-bind:src="articulo.imagen" ></td>
                                <td><input v-on:click="articuloSeleccionar(articulo, indexArticulo)" v-model="articulo.seleccionado" type="checkbox"  class="form-control" :id="articulo.url"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="col-md-offset-1 col-md-2">
                <button v-if="articulosListaComparar.length > 1" v-on:click="comprarArticulos" class="btn btn-info" type="button" >Comparar <span v-text="articulosListaComparar.length"></span> artículos </button>
                <h4>Los más Buscados</h4>
                <ul class="list-group">
                    <li v-for="(buscado, indexBuscado) in buscadosLista" v-text="buscado" class="list-group-item"></li>
                </ul>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
    


    <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-sm" role="document">
  			<div class="modal-content">
  				<div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  							<span aria-hidden="true">&times;</span>
  						</button>
  					<h4 class="modal-title"><i class="fa fa-address-card-o" aria-hidden="true"></i> <span id="exampleModalLabel">Registrate</span> </h4>
  						
  				</div>
  				<div class="modal-body">
  					<form class="form-horizontal" method="POST" id="formulario" action="" >
						<h4>Email</h4>
						<input type="email" required="" id="mail" name="mail" class="form-control">
                        <span id="resultado"></span>
						<h4>Password</h4>
						<input id="passwordLogin" type="password" required="" maxlength="12" minlength="12" name="passlogin" style="display:none;" class="form-control">

						<input id="password" type="password" required="" maxlength="12" minlength="12" name="pass" class="form-control">
						<img src="" alt="" class="imagenchica">
						<div id="ocultar">
						<h4>Repetir Password</h4>
						<input id="passwordR" type="password" maxlength="12" minlength="12" class="form-control">
						<img src="" alt="" class="imagenchica"><br>
						</div>
                        <br/>
						<input  id="estado"  type="submit" class="btn btn-primary btn-block">
                        <h4 id="incompleto"></h4>
        			    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Salir</button>

					</form>
      			</div>
      			<div class="modal-footer">
      			</div>
    		</div>
  		</div>
    </div>
    

    <script src="js/jquery.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>    
	<script src="lib/vue.js"></script>
    <script src="lib/vue-resource.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/funciones.js"></script>
	
</body>

</html>