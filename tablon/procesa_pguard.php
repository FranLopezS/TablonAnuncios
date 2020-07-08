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
$codigo=$_REQUEST['cod'];
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
}
else
{
	/*$consulta="select * from mensajes;";
	$resultado=mysqli_query($conexion,$consulta);
	$n_pags=mysqli_num_rows($resultado);
	$newcod=$n_pags+1;*/
	$consulta="select * from mensajes_guardados where codigo=$codigo;";
	$resultado=mysqli_query($conexion,$consulta);
	while($fila=mysqli_fetch_array($resultado)){
		$autor=$fila["autor"];
		$titulo=$fila["titulo"];
		$cuerpo=$fila["cuerpo"];
		$fechap=$fila["fecha_publicacion"];
		$fechaf=$fila["fecha_fin"];
	}
	if(!mysqli_query($conexion,$consulta)){
		echo "No se ha podido borrar el post.";
	}
	$consulta="INSERT INTO `mensajes`(`titulo`, `autor`, `cuerpo`, `fecha_publicacion`, `fecha_fin`) VALUES ('$titulo','$autor','$cuerpo','$fechap','$fechaf');";
	if(!mysqli_query($conexion,$consulta)){
		echo "No se ha podido borrar el post.";
	}
	$consulta="select * from mensajes_guardados;";
	$resultado=mysqli_query($conexion,$consulta);
	$n_pags2=mysqli_num_rows($resultado);
	if($n_pags2>=2){
		if($codigo<$n_pags2){
			for($i=$codigo;$i<$n_pags2;$i++){
				$codigo++;
				$consulta="UPDATE `mensajes_guardados` SET `codigo`='$i' WHERE codigo='$codigo';";
				if(!mysqli_query($conexion,$consulta)){
					//header("Location: editor.php");
				}
			}
		}
	}
	$consulta="DELETE FROM mensajes_guardados WHERE codigo='$codigo';";
	if(!mysqli_query($conexion,$consulta)){
		echo "No se ha podido borrar el post.";
	}
	$consulta="select * FROM mensajes_guardados;";
	$resultado=mysqli_query($conexion,$consulta);
	$guardados=mysqli_num_rows($resultado);
	if($guardados>=1){
		header("Location: pguard.php");
	}
	else
	{
		header("Location: editor.php");
	}
}
?>