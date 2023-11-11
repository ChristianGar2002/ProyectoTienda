<!--Modal para CRUD-->
<div class="modal fade" id="EliminarDatosPorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header text-center bg-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">Elige el campo correspondiente y el valor a eliminar</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="eliminar_productos_por2.php" class="text-center" method="POST">    
            <div class="modal-body">
                <div class="form-group text-center">
                   <select name="campo" id="servicio" class="form-control text-center" placeholder="Ingresa el campo correspondiente">
                        <option value="null">Campo: </option>
                        <option value="descripcion_producto">Descripción</option>
                        <option value="proveedor">Proveedor</option>
                        <option value="precio_compra">Precio de compra</option>
                        <option value="precio_venta">Precio de venta</option>
                        <option value="fecha_registro">Fecha de registro</option>
                    </select>
                </div>          
            </div>
            <div class="modal-body" style="margin-top: -10px;">
                <div class="form-group text-center">
                    <input type="text" class="form-control text-center" name="valor" placeholder="Ingresa el valor correspondiente" required>
                </div>          
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-danger">Eliminar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  