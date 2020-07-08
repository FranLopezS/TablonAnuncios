<?php
session_start();
$bandera=1;
$bandera2=false;
$email=strtolower($_REQUEST['email']);
$password=$_REQUEST['password'];

include 'conexionbd.php';
$conexion=mysqli_connect($host,$user,$pass,$bbdd);
		if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
			echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
		}
		else
		{
			$consulta="select * from usuarios where email='$email';";
			$resultado=mysqli_query($conexion,$consulta);
			while($fila=mysqli_fetch_array($resultado)){
				$nya=$fila[0];
				$contra=$fila[2];
				$permiso=$fila[3];
				if($email==$fila[1]){
					$bandera2=true;
				}
				if(!$bandera2==true){
					//echo "Estuve aquí";
					goto b;
				}
			}
			if(!mysqli_query($conexion,$consulta)){
				echo "No se ha podido realizar la consulta. <a href='index.php'>Volver al inicio</a>";
			}
		}
		if($password==$contra){
				$bandera=3;
		}
b:
if($bandera==1){
	$_SESSION["estado"]="0";
	echo "Email o contraseña incorrectos. <a href='iniciosesion.php'>Volver atrás</a>";
}
if($bandera==2){
	$c=true;
	$_SESSION["estado"]="0";
	echo "¡La cuenta no está activada! <a href='iniciosesion.php'>Volver atrás</a><br><br>";
	echo '<form name="registro" action="procesa_registro.php" method ="POST">';
	echo "<input type='hidden' name='email' value='$email'/>";
	echo "<input type='hidden' name='password' value='$password'/>";
	echo "<input type='hidden' name='c' value='$c'/>";
	echo '<input type="submit" value="Activar cuenta"/></center>';
	echo '</form>';
}
if($bandera==3){
	$_SESSION["cuentaemail"]=$email;
	$_SESSION["cuenta"]=$nya;
	// Estado 0-desconectado 1-conectado
	// Permisos: 0-usuario 1-root
	$_SESSION["estado"]=1;
	$_SESSION["permiso"]=$permiso;
	header('Location: editor.php');
}
?>