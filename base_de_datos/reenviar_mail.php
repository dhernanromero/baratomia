<?php 
//print_r($_POST);
$mensaje="";
if (isset($_POST["password_envio"])) {

	if (isset($_POST["mail_envio"])) {
		try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql="select * from usuarios where mail =:email";
	$resultado=$base->prepare($sql);

	$password=$_POST["password_envio"];
	$email=$_POST["mail_envio"];

	$resultado->execute(array(":email"=>$email));

	$registro=$resultado->fetch(PDO::FETCH_ASSOC);
	$idUsuario=$registro["idusuarios"];
	if(password_verify( $password,$registro['password']))
	{
		if ($registro['estado_idEstado']==0)
		{
			echo "activar";
			$cadena="";
			$posible="1234567890abcdefghijklmnopqrstuvwxyz_";
			$i=0;
			while($i<30){
				$caracter=substr($posible,mt_rand(0,strlen($posible)-1),1);
				$cadena.=$caracter;
				$i++;
			}
		//echo $cadena;
		$sql="update usuarios set cod_activacion =:codigo where usuarios.idusuarios =:id";
		$resultado=$base->prepare($sql);
		$resultado->execute(array(":codigo"=>$cadena,":id"=>$idUsuario));
		
		$para=$email;

		$asunto="link de activacion de Usuario en el Sistema";

		$desde="From:"."Baratomia";
		$mensajes="presione el siguente link para activar la cuenta <br> <a href='http://localhost/baratomia/base_de_datos/activar_usuario.php?link=$cadena'>";

		mail($para,$asunto,$mensajes,$desde);	
		
		header("location:../base_de_datos/aviso_de_envio.html");
		echo "revise su mail para poder activar su cuenta";
		$resultado->closeCursor();
		}
		else{
			$mensaje= "su cuenta ya se encuentra activada";


		}

	}		
	else {
	$mensaje="existe un error en el password o en el usuario";		
	}



} catch (Exception $e) {
	die("Error:". $e->GetMessage());
	
}
finally{
	$base=null;
}

	}
}



 ?>

 <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baratomia</title>

    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="..//lib/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="..//css/estilos.css">
    <link rel="stylesheet" href="centrar.css">
</head>
<body>
	<nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../index.php">BARATOMIA</a>
            </div>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                </ul>
            </div>
        </div>
    </nav>

<div id="centrar">
    <form class="form-horizontal" method="POST" id="formreenvio" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h4>Ingrese el mail y password con el cual usted se registró:</h4>
        <br>
        <h4>Email</h4>
        <input type="email" required="" id="mail_envio" name="mail_envio" class="form-control">
        <span id="resultado_envio"></span>
        <h4>Password</h4>
        <input id="password_envio" type="password" required="" maxlength="12" minlength="12" name="password_envio" class="form-control">
        <br>
        <input  id="estado_envio"  type="submit" class="btn btn-primary btn-block">
        <h4 id="incompleto_envio"><?php
        echo $mensaje;
        ?></h4>
        <button id="volver" class="btn btn-info" type="submit"><i aria-hidden="true"></i> Volver</button>

    </form>
</div>	
    <script src="../js/jquery.js"></script>	
	<script src="../lib/vue.js"></script>
    <script src="../lib/vue-resource.min.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/funciones.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
	
</body>

</html>