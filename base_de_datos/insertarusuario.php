
<?php 

$pass=$_POST["pass"];
$mail=$_POST["mail"];
$password_h=password_hash($pass,PASSWORD_DEFAULT);
$estado=0;


try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->exec("SET CHARACTER SET utf8");
	$sql="insert into usuarios (mail,password,estado_idEstado)values(:email,:password,:estado)";
	$resultado=$base->prepare($sql);
	$resultado->execute(array(":email"=>$mail,":password"=>$password_h,":estado"=>$estado));
	echo "usuario cargado en el sistema";
	$resultado->closeCursor();
} catch (Exception $e) {
	die("Error:". $e->GetMessage());
	
}
finally{
	$base=null;
}


 ?>


