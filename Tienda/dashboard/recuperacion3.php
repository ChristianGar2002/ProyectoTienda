<!DOCTYPE html>
<html lang="en">
<head>

	<title>Confirmacion actualización</title>

</head>
</html>
<?php
	require_once '../conexion.php';
	include('../login/iniciar_sesion.php');
	//Creamos las variables de PHP a traves de POST en la variables del formulario HTML.
	if($_POST){
		$password= trim($_POST['password']);

		$clave_recuperacion2 = $_POST['dato'];

			$sql = "UPDATE usuarios SET password = '$password' WHERE clave_recuperacion = {$clave_recuperacion2}";

			if($conex -> query($sql) === TRUE) {

      			echo '<script language="javascript">ActualizacionContra();</script>';
      			
      			exit();
			}else{
				echo "Error al actualizar el registro: " . $conex->error;
			}
	$conex ->close();
	}
?>
