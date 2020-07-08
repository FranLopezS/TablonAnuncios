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
?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<?php
$codigo=$_REQUEST['codigo'];
$titulo=$_REQUEST['titulo'];
$autor=$_REQUEST['autor'];
$cuerpo=$_REQUEST['cuerpo'];
$fechafin=$_REQUEST['fechafin'];
include 'conexionbd.php';
$conexion=mysqli_connect($host,$user,$pass,$bbdd);
if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
	echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
}
else
{
	$consulta="UPDATE `mensajes` SET `titulo`='$titulo',`autor`='$autor',`cuerpo`='$cuerpo',`fecha_fin`='$fechafin' WHERE codigo=$codigo;";
	if(!mysqli_query($conexion,$consulta)){
		echo "No se ha podido editar el post.";
	}
	else
	{
		//$resultado=mysqli_query($conexion,$consulta);
		header("Location: editor.php");
	}
}
?>