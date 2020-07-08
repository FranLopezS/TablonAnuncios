<?php
session_start();
if(isset($_SESSION["estado"])){
	if($_SESSION["permiso"]==3){
	}
	else
	{
		header("Location: index.php");
	}
}
else
{
	header("Location: index.php");
}
$email=$_REQUEST['email'];
include 'conexionbd.php';
$conexion=mysqli_connect($host,$user,$pass,$bbdd);
if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
	echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
	echo "Holamundo";
}
else
{
	$consulta="DELETE FROM usuarios WHERE email='$email';";
	if(!mysqli_query($conexion,$consulta)){
		echo "No se ha podido borrar el usuario.";
	}
	else
	{
		//$resultado=mysqli_query($conexion,$consulta);
		header("Location: permisos.php");
	}
}
?>