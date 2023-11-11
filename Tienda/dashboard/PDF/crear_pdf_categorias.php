<?php 
	//Incluir el fichero de conexion
	include("conexion.php");
	//Incluir la libreria FPD

	include('pdf_mc_table_categorias.php');

	include_once("fpdf184/fpdf.php");

//Cuerpo de la tabla	
	$db = new dbConexion();
	$connString = $db->getConexion();
	$result = mysqli_query($connString, "SELECT * FROM categorias") or die("Error en la BD: ".mysqli_error($connString));
	$header = mysqli_query($connString, "SELECT * FROM categorias");

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
		$pdf->Cell(60);
		//Cuadro de titulo
		$pdf->Cell(100,10,"Fecha: ",0,0,'C');

$pdf->SetFont('Arial', '', 16);
		$pdf->SetY(25);
		//Movemos a la derecha la imagen
		$pdf->Cell(80);
		//Cuadro de titulo
		$pdf->Cell(100,10,$fecha_registro,0,0,'C');
		
		$pdf->Ln(10);

$pdf->SetFont('Arial','',14);

//set width for each column (6 columns)
$pdf->SetWidths(Array(25,110,65));

//set alignment
$pdf->SetAligns(Array(('C'),'C','C','C','C','C','C'));

//set line height. This is the height of each lines, not rows.
$pdf->SetLineHeight(5);

//add table heading using standard cells
//set font to bold
//$prueba=['ID',''];

//$pdf->Row(Array(

	//$prueba[0],
	//));
$pdf->Setx(45);
$pdf->SetFont('Arial','B',14);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(25,6,"ID",1,0,'C',1);
$pdf->Cell(110,6,utf8_decode('Nombre de la categoría'),1,0,'C',1);
$pdf->Cell(65,6,"Fecha de registro",1,0,'C',1);

$pdf->Ln();

//reset font
$pdf->SetFont('Arial','',14);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);
//loop the data
foreach($result as $item){
	$pdf->Setx(45);
	//write data using Row() method containing array of values.
	$pdf->Row(Array(
		$item['id'],
		$item[utf8_decode('nombre_categoria')],
		$item['fecha_registro'],
	));
	
}
//output the pdf
$pdf->Output('Reporte_Usuarios.pdf', 'I');

?>