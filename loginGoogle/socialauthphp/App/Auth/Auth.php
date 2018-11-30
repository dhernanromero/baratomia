<?php

  class Auth
  {
    protected static $allow = ['Facebook', 'Twitter', 'Google'];

    protected static function issetRequest()
    {
      if(isset($_GET['login'])){
        if(in_array($_GET['login'], self::$allow)){
          return true;
        }
      }
      return false;
    }

    public static function getUserAuth()
    {
      if(self::issetRequest())
      {
        $service = $_GET['login'];

        $hybridAuth = new Hybrid_Auth(__DIR__ . '\config.php');

        $adapter = $hybridAuth->authenticate($service);

        $userProfile = $adapter->getUserProfile();

        self::storeUser($service, $userProfile);

        //redirect user
        header('Location: index.php');
      }
    }

    protected static function storeUser($service, $socialUser) // enlaza las tablas de la base de datos
    {
      $db = new PDO("mysql:host=localhost;dbname=u289260504_user", "root", ""); // nombre de la base de datos (u289260504_user) dbname=sociallogin 

      $user = self::getExistingUser($socialUser, $db);

      if($user === null){

        $user = array(
          'name' => $socialUser->firstName,
          'mail' => $socialUser->mail //  'email' => $socialUser->email
        );

        $ps = $db->prepare("INSERT INTO usuario (name, mail) VALUES(:name, :mail)");  // usuario : users  - mail:email
        $ps->execute($user);

        $user['idusuario'] = $db->lastInsertId(); // recupera el id del ultimo usuario logueado // $user['id'] = $db->lastInsertId();

        self::storeUserSocial($user, $socialUser, $service, $db);

      }else{

        if(!self::checkUserSocialService($user, $socialUser, $service, $db)){
          self::storeUserSocial($user, $socialUser, $service, $db);
        }

      }

      self::login($user);

    }

    protected static function getExistingUser($socialUser, $db) // pregunta si el usuario existe
    {
      $ps = $db->prepare("SELECT idusuario, name, mail FROM usuario WHERE mail = :mail");  //    $ps = $db->prepare("SELECT id, name, email FROM users WHERE email = :email");
      $ps->execute([
        ':mail' => $socialUser->mail
      ]);

      $result = $ps->fetchAll(PDO::FETCH_ASSOC);

      return $result ? $result[0] : null;
    }

    protected static function storeUserSocial($user, $socialUser, $service, $db)
    {
      $ps = $db->prepare("INSERT INTO users_social (user_id, social_id, service) VALUES(:user_id, :social_id, :service)");
      $ps->execute([
      ':user_id' => $user['idusuario'], //   ':user_id' => $user['id'],
      ':social_id' => $socialUser->identifier,
      ':service' => $service
      ]);
    }

    protected static function checkUserSocialService($user, $socialUser, $service, $db)
    {
      $ps = $db->prepare("SELECT * FROM users_social WHERE user_id = :user_id AND service = :service AND social_id = :social_id");
      $ps->execute([
      ':user_id' => $user['idusuario'], //   ':user_id' => $user['id'],
      ':service' => $service,
      ':social_id' => $socialUser->identifier
      ]);

      return (bool) $ps->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function isLogin()
    {
      return (bool) isset($_SESSION['user']);
    }

    protected static function login($user)
    {
      $_SESSION['user'] = $user;
    }

    public static function logout()
    {
      if(self::isLogin()){
        unset($_SESSION['user']);
      }
    }

  }

 ?>
