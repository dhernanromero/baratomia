<html>
<head></head>
<title></title>
<body>
<?php 
session_start();
session_destroy();
header("location:../index.html");
?>

</body>
	
</html>