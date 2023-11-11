<!DOCTYPE html>
<html lang="en">
<head>

	<title>Confirmacion actualización</title>

</head>
</html>
<?php
	require_once '../conexion.php';
	//Recibimos los valores para la actualización
	if($_POST){
		$name= trim($_POST['name']);
		$username= trim($_POST['username']);
		$password= trim($_POST['password']);
		$correo= trim($_POST['correo']);
		$rol= trim($_POST['rol']);

		$id = $_POST['id'];

		

		//Realizamos una consulta con UPDATE SET para la actualización de los usuarios
		
		$sql = "UPDATE usuarios SET name = '$name', username = '$username', password = '$password', correo = '$correo', rol = '$rol' WHERE id = {$id}";

		if($conex -> query($sql) === TRUE) {
			require_once("ver_usuarios.php");			
			echo '<script language="javascript">ActualizacionUsuario();</script>';
      		exit();
		}else{
			echo "Error al actualizar el registro: " . $conex->error;
		}
	$conex ->close();
	}
?>
