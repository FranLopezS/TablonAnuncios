<html>
<head>
<meta name="tipo_contenido"  content="text/html;" http-equiv="content-type" charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
	<body>
<?php
function generarCodigo($longitud, $tipo=0){ 
    $codigo = "";
    $caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $max=strlen($caracteres)-1;
    for($i=0;$i < $longitud;$i++){
        $codigo.=$caracteres[rand(0,$max)];
    }
    return $codigo;
}
$p=generarCodigo(10);
$bandera=false;
$email=strtolower($_REQUEST['email']);
$asunto="Recuperación de contraseña";
$cabeceras="Hola";

include 'conexionbd.php';
$conexion=mysqli_connect($host,$user,$pass,$bbdd);
if (mysqli_connect_errno ()){ // Comprueba si te has conectado a la BBDD.
	echo "No se pudo conectar a MySQL: " . mysqli_connect_error () . ".<br>";
}
else
{
	$consulta="select email from usuarios;";
	if(!mysqli_query($conexion,$consulta)){
		echo "No se ha podido realizar la consulta.<br>";
	}
	else
	{
		$i=0;
		$resultado=mysqli_query($conexion,$consulta);
		while($fila=mysqli_fetch_array($resultado)){
				if($fila[0]==$email){
					$bandera=true;
				}
				$i++;
		}
		
		if(!$bandera==true){
			echo "El usuario introducido no está registrado.";
		}
		else
		{
			echo "¡El email ha sido enviado al correo $email!<br><br>Introduce el código $p para recuperar tu contraseña.";
			echo '<form name="registro" action="recuperacion.php" method ="POST">';
			echo '<center><p>Código de recuperación: <input type="text" name="codrec"/></p>';
			echo "<input type='hidden' name='rec' value='$p'/>";
			echo "<input type='hidden' name='email' value='$email'/>";
			echo '<input type="submit" value="Recuperar contraseña"/></center>';
			echo '</form>';
		}
	}
}
?>
	</body>
</html>