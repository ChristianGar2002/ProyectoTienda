<!--Modal para CRUD-->
<?php
    $conexion=mysqli_connect('localhost', 'root', '', 'tienda');

?>
<div class="modal fade" id="NuevoProductoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center bg-primary" style="text-align: center;">
                <h5 class="modal-title text-white text-center" id="exampleModalLabel">Registrar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="accion_productos.php" method="POST">    
            <div class="modal-body text-center" style="background-color: #E5E5E5;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Codigo del producto:</b></label>
                            <input type="number" class="form-control text-center" placeholder="Codigo del producto" name="codigo_producto" required>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Decripción:</b></label>
                            <textarea class="form-control text-center" id="exampleFomrControlTextarea1" cols="2" name="descripcion_producto" placeholder="Descripción del producto" style="resize: none;" required></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Precio de compra:</b></label>
                            <input step="0.01" type="number" max="99999.99" class="form-control text-center" placeholder="Precio de compra" name="precio_compra" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                             <label style="font-size: 16px;"><b>Precio de venta:</b></label>
                            <input step="0.01" type="number" max="99999.99" class="form-control text-center" placeholder="Precio de venta" name="precio_venta" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Cantidad:</b></label>
                            <input type="number" max="999"class="form-control text-center" placeholder="Cantidad" name="cantidad" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Proveedor:</b></label>
                            <input type="text" class="form-control text-center" placeholder="Proveedor" name="proveedor" required>
                        </div>
                    </div>
                    <div class="col-lg-6" style="margin-top: -20px;">
                        <div class="form-group mt-3" id="user-group">
                            <label style="font-size: 16px;"><b>Categoria:</b></label>
                            <select name="categoria_id" class="form-control text-center" placeholder="Rol" required>
                                <option value="null">Categorias: </option>
                                <?php 
                                $query=mysqli_query($conexion,"SELECT * FROM categorias");
                                $result = mysqli_num_rows($query);

                                if($result > 0){ 
                                    while ($data = mysqli_fetch_assoc($query)) { ?>

                                        <option value="<?php echo (int)$data['id'] ?>">
                                        <?php echo $data['nombre_categoria'] ?></option>
                                    <?php }
                                }?>
                            </select>
                        </div>
                    </div>
                </div>         
            </div>
            <div class="modal-footer" style="background-color: #D2FEDD;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-primary" name="registrar_producto">Registrar</button>
            </div>
        </form>
        </div>
    </div>
</div>  