<?php
$host='localhost';
$username='root';
$password='';
$database='tienda';
$conn = new mysqli($host, $username, $password, $database);
$sql = "SELECT * FROM usuarios";
if ($result=mysqli_query($conn,$sql)) {
    $rowcount=mysqli_num_rows($result); 
}

$sql2="SELECT * FROM productos WHERE ACTIVO='1'";
if ($result=mysqli_query($conn,$sql2)) {
    $rowcount2=mysqli_num_rows($result); 
}

$sql3="SELECT * FROM productos WHERE ACTIVO='2'";
if ($result=mysqli_query($conn,$sql3)) {
    $rowcount3=mysqli_num_rows($result); 
}

$sql4="SELECT * FROM categorias";
if ($result=mysqli_query($conn,$sql4)) {
    $rowcount4=mysqli_num_rows($result); 
}

$sql5="SELECT * FROM proveedores";
if ($result=mysqli_query($conn,$sql5)) {
    $rowcount5=mysqli_num_rows($result); 
}

$sql6="SELECT distinct id_venta FROM ventas WHERE ACTIVO=2";
if ($result=mysqli_query($conn,$sql6)) {
    $rowcount6=mysqli_num_rows($result); 
}

$sql7="SELECT * FROM productos_vendidos";
if ($result=mysqli_query($conn,$sql7)) {
    $rowcount7=mysqli_num_rows($result); 
}
?>
<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1 style="color: black; margin-top: -30px;">Contenido principal</h1>
    <title>Panel principal</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.js" integrity="sha512-5m2r+g00HDHnhXQDbRLAfZBwPpPCaK+wPLV6lm8VQ+09ilGdHfXV7IVyKPkLOTfi4vTTUVJnz7ELs7cA87/GMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Productos -->
    <a class="col-xl-3 col-md-6 mb-4" href="ver_productos.php" style="text-decoration: none;">
      <div class="card shadow h-100 py-2 bg-info">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4 class="text-center text-white"> <?php  echo $rowcount2; ?> </h4><h6 class="text-center text-white"><b>Productos</b></h6></div>
            </div>
            <div class="col-auto" style="padding: 20px;">
              <i class="fas fa-shopping-cart fa-2x text-white"></i>
            </div>
          </div>
        </div>
      </div>
    </a>

    <?php if ($_SESSION['ROL'] == 'Administrador') { ?>
    <!-- Earnings (Monthly) Card Productos Eliminados -->
    <a class="col-xl-3 col-md-6 mb-4" href="ver_productos_eliminados.php" style="text-decoration: none;">
      <div class="card shadow h-100 py-2" style="background-color: #E0573F;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4 class="text-center text-white"> <?php  echo $rowcount3; ?> </h4><h6 class="text-center text-white"><b>Productos eliminados</b></h6></div>
            </div>
            <div class="col-auto" style="padding: 20px;">
              <i class="fas fa-trash fa-2x text-white"></i>
            </div>
          </div>
        </div>
      </div>
    </a>
    <?php } ?>

    <!-- Earnings (Monthly) Card Productos Eliminados -->
    <a class="col-xl-3 col-md-6 mb-4" href="productos_vendidos.php" style="text-decoration: none;">
      <div class="card shadow h-100 py-2" style="background-color: #B153B9;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4 class="text-center text-white"> <?php  echo $rowcount7; ?> </h4><h6 class="text-center text-white"><b>Productos vendidos</b></h6></div>
            </div>
            <div class="col-auto" style="padding: 20px;">
              <i class="fas solid fa-cart-arrow-down fa-2x text-white"></i>
            </div>
          </div>
        </div>
      </div>
    </a>

    <?php if ($_SESSION['ROL'] == 'Administrador') { ?>
    <!-- Earnings (Monthly) Card Usuarios -->
    <a class="col-xl-3 col-md-6 mb-4" href="ver_usuarios.php" style="text-decoration: none;">
      <div class="card shadow h-100 py-2 bg-warning">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1"><h4 class="text-center text-white"> <?php  echo $rowcount; ?> </h4><h6 class="text-center text-white"><b>Usuarios</b></h6></div>
            </div>
            <div class="col-auto" style="padding: 20px;">
              <i class="fas fa-user fa-2x text-white"></i>
            </div>
          </div>
        </div>
      </div>
    </a>

    <!-- Earnings (Monthly) Card Categorias -->
    <a class="col-xl-3 col-md-6 mb-4" href="ver_categorias.php" style="text-decoration: none;">
      <div class="card shadow h-100 py-2 bg-success">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4 class="text-center text-white"> <?php  echo $rowcount4; ?> </h4><h6 class="text-center text-white"><b>Categorias</b></h6></div>
            </div>
            <div class="col-auto" style="padding: 20px;">
              <i class="fas solid fa-align-justify fa-2x text-white"></i>
            </div>
          </div>
        </div>
      </div>
    </a>

    <!-- Earnings (Monthly) Card Proveedores -->
    <a class="col-xl-3 col-md-6 mb-4" href="ver_proveedores.php" style="text-decoration: none;">
      <div class="card shadow h-100 py-2" style="background-color: #B3A150;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4 class="text-center text-white"> <?php  echo $rowcount5; ?> </h4><h6 class="text-center text-white"><b>Proveedores</b></h6></div>
            </div>
            <div class="col-auto text-center" style="padding: 20px;">
              <i class="fas solid fa-people-carry fa-2x text-white"></i>
            </div>
          </div>
        </div>
      </div>
    </a>
    <?php } ?>

    <!-- Earnings (Monthly) Card Proveedores -->
    <a class="col-xl-3 col-md-6 mb-4" href="ventas_administracion.php" style="text-decoration: none;">
      <div class="card shadow h-100 py-2 bg-dark">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4 class="text-center text-white"> <?php  echo $rowcount6; ?> </h4><h6 class="text-center text-white"><b>Ventas</b></h6></div>
            </div>
            <div class="col-auto text-center" style="padding: 20px;">
              <i class="fas solid fa-dollar-sign fa-2x text-white"></i>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

<!-- Codigo de los productos con mas stock -->
<?php
$host='localhost';
$username='root';
$password='';
$database='tienda';
$conn = new mysqli($host, $username, $password, $database);

$sql_1 = mysqli_query($conn, "SELECT * FROM productos WHERE ACTIVO=1 GROUP BY cantidad DESC LIMIT 1");

$sql_2 = mysqli_query($conn, "SELECT * FROM productos WHERE ACTIVO=1 GROUP BY cantidad DESC LIMIT 2");

$sql_3 = mysqli_query($conn, "SELECT * FROM productos WHERE ACTIVO=1 GROUP BY cantidad DESC LIMIT 3");

foreach($sql_1 as $item):

    $descripcion_1=$item['descripcion_producto'];

    $cantidad_1=$item['cantidad'];

endforeach;

foreach($sql_2 as $item):

    $descripcion_2=$item['descripcion_producto'];

    $cantidad_2=$item['cantidad'];

endforeach;

foreach($sql_3 as $item):

    $descripcion_3=$item['descripcion_producto'];

    $cantidad_3=$item['cantidad'];

endforeach;

?>
<!--Fin de codigo -->

<!-- Codigo de los productos mas vendidos -->
<?php

$sql_4 = mysqli_query($conn, "SELECT * FROM grafica_vendidos  GROUP BY cantidad DESC LIMIT 1");

$sql_5 = mysqli_query($conn, "SELECT * FROM grafica_vendidos  GROUP BY cantidad DESC LIMIT 2");

$sql_6 = mysqli_query($conn, "SELECT * FROM grafica_vendidos  GROUP BY cantidad DESC LIMIT 3");


foreach($sql_4 as $item):

    $descripcion_4=$item['descripcion_producto'];

    $cantidad_4=$item['cantidad'];

endforeach;


foreach($sql_5 as $item):

    $descripcion_5=$item['descripcion_producto'];

    $cantidad_5=$item['cantidad'];

endforeach;

foreach($sql_6 as $item):

    $descripcion_6=$item['descripcion_producto'];

    $cantidad_6=$item['cantidad'];

endforeach;

?>
<!--Fin de codigo -->

<!-- Codigo de los productos mas eliminados -->
<?php

$sql_7 = mysqli_query($conn, "SELECT * FROM productos WHERE ACTIVO=1 GROUP BY cantidad ASC LIMIT 1");

$sql_8 = mysqli_query($conn, "SELECT * FROM productos WHERE ACTIVO=1 GROUP BY cantidad ASC LIMIT 2");

$sql_9 = mysqli_query($conn, "SELECT * FROM productos WHERE ACTIVO=1 GROUP BY cantidad ASC LIMIT 3");

foreach($sql_7 as $item):

    $descripcion_7=$item['descripcion_producto'];

    $cantidad_7=$item['cantidad'];

endforeach;

foreach($sql_8 as $item):

    $descripcion_8=$item['descripcion_producto'];

    $cantidad_8=$item['cantidad'];

endforeach;

foreach($sql_9 as $item):

    $descripcion_9=$item['descripcion_producto'];

    $cantidad_9=$item['cantidad'];

endforeach;

?>
<!--Fin de codigo -->

    <!-- Grafica de barra de los productos con mas stock -->
    <div class="row" style="text-align: center;margin-left: 5px;">
      <div class="col-lg-4">
        <div class="card shadow" style="margin-right: 20px;margin-bottom: 10px;">
          <div class="card-body">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4 class="text-center"> Productos con más stock </h4></div>
            <div class="row no-gutters align-items-center">
              <canvas id="myChartBarra" width="200" height="200"></canvas>
            </div> 
          </div>
        </div>
      </div>
  <!-- Fin de Grafica de pie de los productos con mas stock -->

  <!-- Grafica de pie de los productos mas vendidos -->
    <div class="col-lg-4">
      <div class="card shadow" style=" margin-right: 20px;margin-bottom: 10px;">
          <div class="card-body">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4 class="text-center"> Productos más vendidos </h4></div>
            <div class="row no-gutters align-items-center">
            <canvas id="myChartPie" width="200" height="200"></canvas>
            </div>
          </div>
      </div>
    </div>
  <!-- Fin de Grafica de pie de los productos mas vendidos -->

  <!-- Grafica de pie de los productos mas vendidos -->
    <div class="col-lg-4">
      <div class="card shadow" style="margin-bottom: 10px;margin-right: 20px;">
          <div class="card-body" >
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h4 class="text-center"> Productos con menos stock</h4></div>
            <div class="row no-gutters align-items-center">
            <canvas id="myChartDona" width="200" height="200"></canvas>
            </div>
          </div>
      </div>
    </div>
  </div>
  <!-- Fin de Grafica de pie de los productos mas vendidos -->

  <!-- Script de la Grafica de barra de los productos con mas stock--> 
  <script type="text/javascript">
  var ctx= document.getElementById("myChartBarra").getContext("2d");
  var myChart=new Chart(ctx,{
    type:"bar",
    data:{
      labels:['<?php echo $descripcion_1; ?>', '<?php echo $descripcion_2; ?>', '<?php echo $descripcion_3; ?>'],
      datasets:[{
        label:'Stock',
        data:[<?php echo $cantidad_3; ?>, <?php echo $cantidad_2 ?>, <?php echo $cantidad_1; ?>],
        backgroundColor:[
          'rgb(66, 134, 244)',
          'rgb(66, 134, 72)',
          'rgb(255, 13, 13)',
        ]
      }]
    }
  });
</script>
 <!--Fin del Script de la Grafica de pie de los productos con mas stock-->

   <!-- Script de la Grafica de pie de los productos mas vendidos--> 
  <script type="text/javascript">
  var ctx= document.getElementById("myChartPie").getContext("2d");
  var myChart=new Chart(ctx,{
    type:"pie",
    data:{
      labels:['<?php echo $descripcion_4; ?>', '<?php echo $descripcion_5; ?>', '<?php echo $descripcion_6; ?>'],
      datasets:[{
        label:'Num datos',
        data:[<?php echo $cantidad_4; ?>, <?php echo $cantidad_5 ?>, <?php echo $cantidad_6; ?>],
        backgroundColor:[
          'rgb(255, 138, 13)',
          'rgb(255, 13, 185)',
          'rgb(13, 167, 255)',
        ]
      }]
    }
  });
</script>
 <!--Fin del Script de la Grafica de pie de los productos mas vendidos-->

 <!-- Script de la Grafica de barra de los productos con mas stock--> 
  <script type="text/javascript">
  var ctx= document.getElementById("myChartDona").getContext("2d");
  var myChart=new Chart(ctx,{
    type:"doughnut",
    data:{
      labels:['<?php echo $descripcion_7; ?>', '<?php echo $descripcion_8; ?>', '<?php echo $descripcion_9; ?>'],
      datasets:[{
        label:'Stock',
        data:[<?php echo $cantidad_7; ?>, <?php echo $cantidad_8 ?>, <?php echo $cantidad_9; ?>],
        backgroundColor:[
          'rgb(50, 207, 0)',
          'rgb(232, 225, 0)',
          'rgb(0, 220, 227)',
        ]
      }]
    }
  });
</script>
 <!--Fin del Script de la Grafica de pie de los productos con mas stock-->

  <!-- Page Heading -->



<!-- /.container-fluid -->
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>