    
<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Consulta Inventario</h4>
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
                            <table id="Inventario" class="table table-striped table-bordered" style="width:80%">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Existencia</th>
                                            <th>Detalles</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                            foreach($ProductosInventario as $ProductoInventario)
                                            {
                                                echo'<tr>';
                                                echo'<td>'.$ProductoInventario['DescripcionProducto'].'</td>';
                                                echo'<td>'.$ProductoInventario['Existencia'].'</td>';
                                               
                                                echo'<td align="center"><a href="'.site_url('Inventario/ConsultarDetalleProducto/'.$ProductoInventario['IdProducto']).'"><i class="icon-clipboard3"></i></a></td>';
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

<script type="text/javascript">
    $(document).ready(function() {
    $('#Inventario').DataTable();
} );
</script>

