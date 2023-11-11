<?php
  require_once '../conexion.php';
  include('../login/iniciar_sesion.php');

  if (isset($_POST['recuperar_contra'])) {
    $clave_recuperacion= trim($_POST['clave_recuperacion']);
    $sql= "SELECT * FROM usuarios WHERE clave_recuperacion = '{$clave_recuperacion}'";
    $result= $conex->query($sql);
    
    $data= $result->fetch_assoc();
    if(mysqli_num_rows($result) == 0){
   	echo '<script language="javascript">RecuperacionFallida();</script>'; 
	}
?>

<div class="modal fade" id="Recuperar2Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Ingresa la nueva contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="../dashboard/recuperacion3.php" class="text-center" method="POST">    
            <div class="modal-body">
                <div class="form-group text-center">
                    <input type="text" class="form-control text-center" style="padding-left: 0px;" name="password" placeholder="Nueva contraseña" required>
                </div>
                <div class="col-lg-12">
                   <div class="form-group">
                      <input type="hidden" name="dato" value="<?php echo $data['clave_recuperacion']?>"/>
                    </div>
                </div>          
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-primary" name="actualizar_contra">Ingresar</button>
            </div>
        </form>    
        </div>
    </div>
</div>
<?php 
  }
?>  