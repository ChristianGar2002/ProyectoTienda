<?php
  require_once '../conexion.php';

?>
<div class="modal fade" id="ActualizarProveedorModal<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <?php
    $id = $data['id'];

    $sql2= "SELECT * FROM proveedores WHERE id = {$id}";
    $result2= $conex->query($sql2);

    $data2= $result2->fetch_assoc();

?>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center bg-success" style="text-align: center;">
                <h5 class="modal-title text-white text-center" id="exampleModalLabel">Actualizar proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="actualizar_proveedor2.php" class="text-center" method="POST">    
            <div class="modal-body" style="background-color: #E5E5E5;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group text-center" id="user-group">
                            <label style="font-size: 16px;"><b>Nombre del proveedor:</b></label>
                            <input type="text" class="form-control text-center" placeholder="Nombre del proveedor" name="nombre_proveedor" value="<?php echo $data2['nombre_proveedor']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group text-center" id="user-group">
                            <label style="font-size: 16px;"><b>Dirección:</b></label>
                            <textarea class="form-control text-center" id="exampleFomrControlTextarea1" cols="3" name="direccion" placeholder="Dirección"style="resize: none;"  value="<?php echo $data2['direccion']?>" required><?php echo $data2['direccion']?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group text-center" id="user-group">
                            <label style="font-size: 16px;"><b>Codigo postal:</b></label>
                            <input type="number" class="form-control text-center" placeholder="Codigo postal" name="codigo_postal" value="<?php echo $data2['codigo_postal']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group text-center" id="user-group">
                            <label style="font-size: 16px;"><b>Localidad:</b></label>
                            <input type="text" class="form-control text-center" placeholder="Localidad" name="localidad" value="<?php echo $data2['localidad']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group text-center" id="user-group">
                            <label style="font-size: 16px;"><b>Télefono:</b></label>
                            <input type="number" max="99999999999" class="form-control text-center" placeholder="Telefono" name="telefono" value="<?php echo $data2['telefono']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group text-center" id="user-group">
                            <label style="font-size: 16px;"><b>Correo:</b></label>
                           <input type="text" class="form-control text-center" placeholder="Correo" name="correo" value="<?php echo $data2['correo']?>" required>
                        </div>
                    </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?php echo $data['id']?>"/>
                            </div>
                        </div>
                </div>       
            </div>
            <div class="modal-footer" style="background-color: #D2FEDD;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-success" name="actualizar_proveedor">Actualizar</button>
            </div>
        </form>
        </div>
    </div>
</div>  