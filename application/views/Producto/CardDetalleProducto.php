<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Información del Producto</h4>
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
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cbServicioProducto">Servicio</label>
                                        <select id="cbServicioProducto" name="cbServicioProducto" class="form-control">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-8">
                                            <div class="form-group">
                                                    <label for="DescripcionProducto">Nombre Producto</label>
                                                    <input type="text" name="DescripcionProducto" id="DescripcionProducto" class="form-control" placeholder="Descripción Producto"/>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                            <div class="form-group">
                                                    <label for="CostoProducto">Precio Publico</label>
                                                    <div class="input-group">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" id="CostoProducto" class="form-control square" placeholder="Costo" aria-label="Costo" name="CostoProducto">
                                                    
                                            </div>
                                            </div>
                                    </div>
                            </div>
                            
                        </div>
                        <!-- FORM ACTIONS-->
                        <div class="form-actions">
                            <?php
                                if($ProductoActionsEnabled == true)
                                {
                                    echo '<button type="submit" class="btn btn-warning mr-1" name="action" value="cerrar">';
                                    echo '<i class="icon-cross2"></i> Cerrar';
                                    echo '</button>';
                                    if($ProductoCancelActionEnabled==true)
                                    {
                                        echo '<button type="submit" class="btn btn-danger mr-1" name="action" value="'.$ProductoCancelAction.'">';
                                        echo '<i class="icon-cross2"></i>'.$ProductoCancelTitle;
                                        echo '</button>';
                                        
                                    }
                                    
                                    echo '<button type="submit" class="btn btn-success" name="action" value='.$ProductoSubmitAction.'>';
                                    echo '<i class="icon-check2"></i>'.$ProductoSubmitTitle;
                                    echo '</button>';
                                }
                            ?>
                                
                                
                        </div>
                    </div>
                </div>
            </div><!--DIV CARD-->
        </div><!--DIV COL-MD-->
</div><!--DIV ROW MATCH-->

<script type="text/javascript">
    $(document).ready(function(){
        CargarServicios();
       CargarValores(); 
    });
    
    function CargarValores()
    {
        var DatosProducto = <?= json_encode($InformacionProducto)?>;
        if (DatosProducto !== null)
        {
            $('#cbServicioProducto').val(DatosProducto['IdServicio']);
            $("#DescripcionProducto").val(DatosProducto['DescripcionProducto']);
            $("#CostoProducto").val(DatosProducto['CostoProducto']);
        }
        else
        {
            $("#DescripcionProducto").val();
            $("#CostoProducto").val();
        }

        
    }
    
    function CargarServicios()
    {
         $.ajax({
                  url:"<?php echo site_url();?>/CatalogoProductos_Controller/ConsultarServicios_ajax",
                  method:"POST",
                  
                  success: function(data)
                    {
                        $('#cbServicioProducto').html(data);
                        
                         var DatosProducto = <?= json_encode($InformacionProducto)?>;
                        if (DatosProducto !== null)
                        {
                            $('#cbServicioProducto').val(DatosProducto['IdServicio']);
                            $('#cbServicioProducto').prop('disabled','disabled');
                        }

                    }
              });
    }
</script>