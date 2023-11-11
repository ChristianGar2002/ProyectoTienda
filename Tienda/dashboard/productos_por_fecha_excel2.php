<?php 
	header("Content-Type:aplication/vnd.ms-excel; charset=iso-8859-1");
	//header("Content-Type:aplication/vnd.ms-excel");Al formato mas reciente de excel
	header("Content-Disposition:attachment;filename=productos.xls");
	$fecha_reporte= date("d/m/y");

?>

<?php 

	//Funcion para el formato de precios y totales

	function SetCurrency(float $valor, string $signo='$'):string
		{
			return $signo.number_format($valor,2, '.','');
		}

?>

<?php 
//Capturamos el rango de fechas enviados
if (isset($_POST['fecha'])) {
	$fecha_inicial= trim($_POST['fecha_inicial']);
	$fecha_final= trim($_POST['fecha_final']); ?>

<!--Estilos de la tabla -->
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
		<caption ><p style="font-size: 24px;"><b>Reporte de productos</b><br><p style="font-size: 20px;"><b>Fecha inicial: </b><?php echo $fecha_inicial ?> <b> Fecha final: </b><?php echo $fecha_final ?></p></p></caption>
		<tr class="thead-dark">
          <th style="font-size: 18px;background-color: #C6C6C6;">Código</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Descripción</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Precio de compra</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Precio de venta</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Cantidad</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Proveedor</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Categoria</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Fecha de registro</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Total de compra</th>
          <th style="font-size: 18px;background-color: #C6C6C6;">Total de venta</th>
		</tr>
			<?php
			//Variables para los totales
				$total_compra=0;
				$total_venta=0;
				$total_cantidad=0;
				$total_compra_cantidad2=0;
				$total_venta_cantidad2=0;
				$total_c=0;
				$total_v=0;
			?>
			<?php
				include("../conexion.php");
				$sql="SELECT * FROM productos WHERE ACTIVO=1 AND fecha_registro BETWEEN '{$fecha_inicial}' AND '{$fecha_final}'";
					$ejecutar=mysqli_query($conex, $sql);
					while ($fila=mysqli_fetch_array($ejecutar)) {
					?>
			<tr style="text-align: center; font-size: 13px;">
				<td style="font-size: 16px;"><?php echo $fila[0]?></td><!--Para imprimir el contedio de la tabla --> 
				<td style="font-size: 16px;"><?php echo $fila[1]?></td>
				<td style="font-size: 16px;"><?php echo SetCurrency($fila[2]);?></td>
				<td style="font-size: 16px;"><?php echo SetCurrency($fila[3]);?></td>
				<td style="font-size: 16px;"><?php echo $fila[4]?></td>
				<td style="font-size: 16px;"><?php echo $fila[5]?></td>
				
				<!-- Codigo para conseguir el nombre de la categoria -->
				<?php $data2=$fila['categoria_id']; ?>

            <?php 
              $sql2="SELECT * FROM categorias WHERE id = '$data2'";
          		$ejecutar2=mysqli_query($conex, $sql2);

            while ($fila2=mysqli_fetch_array($ejecutar2)) { ?>
            	<?php $fila[6]=$fila2[1] ?>
                
                  <td style="font-size: 16px;"><?php echo $fila[6]?></td>
                <?php } ?>

				<td style="font-size: 16px;"><?php echo $fila[7]?></td>

				<?php 
					$total_c=$fila[2]*$fila[4];

					$total_v=$fila[3]*$fila[4];

				?>

				<td style="font-size: 16px;"><?php echo SetCurrency($total_c); ?></td>
				<td style="font-size: 16px;"><?php echo SetCurrency($total_v); ?></td>

				<!-- Operaciones para los totales -->
				<?php 
				$total_compra=$total_compra+$fila[2];
				$total_venta=$total_venta+$fila[3];
				$total_cantidad=$total_cantidad+$fila[4];  
				?>

				<?php 
				$total_compra_cantidad=$fila[2]*$fila[4];
				$total_compra_cantidad2=$total_compra_cantidad2+$total_compra_cantidad;

				$total_venta_cantidad=$fila[3]*$fila[4];
				$total_venta_cantidad2=$total_venta_cantidad2+$total_venta_cantidad; 
				?>

			</tr>
		<?php } ?>
					
	</table>

	<table class="table text-center" style="border: 1px solid black; text-align: center;">
			<tr>
				<td style="font-size: 17px; text-align: center;" colspan="2"><b>Total</b></td>
				<td style="font-size: 16px;"><?php  echo SetCurrency($total_compra); ?></td>
				<td style="font-size: 16px;"><?php  echo SetCurrency($total_venta); ?></td>
				<td style="font-size: 16px;"><?php echo $total_cantidad ?></td>
			</tr>
	</table>

	<table class="table text-center" style="border: 1px solid black; text-align: center;">
			<tr>
				<td style="font-size: 17px; text-align: center;" colspan="2"><b>Total por cantidad</b></td>
				<td style="font-size: 16px;"><?php  echo SetCurrency($total_compra_cantidad2); ?></td>
				<td style="font-size: 16px;"><?php  echo SetCurrency($total_venta_cantidad2); ?></td>
			</tr>
	</table>

<?php }?>