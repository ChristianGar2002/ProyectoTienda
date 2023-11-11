<?php
  require_once '../conexion.php';
  
?>
<div class="modal fade" id="ActualizarProductoModal<?php echo $data['codigo_producto']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<?php
    $codigo_producto = $data['codigo_producto'];

    $sql6= "SELECT * FROM productos WHERE codigo_producto = {$codigo_producto} and ACTIVO='1'";
    $result6= $conex->query($sql6);

    $data6= $result6->fetch_assoc();

?>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center bg-success" style="text-align: center;">
                <h5 class="modal-title text-white text-center" id="exampleModalLabel">Actualizar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form action="actualizar_producto2.php" method="POST">    
            <div class="modal-body text-center" style="background-color: #E5E5E5;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Decripción:</b></label>
                            <textarea class="form-control text-center" id="exampleFomrControlTextarea1" cols="2" name="descripcion_producto" placeholder="Descripción del producto" value="<?php echo $data6['descripcion_producto']?>" style="resize: none;text-align: center;" required> <?php echo $data6['descripcion_producto']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Precio de compra:</b></label>
                            <input step="0.01" type="number" max="99999.99" class="form-control text-center" placeholder="Precio de compra" name="precio_compra" value="<?php echo $data6['precio_compra']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Precio de venta:</b></label>
                            <input step="0.01" type="number" max="99999.99" class="form-control text-center" placeholder="Precio de venta" name="precio_venta" value="<?php echo $data6['precio_venta']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Cantidad:</b></label>
                            <input type="number" max="999"class="form-control text-center" placeholder="Cantidad" name="cantidad" value="<?php echo $data6['cantidad']?>" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Proveedor:</b></label>
                            <input type="text" class="form-control text-center" placeholder="Proveedor" name="proveedor" value="<?php echo $data6['proveedor']?>" required>
                        </div>
                    </div>
                        <?php
                            $conexion=mysqli_connect('localhost', 'root', '', 'tienda');
                        ?>
                    <div class="col-lg-6"> 
                        <div class="form-group" id="user-group">
                            <label style="font-size: 16px;"><b>Categoria:</b></label>
                            <select name="categoria_id" class="form-control text-center" class="form-control" placeholder="Rol" required>
                                <option value="<?php echo $data6['categoria_id']; ?>">Categorias: </option>
                                <?php 
                                $resultado = mysqli_query($conexion, "SELECT * FROM categorias")
                                                                ?>
                                <?php foreach($resultado as $item):?>

                                    <option value="<?php echo (int)$item['id'] ?>">
                                        <?php echo $item['nombre_categoria'] ?></option>
                                <?php endforeach; ?>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <input type="hidden" name="codigo_producto" value="<?php echo $data['codigo_producto']?>"/>
                        </div>
                    </div>
                </div>         
            </div>
            <div class="modal-footer" style="background-color: #D2FEDD;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-success" name="actualizar_producto">Actualizar</button>
            </div>
        </form>
        </div>
    </div>
</div>  