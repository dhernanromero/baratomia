<?php 

require_once('app/init.php');
require_once('app/clases/google_auth.php');


$auth = new GoogleAuth();
$auth-> logout();
header('Location: index.php' )


?>