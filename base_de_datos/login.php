<?php 
try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$sql="select * from usuarios where mail =:email";
	$resultado=$base->prepare($sql);

	$email=$_POST["mail"];
	$password=$_POST["passlogin"];

	$resultado->execute(array(":email"=>$email));

	$registro=$resultado->fetch(PDO::FETCH_ASSOC);

	if(password_verify( $password,$registro['password']))
	{
		if ($registro['estado_idEstado']==0)
		{
			echo "primero debe activar la cuenta via mail";
		}
		else{
			session_start();
			$_SESSION["usuario"]=$_POST["mail"];
			header("location:../index2.php");}

	}
	else{

		echo ("error en el pasword o en el usuario");
	}

	
} catch (Exception $e) {

	die("Error:".$e->getMessage());
	
}












 ?>