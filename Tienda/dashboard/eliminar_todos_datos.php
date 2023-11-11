<!DOCTYPE html>
<html lang="en">
<head>
	<!--Icono de la pestaña -->
	<title>Confirmacion de eliminacion todos los datos</title>

</head>

<?php
	require_once '../conexion.php';

	//Recibimos el dato correspodiente y lo almacenamos en una variable
	$tabla= $_GET['tabla'];

	//Evaluamos el valor de la variable para diferentes formas de eliminación
	if($tabla=='productos'){

		$sql = "DELETE FROM productos WHERE ACTIVO='1'";
		if(($conex -> query($sql) === TRUE)){
			require_once("ver_productos.php");			
			echo '<script language="javascript">TodosProductosEliminados();</script>';
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}

	} else if($tabla=='productos_eliminados'){

		$sql = "DELETE FROM productos WHERE ACTIVO='2'";
		if(($conex -> query($sql) === TRUE)){
			require_once("ver_productos_eliminados.php");			
			echo '<script language="javascript">TodosProductosEliminados();</script>';
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}

	} else if($tabla=='proveedores'){

		$sql = "DELETE FROM proveedores";
		$sql2= "ALTER TABLE proveedores AUTO_INCREMENT=1";
		if(($conex -> query($sql) === TRUE) and ($conex -> query($sql2) === TRUE)){
			require_once("ver_proveedores.php");			
			echo '<script language="javascript">TodosProveedoresEliminados();</script>';
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}

	} else if($tabla=='ventas'){

		$sql = "DELETE FROM ventas WHERE ACTIVO='2'";
		if(($conex -> query($sql) === TRUE)){
			require_once("ventas_administracion.php");			
			echo '<script language="javascript">TodasVentasEliminadas();</script>';
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}

	} else if($tabla=='productos_vendidos'){

		$sql = "DELETE FROM productos_vendidos";

		$sql_2 = "DELETE FROM grafica_vendidos";

		if(($conex -> query($sql) === TRUE and ($conex -> query($sql_2) === TRUE))){
			require_once("productos_vendidos.php");			
			echo '<script language="javascript">TodosProductosVendidos();</script>';
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}

	} else if($tabla=='usuarios'){

		$verificacion = mysqli_query($conex, "SELECT * FROM usuarios WHERE rol='cajero'");

    	if (mysqli_num_rows($verificacion) > 0) {

			$sql = "DELETE FROM usuarios WHERE rol='cajero'";
				if(($conex -> query($sql) === TRUE)){
					require_once("ver_usuarios.php");			
					echo '<script language="javascript">TodosUsuariosEliminados();</script>';
      				exit();
				}else{
					echo "Error al eliminar el registro: " . $conex->error;
				}
		}else{

			require_once("ver_usuarios.php");			
			echo '<script language="javascript">UsuariosEliminadosExistencia();</script>';

		}
	}
	
		
	$conex ->close();
?>