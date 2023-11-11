<?php 
	//Incluir el fichero de conexion
	include("conexion.php");
	//Incluir la libreria FPD

	include('pdf_mc_table_proveedores.php');

	include_once("fpdf184/fpdf.php");

//Cuerpo de la tabla	
	$db = new dbConexion();
	$connString = $db->getConexion();
	$result = mysqli_query($connString, "SELECT * FROM proveedores") or die("Error en la BD: ".mysqli_error($connString));
	$header = mysqli_query($connString, "SELECT * FROM proveedores");
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
$pdf->SetWidths(Array(12,40,55,36,40,50,43));

//set alignment
$pdf->SetAligns(Array(('C'),'C','C','C','C','C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//add table heading using standard cells
//set font to bold
//$prueba=['ID',''];

//$pdf->Row(Array(

	//$prueba[0],
	//));

$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);

$pdf->Cell(12,6,"ID",1,0,'C',1);
$pdf->Cell(40,6,"Nombre",1,0,'C',1);
$pdf->Cell(55,6,utf8_decode('Dirección'),1,0,'C',1);
$pdf->Cell(36,6,"Codigo postal",1,0,'C',1);
$pdf->Cell(40,6,utf8_decode('Teléfono'),1,0,'C',1);
$pdf->Cell(50,6,"Correo",1,0,'C',1);
$pdf->Cell(43,6,"Fecha de registro",1,0,'C',1);

$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',14);

$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
//loop the data
foreach($result as $item){
	//write data using Row() method containing array of values.
	$pdf->Row(Array(
		$item['id'],
		$item[utf8_decode('nombre_proveedor')],
		$item[utf8_decode('direccion')],
		$item['codigo_postal'],
		$item['telefono'],
		$item['correo'],
		$item['fecha_registro'],

	));

	
}

//output the pdf
$pdf->Output('Reporte_Proveedores.pdf', 'I');

?>