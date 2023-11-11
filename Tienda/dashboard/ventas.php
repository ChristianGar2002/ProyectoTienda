<?php require_once "vistas/parte_superior.php"?>
<!--INICIO del cont principal-->

<?php
    $conexion=mysqli_connect('localhost', 'root', '', 'tienda');
?> 
<?php
//Seccion para agregar producto a la tabla ventas
  if (isset($_POST['busqueda'])) {

      $codigo= trim($_POST['codigo_producto']);

       $verificacion_producto_no_existe = mysqli_query($conexion, "SELECT * FROM productos WHERE codigo_producto={$codigo} and ACTIVO='1'");

    if (mysqli_num_rows($verificacion_producto_no_existe) > 0) {

      $verificacion_producto_repetido = mysqli_query($conexion, "SELECT * FROM ventas WHERE codigo='$codigo' and  ACTIVO='1'");

      //Seccion para productos repetidos
      if (mysqli_num_rows($verificacion_producto_repetido) > 0) {

          $resultado_cantidad_id = mysqli_query($conexion, "SELECT * FROM ventas WHERE codigo='$codigo'");

          foreach($resultado_cantidad_id as $item_2):

              $id_venta=$item_2['id_venta'];

            endforeach;

          $resultado_cantidad = mysqli_query($conexion, "SELECT * FROM ventas WHERE id_venta='$id_venta' and codigo='$codigo'");

            foreach($resultado_cantidad as $item_2):

              $cantidad=$item_2['cantidad'];

            endforeach;

          $valor=$cantidad+1;

          $sql = "UPDATE ventas SET cantidad = '$valor' WHERE id_venta = {$id_venta} and codigo={$codigo}";

          $resultado_cantidad_2=mysqli_query($conexion, $sql);

      } else{

        $resultado = mysqli_query($conexion, "SELECT * FROM productos WHERE codigo_producto='$codigo'");

        foreach($resultado as $item):

            $codigo=$item['codigo_producto'];

            $descripcion=$item['descripcion_producto'];

            $precio=$item['precio_venta'];

            $fecha_registro= date("d/m/y");

        endforeach;

         $query_2 = "INSERT INTO ventas(id_venta, codigo, descripcion, precio, cantidad, fecha_registro, ACTIVO) VALUES (0, '$codigo','$descripcion', '$precio', 1, '$fecha_registro', 1)";
         $resultado_2=mysqli_query($conexion, $query_2);
       }
    } else{
      require_once('venta_producto_no_existente.php');
      echo '<script language="javascript">ProductoNoExistente();</script>';
    }
  } 

//Seccion para el boton de aumentar la cantidad
if (isset($_POST['mas'])) {

    $codigo= trim($_POST['codigo']);

    $id_venta= trim($_POST['id_venta']);

    $resultado_cantidad = mysqli_query($conexion, "SELECT * FROM ventas WHERE id_venta='$id_venta' and codigo='$codigo'");

    $cantidad=0;
    
    foreach($resultado_cantidad as $item_2):

       $cantidad=$item_2['cantidad'];

    endforeach;

    $valor=$cantidad+1;

    $sql = "UPDATE ventas SET cantidad = '$valor' WHERE id_venta = {$id_venta} and codigo={$codigo}";

    $resultado_cantidad_2=mysqli_query($conexion, $sql);

  }

//Seccion para el boton de disminuir la cantidad
if (isset($_POST['menos'])) {

    $codigo= trim($_POST['codigo']);

    $id_venta= trim($_POST['id_venta']);

    $resultado_cantidad = mysqli_query($conexion, "SELECT * FROM ventas WHERE id_venta='$id_venta' and codigo='$codigo'");

    $cantidad=0;

    foreach($resultado_cantidad as $item_2):

       $cantidad=$item_2['cantidad'];

    endforeach;

    if($cantidad>1){

      $valor=$cantidad-1;

    }else{

      $valor=1;

    }

    $sql = "UPDATE ventas SET cantidad = '$valor' WHERE id_venta = {$id_venta} and codigo={$codigo}";

    $resultado_cantidad_2=mysqli_query($conexion, $sql);

  }

?>
<div class="container">
<?php
    $conexion=mysqli_connect('localhost', 'root', '', 'tienda');
?> 
    <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Estilos de bosstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Los iconos tipo Solid de Fontawesome-->
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
   integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <link rel="stylesheet" href="css/iconos.css">  

    <title>Ventas</title>
  </head>
  <body>
    <h1 class="display text-center" style="margin-top: -50px;">Punto de venta</h1>
        <br>
  <!--Tabla de Boostrap-->
  <div class="container-fluid">
  <div class="row" style="margin-top: auto;">
   <div class="col-md-7">
    <form method="POST" action="ventas.php" autocomplete="off" style="width: 500px;">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary" name="busqueda">Búsqueda</button>
            </span>
            <input type="number" class="form-control" name="codigo_producto" placeholder="Codigo de producto" autofocus required>
         </div>
        </div>
    </form>
   </div>
   <div class="col-md-5">
    <div style="float: right;margin-bottom: 10px;margin-left: auto;">
      <a href="PDF/ticket.php"><button type="submit" class="btn btn-success" name="realizar" style="margin-right: 30px;">Crear ticket</button></a>
    </div>
  </div>
  </div>
    
  <div class="table-wrapper-scroll-y my-custom-scrollbar">
   <table class="table table-responsive text-center table-bordered table-hover" style="border-radius: 10px;">
      <thead class="thead-dark text-center">
        <tr>
          <th width="30%">Código</th>
          <th width="40%">Descripción</th>
          <th width="5%">Precio</th>
          <th width="10%">Cantidad</th>
          <th width="20%">Acciones</th>
        </tr>
      </thead>
     <?php
          $total_2=0;
          $query=mysqli_query($conexion,"SELECT * FROM ventas WHERE ACTIVO='1'");
          $result = mysqli_num_rows($query);

          if($result > 0){ 
           while ($data = mysqli_fetch_assoc($query)) { ?>
                <tr>
                  <td><?php echo $data['codigo']; ?></td>
                  <td><?php echo $data['descripcion']; ?></td>
                  <td><?php echo $data['precio']; ?></td>
                  <td><?php echo $data['cantidad']; ?></td>
                  <td class="text-center">
                  <form action="ventas.php" method="POST">
                  <button type="submit" class='btn btn-primary' name="mas"><span><i class="fas fa-plus"></i></span></button>
                  <button type="submit" class='btn btn-danger' name="menos"><span><i class="fa solid fa-minus"></i></span></button>
                  <input type="hidden" name="codigo" value="<?php echo $data['codigo']?>"/>
                  <input type="hidden" name="id_venta" value="<?php echo $data['id_venta']?>"/>
                </form>
              </td>
                </tr>
                <?php 
                  $total=$data['precio']*$data['cantidad'];
                  $total_2=$total_2+$total;
                ?>
            <?php }
          } else{
            //Si la BD esta vacia o no tiene informacion de ex alumnos con codigo activo en 2 no mostrara datos y dira lo siguiente 
            echo "<tr> <td colspan='5'> <center>Datos no disponibles/ Base de datos vacia.</center></td></tr>";
          }
      ?>
      </table>
    </div>
    <?php 

      //Funcion para el formato de precios y totales

      function SetCurrency(float $valor, string $signo='$'):string
      {
       return $signo.number_format($valor,2, '.','');
      }

    ?>
      <div style="margin-top: auto; margin-bottom: 5px;">
        <div class="row" style="margin-top: auto;">
          <div class="col-md-5">
            <div style="margin-left: 20px;background-color: #D7FF8D;width: 280px;padding: 15px;margin-bottom: auto;">
              <p style="font-size: 28px">Total: <?php echo SetCurrency($total_2); ?></p>
            </div>
          </div>
          <div class="col-md-7" style="margin-top: auto;">
            <div style="margin-top: auto;float: right; margin-right: 30px;margin-left: 10px;">
                  <button type='button' class='btn btn-dark' data-toggle="modal" data-target="#CobrarModal" class='btn btn-dark' style="margin-left: 230px;width: 280px;padding: 25px; margin-bottom: auto;font-size: 23px;">Cobrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Ventana modal para cobrar -->
        <div class="modal fade" id="CobrarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Ingresa la cantidad de pago</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <form action="realizar_venta.php" class="text-center" method="POST">    
                    <div class="modal-body">
                        <div class="form-group text-center">
                          <label style="font-size: 24px;"><b>PAGO:</b></label>
                            <input type="number" class="form-control text-center" name="cobro" placeholder="Ingrese la cantidad con la que se pagara" style="resize: none;font-size: 22px;" required>
                        </div> 
                        <div class="form-group text-center">
                            <input type="hidden" class="form-control text-center" name="total_2" placeholder="Ingrese la cantidad con la que se pagara" value="<?php echo $total_2 ?>"/>
                        </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-primary" name="cobrar">Cobrar</button>
                    </div>
                </form>    
                </div>
            </div>
        </div> 
    
    </div>
  <!--Fin de la tabla de Boostrap-->   
    
</div>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>