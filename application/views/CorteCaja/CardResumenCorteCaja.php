<style>
    .table-smallfont{
        font-size: 12px;
    }
</style>

<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form"><i class="icon-book"></i>Detalle Corte</h4>
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
                 <div class="card-body collapse in">
                    <div class="card-block">
                        <!--FORM BODY-->
                        <div class="form-body"> 
                            <table class="table table-striped table-bordered table-smallfont table-sm" style="width:100%" id="tblDetalleServiciosCorte" >
                                <thead class="table-inverse">
                                    <th>Servicio</th>
                                    <th>Producto ó Servicio</th>
                                    <th>Cantidad</th>
                                    

                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    
</div>

<script type="text/javascript">
    $(document).ready(function(){
        CargarResumenProducto();
    });
    function CargarResumenProducto()
    {
        var t = $('#tblDetalleServiciosCorte').DataTable({
            "ajax":{
                url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarResumenProducto_ajax",
                method:"POST",
                dataSrc: ""
            },

             "destroy":true,
             "language": {
                  "lengthMenu": "Mostrando _MENU_ registros por pag.",
                  "zeroRecords": "Sin Datos - disculpa",
                  "info": "Motrando pag. _PAGE_ de _PAGES_",
                  "infoEmpty": "Sin registros disponibles",
                  "infoFiltered": "(filtrado de _MAX_ total)"
              },
              
              "columns": [
                    { "data": "DescripcionServicio" },
                    { "data": "DescripcionProducto" },
                    { "data": "TotalProducto" },
                    

                    ]

            });

         
         
         
    
    }
   
</script>

