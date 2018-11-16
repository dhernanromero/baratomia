<?php

   require_once('vendor/autoload.php');
   require_once('app/clases/google_auth.php');
   require_once('app/init.php');

   $googleClient = new Google_Client();
   $auth = new GoogleAuth($googleClient);

   if($auth->checkRedirectCode()){
       //die($_GET['code']);
       header('Location: index.php');
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php if (!$auth->isLoggedIn()): ?>
          <h2>Baratomia- iniciar sesion con google</h2>
         <a href="<?php echo $auth->getAuthUrl(); ?>"><img src="login.png" alt=""></a>
    <?php else: ?>
        bienvenido <a href="logout.php">Cerrar sesion</a>
<?php endif; ?>     
</body>
</html>