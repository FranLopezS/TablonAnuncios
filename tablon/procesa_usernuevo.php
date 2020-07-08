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
$nombre=$_REQUEST['nombre'];
$permiso=$_REQUEST['permiso'];
$email=$_REQUEST['email'];
$password=$_REQUEST['password'];

include 'conexionbd.php';
$conexion=mysqli_connect($host,$user,$pass,$bbdd);
if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
	echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
}
else
{
	$consulta="select * from mensajes;";
	$resultado=mysqli_query($conexion,$consulta);
	$n_pags=mysqli_num_rows($resultado);
	$codigopost=$n_pags+1;
	$consulta="INSERT INTO `usuarios`(`nombre_apellidos`, `email`, `password`,`permiso`) VALUES ('$nombre','$email','$password','$permiso');";
	if(!mysqli_query($conexion,$consulta)){
		echo "No se ha podido crear el usuario.";
	}
	else
	{
		//$resultado=mysqli_query($conexion,$consulta);
		header("Location: permisos.php");
	}
}
?>