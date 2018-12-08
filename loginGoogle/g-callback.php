<?php 
require_once "config.php";

if (isset($_SESSION['access_token']))
	$gClient->setAccessToken($_SESSION['access_token']);

else if (isset($_GET['code'])){
	$token=$gClient->fetchAccessTokenWithAuthCode($_GET['code']);
	$_SESSION['access_token']=$token;
}
else{
	header("Location:../index.php");
	exit();
}

$oAuth=new Google_Service_Oauth2($gClient);
$userData=$oAuth->userinfo_v2_me->get();

$_SESSION['email']= $userData['email'];
$_SESSION['id']=$userData['id'];
$_SESSION['picture']=$userData['picture'];


$estado=1;
$password_h=0;
$cadena=0;
$token=$_SESSION['id'];//esto necesito
$mail=$_SESSION['email'];//esto tambien
	try {
	$base=new PDO('mysql:host=localhost;dbname=bdusuarios','root','');
	$base->exec("SET CHARACTER SET utf8");
	$existe="select *from usuarios where mail=:correo";
	$comprobar=$base->prepare($existe);
	$comprobar->bindParam(":correo",$mail);
	$comprobar->execute();
	$resultado=$comprobar->fetchAll();
	if($resultado){
		$actualizar="update usuarios set estado_idEstado =:estado, token_gmail =:token where usuarios.mail =:email";
		$resultado=$base->prepare($actualizar);
		$resultado->execute(array(":email"=>$mail,":estado"=>$estado,"token"=>$token));
		$resultado->closeCursor();


		
		
	}
	else {
		$sql="insert into usuarios (mail,password,estado_idEstado,cod_activacion,token_gmail)values(:email,:password,:estado,:activacion,:token)";
		$resultado=$base->prepare($sql);
		$resultado->execute(array(":email"=>$mail,":password"=>$password_h,":estado"=>$estado,"activacion"=>$cadena ,"token"=>$token));
		$resultado->closeCursor();
		
	}
} 
catch (Exception $e) {
	die("Error:". $e->GetMessage());
	
}
finally{
	$base=null;
}



header("Location:../index2.php");
exit();


/*echo "<pre>";
var_dump($userData);
*/



 ?>