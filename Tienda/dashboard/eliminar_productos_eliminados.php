<!DOCTYPE html>
<html lang="en">
<head>
	<!--Icono de la pestaña -->
    <link rel="icon" href="">
	<title>Confirmacion de eliminacion</title>

</head>

<?php
	require_once '../conexion.php';

	if($_GET['codigo_producto']){
		$codigo_producto = $_GET['codigo_producto'];

		$sql = "DELETE FROM productos WHERE codigo_producto = {$codigo_producto}";
		if($conex -> query($sql) === TRUE){
			include_once("ver_productos_eliminados.php");
      		echo '<script language="javascript">ProductoEliminado();</script>';
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}
	$conex ->close();
	}
?>