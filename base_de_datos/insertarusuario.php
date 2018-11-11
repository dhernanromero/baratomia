
<?php 
//print_r($_POST);
$pass=$_POST["pass"];
$mail=$_POST["mail"];
$password_h=password_hash($pass,PASSWORD_DEFAULT);
$estado=0;
$enviar=false;
try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->exec("SET CHARACTER SET utf8");
	$existe="select *from usuarios where mail=:correo";
	$comprobar=$base->prepare($existe);
	$comprobar->bindParam(":correo",$mail);
	$comprobar->execute();
	$resultado=$comprobar->fetchAll();
	if($resultado){
		echo "ERROR, el mail ya existe";
		
	}
	else {
		$cadena="";
		$posible="1234567890abcdefghijklmnopqrstuvwxyz_";
		$i=0;
		while($i<30){
			$caracter=substr($posible,mt_rand(0,strlen($posible)-1),1);
			$cadena.=$caracter;
			$i++;
		}
		//echo $cadena;


		$sql="insert into usuarios (mail,password,estado_idEstado,cod_activacion)values(:email,:password,:estado,:activacion)";
		$resultado=$base->prepare($sql);
		$resultado->execute(array(":email"=>$mail,":password"=>$password_h,":estado"=>$estado,"activacion"=>$cadena));
		
		$para=$mail;

		$asunto="link de activacion de Usuario en el Sistema";

		$desde="From:"."Baratomia";
		$mensajes="presione el siguente link para activar la cuenta <br> <a href='http://localhost/baratomia/base_de_datos/activar_usuario.php?link=$cadena'>";

		mail($para,$asunto,$mensajes,$desde);

		

		echo "revise su mail para poder activar su cuenta";
		header("location:../base_de_datos/aviso_de_envio.html");
		$resultado->closeCursor();

	}



} catch (Exception $e) {
	die("Error:". $e->GetMessage());
	
}
finally{
	$base=null;
}


 ?>


