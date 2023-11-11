<!DOCTYPE html>
<html lang="en">
<head>

	<title>Confirmacion actualización</title>

</head>
</html>
<?php
	require_once '../conexion.php';

	if($_POST){
		$nombre_proveedor= trim($_POST['nombre_proveedor']);
		$direccion= trim($_POST['direccion']);
		$codigo_postal= trim($_POST['codigo_postal']);
		$localidad= trim($_POST['localidad']);
		$telefono= trim($_POST['telefono']);
		$correo= trim($_POST['correo']);

		$id = $_POST['id'];

		//Se actualizan los datos del proveedor con UPDATE SET
		
		$sql = "UPDATE proveedores SET nombre_proveedor = '$nombre_proveedor', direccion = '$direccion', codigo_postal = '$codigo_postal', localidad = '$localidad', telefono = '$telefono', correo = '$correo' WHERE id = {$id}";

		if($conex -> query($sql) === TRUE) {
			require_once("ver_proveedores.php");			
			echo '<script language="javascript">ActualizacionProveedor();</script>';
      		exit();
		}else{
			echo "Error al actualizar el registro: " . $conex->error;
		}
	$conex ->close();
	}
?>
