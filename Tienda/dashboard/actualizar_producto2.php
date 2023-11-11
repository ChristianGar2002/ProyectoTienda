<!DOCTYPE html>
<html lang="en">
<head>

	<title>Confirmacion actualización</title>

</head>
</html>
<?php
	require_once '../conexion.php';
	//Creamos las variables de PHP a traves de POST en la variables del formulario HTML.
	if($_POST){
		$codigo_producto= trim($_POST['codigo_producto']);
		$descripcion_producto= trim($_POST['descripcion_producto']);
		$precio_compra= trim($_POST['precio_compra']);
		$precio_venta= trim($_POST['precio_venta']);
		$cantidad= trim($_POST['cantidad']);
		$proveedor= trim($_POST['proveedor']);
		$categoria_id= trim($_POST['categoria_id']);

		$codigo_producto = $_POST['codigo_producto'];

		//Creamos la consulta de ACTUALIZACION en SQL con los datos recabados del POST a traves del ID del campo FOLIO que esta "oculto".
		
		$sql = "UPDATE productos SET codigo_producto = '$codigo_producto', descripcion_producto = '$descripcion_producto', precio_compra = '$precio_compra', precio_venta = '$precio_venta', cantidad = '$cantidad', proveedor = '$proveedor', categoria_id = '$categoria_id' WHERE codigo_producto = {$codigo_producto}";

		if($conex -> query($sql) === TRUE) {
			require_once("ver_productos.php");			
			echo '<script language="javascript">ActualizacionProducto();</script>';
      		exit();
		}else{
			echo "Error al actualizar el registro: " . $conex->error;
		}
	$conex ->close();
	}
?>
