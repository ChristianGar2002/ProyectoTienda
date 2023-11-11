<!DOCTYPE html>
<html lang="en">
<head>
	<!--Icono de la pestaña -->
    <link rel="icon" href="../../img/logoquetzalt.jpg">
	<title>Confirmacion de eliminacion</title>

</head>

<?php
	require_once '../conexion.php';
	//Se capturan el id de la venta
	if($_GET['id_venta']){
		$id_venta= $_GET['id_venta'];
		echo $id_venta;
		//Se hace uso de la instruccion DELETE FROM para la eliminación de la venta
		$sql = "DELETE FROM ventas WHERE id_venta = {$id_venta}";
		if($conex -> query($sql) === TRUE){
			require_once("ventas_administracion.php");			
			echo '<script language="javascript">VentaEliminada();</script>';
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}
	$conex ->close();
	}
?>