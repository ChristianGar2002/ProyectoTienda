<?php 
	//Incluir el fichero de conexion
	include("conexion.php");
	//Incluir la libreria FPD

	include('pdf_mc_table_productos_eliminados.php');

	include_once("fpdf184/fpdf.php");

//Cuerpo de la tabla	
	$db = new dbConexion();
	$connString = $db->getConexion();
	$result = mysqli_query($connString, "SELECT * FROM productos WHERE ACTIVO=2") or die("Error en la BD: ".mysqli_error($connString));
	$header = mysqli_query($connString, "SELECT * FROM productos WHERE ACTIVO=2");
	$fecha_registro= date("d/m/y");

//make new object
$pdf = new PDF_MC_Table("L");

//add page, set font

//Header
	$pdf -> AddPage();

	$pdf -> SetAutoPageBreak(true,20);

	//Footer
	$pdf->AliasNbPages();

//Fecha
$pdf->SetFont('Arial', 'B', 16);

		$pdf->SetY(25);
		//Movemos a la derecha la imagen
		$pdf->Cell(70);
		//Cuadro de titulo
		$pdf->Cell(100,10,"Fecha: ",0,0,'C');

$pdf->SetFont('Arial', '', 16);
		$pdf->SetY(25);
		//Movemos a la derecha la imagen
		$pdf->Cell(90);
		//Cuadro de titulo
		$pdf->Cell(100,10,$fecha_registro,0,0,'C');

		$pdf->Ln(10);

$pdf->SetFont('Arial','',14);

//set width for each column (6 columns)
$pdf->SetWidths(Array(35,45,40,35,28,30,35,33));

//set alignment
$pdf->SetAligns(Array(('C'),'C','C','C','C','C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//add table heading using standard cells
//set font to bold

$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);

$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(35,6,"Codigo",1,0,'C',1);
$pdf->Cell(45,6,utf8_decode('Descripción'),1,0,'C',1);
$pdf->Cell(40,6,"Precio compra",1,0,'C',1);
$pdf->Cell(35,6,"Precio venta",1,0,'C',1);
$pdf->Cell(28,6,"Cantidad",1,0,'C',1);
$pdf->Cell(30,6,"Proveedor",1,0,'C',1);

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(233,233,233);
$pdf->Cell(35,6,"Total compra",1,0,'C',1);
$pdf->Cell(33,6,"Total venta",1,0,'C',1);

$pdf->Ln();
//reset font
$pdf->SetFont('Arial','',14);

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(233,233,233);
//loop the data

//Funcion para el formato de precios y totales

function SetCurrency(float $valor, string $signo='$'):string
{
	return $signo.number_format($valor,2, '.','');
}
$total_compra2=0;
$total_venta2=0;
$total_cantidad=0;
$total_compra_cantidad2=0;
$total_venta_cantidad2=0;
foreach($result as $item){
	//write data using Row() method containing array of values.
	

	$total_compra=$item['precio_compra']*$item['cantidad'];
	$total_venta=$item['precio_venta']*$item['cantidad'];

	$item['categoria_id']=$total_compra;
	$item['fecha_registro']=$total_venta;
	$pdf->Row(Array(
		$item['codigo_producto'],
		$item[utf8_decode('descripcion_producto')],
		SetCurrency($item['precio_compra']),
		SetCurrency($item['precio_venta']),
		$item['cantidad'],
		$item['proveedor'],
		SetCurrency($item['categoria_id']),
		SetCurrency($item['fecha_registro']),

	));



//Operaciones para los ultimos totales
$total_compra2=$total_compra2+$item['precio_compra'];
$total_venta2=$total_venta2+$item['precio_venta'];
$total_cantidad=$total_cantidad+$item['cantidad'];
$total_compra_cantidad=$item['precio_compra']*$item['cantidad'];
$total_compra_cantidad2=$total_compra_cantidad2+$total_compra_cantidad;
$total_venta_cantidad=$item['precio_venta']*$item['cantidad'];
$total_venta_cantidad2=$total_venta_cantidad2+$total_venta_cantidad;		
}
$pdf->SetFont('Arial','B',14);
$pdf->Cell(80,6,"Total",1,0,'C',1);

$pdf->Cell(40,6,SetCurrency($total_compra2),1,0,'C',1);
$pdf->Cell(35,6,SetCurrency($total_venta2),1,0,'C',1);
$pdf->Cell(28,6,$total_cantidad,1,1,'C',1);

$pdf->Cell(80,6,"Total cantidad",1,0,'C',1);

$pdf->Cell(40,6,SetCurrency($total_compra_cantidad2),1,0,'C',1);
$pdf->Cell(35,6,SetCurrency($total_venta_cantidad2),1,0,'C',1);


//output the pdf
$pdf->Output('Reporte_Productos_Eliminados.pdf', 'I');

?>