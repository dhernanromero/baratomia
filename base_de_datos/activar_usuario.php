<?php 
$code=$_GET['link'];	
try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->exec("SET CHARACTER SET utf8");
	$verificar_codigo="select *from usuarios where cod_activacion=:codigo_recibido";
	$comprobar=$base->prepare($verificar_codigo);
	$comprobar->bindParam("codigo_recibido",$code);
	$comprobar->execute();
	$resultado=$comprobar->fetchAll();
	if($resultado){
	$sqlactivar="update usuarios set estado_idEstado=:estado where cod_activacion =:codigo";
	$activar=$base->prepare($sqlactivar);
	$activo=1;
	$activar->bindParam(":estado",$activo);
	$activar->bindParam(":codigo",$code);
	$activar->execute();
	$activar->closeCursor();
	header("location:../base_de_datos/cuenta_activada.html");
	echo"la cuenta fue activada";}
	else{
		header("location:../base_de_datos/error_de_activacion.html");
		echo "su codigo de confirmacion ah caducado reenvie confirmacion por mail";
	}

} catch (Exception $e) {
	die("Error:". $e->GetMessage());
	
}
finally{
	$base=null;
}






 ?>