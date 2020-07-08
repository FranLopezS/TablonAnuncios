<?php
session_start();
if(isset($_SESSION["estado"])){
	if($_SESSION["permiso"]==3 || $_SESSION["permiso"]==2){
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
$codigo=$_REQUEST['codigo'];
/*$titulo=$_REQUEST['titulo'];
$autor=$_REQUEST['autor'];
$cuerpo=$_REQUEST['cuerpo'];
$fechaini=$_REQUEST['fechaini'];
$fechafin=$_REQUEST['fechafin'];
$tiempo=$_REQUEST['tiempo'];*/
include 'conexionbd.php';
$conexion=mysqli_connect($host,$user,$pass,$bbdd);
if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
	echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
	echo "Holamundo";
}
else
{
	$consulta="select * from mensajes;";
	$resultado=mysqli_query($conexion,$consulta);
	$n_pags=mysqli_num_rows($resultado);
	/*if($codigo<$n_pags){
		for($i=$codigo;$i<$n_pags;$i++){
			$codigo++;
			$consulta="UPDATE `mensajes` SET `codigo`='$i' WHERE codigo='$codigo';";
			if(!mysqli_query($conexion,$consulta)){
				header("Location: editor.php");
			}
		}
	}*/
	$consulta="DELETE FROM mensajes WHERE codigo='$codigo';";
	echo $codigo;
	if(!mysqli_query($conexion,$consulta)){
		echo "No se ha podido borrar el post.";
	}
	else
	{
		//$resultado=mysqli_query($conexion,$consulta);
		header("Location: editor.php");
	}
}
?>