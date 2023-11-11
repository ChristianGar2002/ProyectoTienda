<!--Modal para CRUD-->
<?php
    $conexion=mysqli_connect('localhost', 'root', '', 'tienda');

?>
<div class="modal fade" id="NuevoProveedorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center bg-primary" style="text-align: center;">
                <h5 class="modal-title text-white text-center" id="exampleModalLabel">Registrar proveedores</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="accion_proveedores.php" class="text-center" method="POST">    
            <div class="modal-body" style="background-color: #E5E5E5;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Nombre del proveedor:</b></label>
                            <input type="text" class="form-control text-center" placeholder="Nombre del proveedor" name="nombre_proveedor" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Dirección:</b></label>
                            <textarea class="form-control text-center" id="exampleFomrControlTextarea1" cols="3" name="direccion" placeholder="Dirección del proveedor" style="resize: none;" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Codigo postal:</b></label>
                            <input type="number" class="form-control text-center" placeholder="Codigo postal" name="codigo_postal" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Localidad:</b></label>
                            <input type="text" class="form-control text-center" placeholder="Localidad" name="localidad" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Télefono:</b></label>
                            <input type="number" max="99999999999" class="form-control text-center" placeholder="Télefono" name="telefono" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Correo:</b></label>
                            <input type="text" class="form-control text-center" placeholder="Correo" name="correo" required>
                        </div>
                    </div>
                </div>       
            </div>
            <div class="modal-footer" style="background-color: #D2FEDD;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-primary" name="registrar_proveedor">Registrar</button>
            </div>
        </form>
        </div>
    </div>
</div>  