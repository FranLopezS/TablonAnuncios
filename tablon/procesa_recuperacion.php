<?php
$email=$_REQUEST['email'];
$newpass=$_REQUEST['newpass'];
include 'conexionbd.php';
$conexion=mysqli_connect($host,$user,$pass,$bbdd);
if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
	echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
}
else
{
	$consulta="update `usuarios` set `password`='$newpass' where email='$email';";
	if(!mysqli_query($conexion,$consulta)){
		echo "No se ha podido realizar la consulta.<br>";
	}
	echo "¡Contraseña cambiada! <a href='index.php'>Volver al inicio</a>";
}
?>