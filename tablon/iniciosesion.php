<html>
<head>
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
	<body>
<?php
session_start();
if(isset($_SESSION["estado"])){
	if($_SESSION["estado"]==1){
	header('Location: editor.php');
	}
}
?>
		<h1><center>Iniciar sesión</center></h2><br>
		<form name="iniciosesion" action="procesa_inicio.php" method ="POST">
		<table border='3' align=center>
			<tr><td><b>Email</b></td><td><input type="text" name="email"/></td></tr>
			<tr><td><b>Contraseña</b></td><td><input type="password" name="password"/></td></tr>
			<tr><td colspan='2' align=center><input type="submit" class="btn btn-primary btn-sm" value="Acceder"/></td></tr></table>
		</form>
		<center><a href='olvpass.php'>Olvidé la contraseña</a><br><br></center>
		<center><a href='index.php'>Volver atrás</a><br><br></center>
	</body>
</html>