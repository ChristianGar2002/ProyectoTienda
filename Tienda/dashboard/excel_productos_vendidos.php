<?php 
	header("Content-Type:aplication/vnd.ms-excel; charset=iso-8859-1");
	//header("Content-Type:aplication/vnd.ms-excel");Al formato mas reciente de excel
	header("Content-Disposition:attachment;filename=productos_vendidos.xls");
	$fecha_reporte= date("d/m/y");

?>

<?php 

	//Funcion para el formato de precios y totales

	function SetCurrency(float $valor, string $signo='$'):string
		{
			return $signo.number_format($valor,2, '.','');
		}

?>
<head>
	<style type="text/css">
table {
   width: 100%;
   border: 1px solid #000;
}
th, td {
   width: 25%;
   vertical-align: top;
   border: 1px solid #000;
   border-collapse: collapse;
   padding: 0.3em;
   caption-side: bottom;
}
th {
   background: #eee;
}
</style>
</head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<table class="table text-center" style="border: 1px solid black; text-align: center; margin-right: auto;margin-left: auto;">
		<caption ><p style="font-size: 24px;"><b>Reporte de productos vendidos</b><br><p style="font-size: 20px;"><b>Fecha: </b><?php echo $fecha_reporte ?></p></p></caption>
		<tr class="thead-dark">
			<th style="font-size: 18px;background-color: #C6C6C6;">Id de venta</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Código</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Descripción</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Precio</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Cantidad</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Fecha de registro</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Total</th>
		</tr>
			<?php 
				$total=0;
				$total_precio=0;
				$total_cantidad=0;
				$total_precio_cantidad2=0;
			?>
			<?php
				include("../conexion.php");
				$sql="SELECT * FROM productos_vendidos";
					$ejecutar=mysqli_query($conex, $sql);
					while ($fila=mysqli_fetch_array($ejecutar)) {
					?>
			<tr style="text-align: center; font-size: 13px;">
				<td style="font-size: 16px;"><?php echo $fila[0]?></td>
				<td style="font-size: 16px;"><?php echo $fila[1]?></td><!--Para imprimir el contedio de la tabla --> 
				<td style="font-size: 16px;"><?php echo $fila[2]?></td>
				<td style="font-size: 16px;"><?php echo SetCurrency($fila[3]);?></td>
				<td style="font-size: 16px;"><?php echo $fila[4]?></td>
				<td style="font-size: 16px;"><?php echo $fila[5]?></td>

				<?php 
					$total=$fila[3]*$fila[4];
				?>

				<td style="font-size: 16px;"><?php echo SetCurrency($total); ?></td>

				<?php 
				$total_precio=$total_precio+$fila[3];
				$total_cantidad=$total_cantidad+$fila[4];  
				?>

				<?php 
				$total_precio_cantidad=$fila[3]*$fila[4];
				$total_precio_cantidad2=$total_precio_cantidad2+$total_precio_cantidad;

				?>

			</tr>
		<?php } ?>
					
	</table>

	<table class="table text-center" style="border: 1px solid black; text-align: center;">
			<tr>
				<td style="font-size: 17px; text-align: center;" colspan="3"><b>Total</b></td>
				<td style="font-size: 16px;"><?php  echo SetCurrency($total_precio); ?></td>
				<td style="font-size: 16px;"><?php echo $total_cantidad ?></td>
			</tr>
	</table>

	<table class="table text-center" style="border: 1px solid black; text-align: center;">
			<tr>
				<td style="font-size: 17px; text-align: center;" colspan="3"><b>Total por cantidad</b></td>
				<td style="font-size: 16px;" colspan="2"><?php  echo SetCurrency($total_precio_cantidad2); ?></td>
			</tr>
	</table>

