<?php
session_start();
if(isset($_SESSION["estado"])){
	if($_SESSION["permiso"]==3 || $_SESSION["permiso"]==2 || $_SESSION["permiso"]==1){
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
//$codigo=$_REQUEST['codigo'];
$titulo=$_REQUEST['titulo'];
$autor=$_REQUEST['autor'];
$cuerpo=$_REQUEST['cuerpo'];
$fechaini=$_REQUEST['fechaini'];
$fechafin=$_REQUEST['fechafin'];
$permiso=$_REQUEST['permiso'];
include 'conexionbd.php';
$conexion=mysqli_connect($host,$user,$pass,$bbdd);
if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
	echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
}
else
{
	$tmpoini = strtotime("$fechaini");
	$newformat = date('Y-m-d',$tmpoini);
	$consulta="select * from mensajes;";
	$resultado=mysqli_query($conexion,$consulta);
	//$n_pags=mysqli_num_rows($resultado);
	//$codigopost=$n_pags+1;
	if($permiso==1){
		include 'conexionbd.php';
		$conexion=mysqli_connect($host,$user,$pass,$bbdd);
		if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
			echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
		}
		else
		{
		$consulta="select * from mensajes_guardados;";
		$resultado=mysqli_query($conexion,$consulta);
		//$n_pags=mysqli_num_rows($resultado);
		//$codigopostg=$n_pags+1;
		}
		$consulta=$consulta="INSERT INTO `mensajes_guardados`(`titulo`, `autor`, `cuerpo`, `fecha_publicacion`, `fecha_fin`) VALUES ('$titulo','$autor','$cuerpo','$newformat','$fechafin');";
	}
	else
	{
		$consulta=$consulta="INSERT INTO `mensajes`(`titulo`, `autor`, `cuerpo`, `fecha_publicacion`, `fecha_fin`) VALUES ('$titulo','$autor','$cuerpo','$newformat','$fechafin');";
	}
	if(!mysqli_query($conexion,$consulta)){
		echo "No se ha podido insertar el post.";
	}
	else
	{
		//$resultado=mysqli_query($conexion,$consulta);
		header("Location: editor.php");
	}
}
?>