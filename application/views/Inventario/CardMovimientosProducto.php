<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Detalle Movimientos</h4>
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
                            <table id="Table_DetalleMovimientosProducto" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No. Factura</th>
                                            <th>Lote</th>
                                            <th>Tipo Movimiento</th>
                                            <th>Fecha Movimiento</th>
                                            <th>Cantidad</th>  
                   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                            foreach($MovimientosInventario as $Movimiento)
                                            {
                                                echo'<tr>';
                                                echo'<td>'.$Movimiento['NumeroFactura'].'</td>';
                                                echo'<td>'.$Movimiento['Lote'].'</td>';
                                                echo'<td>'.$Movimiento['DescripcionTipoMovimientoInventario'].'</td>';
                                                echo'<td>'.$Movimiento['FechaMovimiento'].'</td>';
                                                echo'<td>'.$Movimiento['CantidadMovimiento'].'</td>';
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
        $("#Table_DetalleMovimientosProducto").DataTable();
    });
    
   
</script>
