<?php  
    session_start();
    if(!isset($_SESSION["usuario"]))
    {
    header("Location:index.php");
	}
$valor=$_POST["seleccionar"];

$mail=$_SESSION["usuario"];

$estadonotificacion;
$activo=1;
$inactivo=0;

try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->exec("SET CHARACTER SET utf8");;
	$activar_desactivar="update usuarios SET estado_notificaciones_id_estado_notificacion=:valor WHERE usuarios.mail=:correo and estado_idEstado=1;";
	$actualizar=$base->prepare($activar_desactivar);
	$actualizar->bindParam(":correo",$mail);
	if ($valor=="activar") {
		$actualizar->bindParam(":valor",$activo);
		
	}
	else{
		$actualizar->bindParam(":valor",$inactivo);
		
	}
	$actualizar->execute();
	$actualizar->closeCursor();
	echo('<script type="text/javascript">
        alert("Configuracion Guardada");
        window.location.href="../index.php";
        </script>');

}



catch (Exception $e) {
	die("Error:". $e->GetMessage());
	
}
finally{
	$base=null;
}


 ?>