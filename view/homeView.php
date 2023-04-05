<?php
	session_start();
	$usuario = $_SESSION['usuario'];
	// $senha = $_SESSION['senha'];
	//var_dump( $_SESSION );
	session_destroy();
	//echo($usuario.", ".$);
	echo("Welcome ".$usuario);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>welcome</title>
</head>
<body style="width: 100%;height: 100%;display: flex;flex-wrap: wrap;justify-content: center; font-size: 2vw;">
</body>
</html>