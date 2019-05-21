<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Detalle Existencia</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                    <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                                    <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                    <li><a data-action="close"><i class="icon-cross2"></i></a></li>
                            </ul>
                    </div>
                    

                </div>
                <!--CARD BODY-->
                <div class="card-body collapse in">
                    <div class="card-block">
                        <!--FORM BODY-->
                        <div class="form-body">   
                            <table id="DetalleInventarioSubProductos" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Proveedor</th>
                                            <th>Nombre SubProducto</th>
                                            <th>Lote</th>
                                            <th>Precio</th>
                                            <th>Fecha Caducidad</th>  
                                            <th>Existencia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                            foreach($SubProductos as $SubProducto)
                                            {
                                                echo'<tr>';
                                                echo'<td>'.$SubProducto['NombreProveedor'].'</td>';
                                                echo'<td>'.$SubProducto['NombreSubProducto'].'</td>';
                                                echo'<td>'.$SubProducto['Lote'].'</td>';
                                                echo'<td>'.$SubProducto['Costo'].'</td>';
                                                echo'<td>'.$SubProducto['FechaCaducidad'].'</td>';
                                                echo'<td>'.$SubProducto['CantidadInventario'].'</td>';
                                                
                                                echo '</tr>';

                                            }
                                        ?>

                                       


                                    </tbody>

                                </table>
                            </div>
                        
                    </div>
                </div>
            </div><!--DIV CARD-->
        </div><!--DIV COL-MD-->
</div><!--DIV ROW MATCH-->
<script>
    $(document).ready(function(){
        $("#DetalleInventarioSubProductos").DataTable();
    });
</script>
