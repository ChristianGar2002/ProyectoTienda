<?php

	include("../conexion.php");
	if (isset($_POST['registrar_producto'])) {
			$codigo_producto= trim($_POST['codigo_producto']);
			$descripcion_producto= trim($_POST['descripcion_producto']);
			$precio_compra= trim($_POST['precio_compra']);
			$precio_venta= trim($_POST['precio_venta']);
			$cantidad= trim($_POST['cantidad']);
			$proveedor= trim($_POST['proveedor']);
			$categoria_id= trim($_POST['categoria_id']);
			$fecha_registro= date("d/m/y");

			$verificacion = mysqli_query($conex, "SELECT * FROM productos WHERE codigo_producto='$codigo_producto'and ACTIVO='1'");

    			if (mysqli_num_rows($verificacion) > 0) {
    				require_once("ver_productos.php");
      				echo '<script language="javascript">ProductoRepetido2();</script>';
      				exit();
    			}else{

					$consulta= "INSERT INTO productos(codigo_producto, descripcion_producto, precio_compra, precio_venta, cantidad, proveedor, categoria_id, fecha_registro, ACTIVO) VALUES('$codigo_producto', '$descripcion_producto','$precio_compra','$precio_venta','$cantidad','$proveedor','$categoria_id', '$fecha_registro', 1)";
					$resultado=mysqli_query($conex, $consulta);

			}

		if ($resultado == true) {
			require_once("ver_productos.php");			
			echo '<script language="javascript">ProductoCreado();</script>';
		}else{
			require_once("ver_productos.php");
			echo '<script language="javascript">ProductoFallido();</script>';
		}		
	}
?>