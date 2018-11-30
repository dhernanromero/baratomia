<?php

  return

  array(
    "base_url" => "http://localhost/baratomia/loginGoogle/socialauthphp/hydridauth.php",
    "providers" => array(
      "Twitter" => array(
        "enabled" => true,
        "keys" => array(
          "key" => "XgzeszfbIPeWnCNRGObbawOsF",
          "secret" => "YKZ5vrKHzN9xKz2MCM2YnjVK7Z6VvdSwqfP7dbHHhj9tjCNvmx"
        ),
        "includeEmail" => true
      ),
      "Facebook" => array(
        "enabled" => true,
        "keys" => array(
          "id" => "259007951451226",
          "secret" => "73bd2f1e8baa985f41ff4f9396aca127"
        ),
        "scope" => "email"
      ),
      "Google" => array(
        "enabled" => true,
        "keys" => array(
          "id" => "895030131848-ujlnbuum4enlvrrc6camsigirqpif4i3.apps.googleusercontent.com",
          "secret" => "v3Q65EzIZbaDDHhtpp2VwX6V"
        )
      )
    )
  )

 ?>
