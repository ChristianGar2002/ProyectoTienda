<!DOCTYPE html>
<html lang="en">
<head>
	<!--Icono de la pestaña -->
    <link rel="icon" href="../../img/logoquetzalt.jpg">
	<title>Confirmacion de eliminacion</title>

</head>

<?php
	require_once '../conexion.php';
	//Capturamos el id de la venta enviada
	if($_GET['id_venta']){

		$id_venta= $_GET['id_venta'];

		$codigo= $_GET['codigo'];
		
		//Borramos el producto correspondiente
		$sql = "DELETE FROM productos_vendidos WHERE id_venta = {$id_venta} and codigo={$codigo}";

		//Codigo para eliminar producto del grafico de productos vendidos

		$resultado_2= mysqli_query($conex, "SELECT * FROM ventas WHERE id_venta = {$id_venta} and codigo={$codigo}");

		$cantidad_pv=0;

		foreach($resultado_2 as $item):

        $codigo=$item['codigo'];

        $cantidad_pv=$item['cantidad'];

    endforeach;

    $verificacion= mysqli_query($conex, "SELECT * FROM grafica_vendidos WHERE codigo_producto={$codigo}");

    if (mysqli_num_rows($verificacion) > 0) {

    $resultado_3= mysqli_query($conex, "SELECT * FROM grafica_vendidos WHERE codigo_producto={$codigo}");

    foreach($resultado_3 as $item):

        $cantidad_gv=$item['cantidad'];

    endforeach;

    $valor=$cantidad_gv-$cantidad_pv;

    if($valor>0){

    	$sql_2 = "UPDATE grafica_vendidos SET cantidad = '$valor' WHERE codigo_producto={$codigo}";

    	$resultado_final=mysqli_query($conex, $sql_2);

    } else if($valor<=0){

    	$sql = "DELETE FROM grafica_vendidos WHERE codigo_producto={$codigo}";
    }
  }

//Fin del codigo para eliminar producto del grafico de productos vendidos
  
		if(($conex -> query($sql) === TRUE)){
			require_once("productos_vendidos.php");			
			echo '<script language="javascript">ProductoVendidoEliminado();</script>';
      		exit();
		}else{
			echo "Error al eliminar el registro: " . $conex->error;
		}
	$conex ->close();
	}
?>