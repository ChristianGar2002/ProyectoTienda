<?php 
	//Incluir el fichero de conexion
	include("conexion.php");
	//Incluir la clase pdf_mc_table
	include('pdf_mc_table_ventas_fechas.php');
	//Incluir la libreria FPD
	include_once("fpdf184/fpdf.php");

//Se capturan las fechas enviadas por el formulario
if (isset($_POST['fecha'])) {
	$fecha_inicial= trim($_POST['fecha_inicial']);
	$fecha_final= trim($_POST['fecha_final']);

//Conexión a la base de datos	
	$db = new dbConexion();
	$connString = $db->getConexion();

	//Se realiza una consulta para extrear los datos necesarios
	$result = mysqli_query($connString, "SELECT * FROM ventas WHERE ACTIVO=2 and fecha_registro BETWEEN '{$fecha_inicial}' AND '{$fecha_final}'") or die("Error en la BD: ".mysqli_error($connString));
	$header = mysqli_query($connString, "SELECT * FROM ventas WHERE ACTIVO=2 and fecha_registro BETWEEN '{$fecha_inicial}' AND '{$fecha_final}'");
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

		$pdf->SetY(28);
		//Movemos a la derecha la imagen
		$pdf->Cell(70);
		//Cuadro de titulo
		$pdf->Cell(43,10,"Desde: ",0,0,'C');

$pdf->SetFont('Arial', '', 16);
		$pdf->SetY(28);
		//Movemos a la derecha la imagen
		$pdf->Cell(90);
		//Cuadro de titulo
		$pdf->Cell(90,10,$fecha_inicial."  a  ".$fecha_final,0,0,'C');

		$pdf->Ln(10);


$pdf->SetFont('Arial','',14);

//set width for each column (6 columns)
$pdf->SetWidths(Array(30,45,70,30,28,48,25));

//set alignment
$pdf->SetAligns(Array(('C'),'C','C','C','C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);


//Encabezados de la tabla
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(30,6,utf8_decode('Id_venta'),1,0,'C',1);
$pdf->Cell(45,6,utf8_decode('Código'),1,0,'C',1);
$pdf->Cell(70,6,utf8_decode('Descripción'),1,0,'C',1);
$pdf->Cell(30,6,"Precio",1,0,'C',1);
$pdf->Cell(28,6,"Cantidad",1,0,'C',1);
$pdf->Cell(48,6,"Fecha de registro",1,0,'C',1);
$pdf->Cell(25,6,"Total",1,0,'C',1);

$pdf->Ln();

//Funcion para el formato de precios y totales

function SetCurrency(float $valor, string $signo='$'):string
{
	return $signo.number_format($valor,2, '.','');
}



//reset font
$pdf->SetFont('Arial','',14);
$total=0;
$total_cantidad=0;
$total_precio=0;
$total_por_cantidad2=0;
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);

//Datos de la consulta extraida
foreach($result as $item){
	//write data using Row() method containing array of values.
	$total_precio=$item['precio']*$item['cantidad'];
	$item['ACTIVO']=$total_precio;
	$pdf->Row(Array(
		$item['id_venta'],
		$item['codigo'],
		$item[utf8_decode('descripcion')],
		SetCurrency($item['precio']),
		$item['cantidad'],
		$item['fecha_registro'],
		SetCurrency($item['ACTIVO']),

	));

$total=$total+$item['precio'];

$total_cantidad=$total_cantidad+$item['cantidad'];

$total_por_cantidad=$item['precio']*$item['cantidad'];
$total_por_cantidad2=$total_por_cantidad2+$total_por_cantidad;
}
//Operaciones para los ultimos totales

$pdf->Ln();

$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(145,6,utf8_decode('Total'),1,0,'C',1);

$pdf->SetFont('Arial','B',14);

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);

$pdf->Cell(30,6,SetCurrency($total),1,0,'C',1);
$pdf->Cell(28,6,$total_cantidad,1,0,'C',1);

$pdf->Ln(8);

$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(145,6,utf8_decode('Total por cantidad'),1,0,'C',1);

$pdf->SetFont('Arial','B',14);

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);

$pdf->Cell(58,6,SetCurrency($total_por_cantidad2),1,0,'C',1);


//output the pdf
$pdf->Output('Reporte_Venta_Fecha.pdf', 'I');
}
?>