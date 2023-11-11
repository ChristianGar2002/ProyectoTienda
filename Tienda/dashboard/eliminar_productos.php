<!DOCTYPE html>
<html lang="en">
<head>
	<!--Icono de la pestaña -->
    <link rel="icon" href="../../img/logoquetzalt.jpg">
	<title>Confirmacion de eliminacion</title>

</head>

<?php
	require_once '../conexion.php';
	
	if($_GET['codigo_producto']){
		$codigo_producto= $_GET['codigo_producto'];

		$fecha_eliminacion= date("d/m/y");
		//Establecemos con el UPDATE para actualizar el estatus del campo ACTIVO a "2" y que se elimine y oculte del listado del documento index.php, pero que se siga manteniendo en la BD.

		$sql = "UPDATE productos SET ACTIVO = 2, fecha_eliminacion='$fecha_eliminacion' WHERE codigo_producto = {$codigo_producto}";
		if(($conex -> query($sql) === TRUE)){
			require_once("ver_productos.php");	
			echo '<script language="javascript">ProductoEliminado();</script>';
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}
	$conex ->close();
	}
?>