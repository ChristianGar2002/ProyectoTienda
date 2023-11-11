<!DOCTYPE html>
<html lang="en">
<head>
	<!--Icono de la pestaña -->
    <link rel="">
	<title>Confirmacion de eliminacion</title>

</head>

<?php
	require_once '../conexion.php';
	require_once('ver_categorias.php');

	if($_GET['id']){
		$id = $_GET['id'];

		echo $id;

		$sql = "DELETE FROM categorias WHERE id = {$id}";
		$sql2= "ALTER TABLE categorias AUTO_INCREMENT=1";
		if(($conex -> query($sql) === TRUE) and ($conex -> query($sql2) === TRUE)){
      		echo '<script language="javascript">EliminacionCategoria();</script>';
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}
	$conex ->close();
	}
?>