<form class="form-ajax" data-url="<?= site_url(); ?>/Proveedor_Controller/AplicarPagoProveedor"
	id="form_RegistrarPagoProveedor">

<div class="row match-height">
    <div class="col-md-12">
        <div class="card">
            <!--CARD HEADER-->
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form"><i class="icon-inbox"></i>Pagar a Proveedor</h4>
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
                                    <label for="cbServicioProveedor">Proveedor</label>
                                    <select id="cbServicioProveedor" name="cbServicioProveedor" class="form-control" onchange="SeleccionarProveedor()">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="DescripcionProveedor">Proveedor:</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="DescripcionProveedor" class="form-control" placeholder="Proveedor" readonly>
                                        <div class="form-control-position">
                                        <i class="icon-bankcard"></i>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>

                        <h4 class="form-section"><i class="icon-clipboard4"></i> Detalle Movimientos</h4>
                        <!--TABLA MOVIMIENTOS CUENTA-->
                        <div class="table-responsive">
                            <table class="table" id="tblMovimientosProveedor">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Nota Remisión</th>
                                        <th>Fecha Nota</th>
                                        <th>Producto</th>
                                        <th>Tipo Pago</th>
                                        <th>Total Proveedor</th>

                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <h4 class="form-section"><i class="icon-clipboard4"></i> Resumen Pago</h4>

                        <div class="table-responsive">
                            <table class="table" id="tblResumenTipoPagoProveedor" name="tblResumenTipoPagoProveedor">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Tipo Pago</th>
                                        <th>Total</th>


                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="TotalPagoProveedor">Total Pago:</label>

                              <div class="input-group">
                                  <span class="input-group-addon">$</span>
                                  <input type="text" id="TotalPagoProveedor" name="TotalPagoProveedor" class="form-control" readonly />
                               </div>
                            </div>

                          </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ComentariosPago">Comentarios:</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="ComentariosPago" class="form-control" placeholder="Comentarios" name="ComentariosPago">
                                        <div class="form-control-position">
                                        <i class="icon-pencil2"></i>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="form-actions" align="center">
                        <button type="submit" class="btn btn-warning mr-1" name="action" value="cerrar">
                        <i class="icon-cross2"></i> Cerrar
                        </button>
                         <button type="submit" class="btn btn-success mr-1" name="action" value="RegistrarPago">
                        <i class="icon-check2"></i> Pagar
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">

    $(document).ready(function(){
        CargarProveedores();

        $(document).on('submit', '.form-ajax', function(e){
              e.preventDefault();
              var $this = $(this);

              var data = $this.serialize();
              var action = document.activeElement.getAttribute('value');
              
              var url = $this.data('url');

              if (action=="RegistrarPago")
              {
                $.post(url, data).then(function(res){
                    if (res.error) {
                        Swal.fire('Error', res.message, 'error');
                    } else {
                        Swal.fire('Éxito', res.message, 'success');
                        $(".form-ajax")[0].reset();
                    }
                }).fail(function(){
                    Swal.fire('Error', 'Error al conectarse con el servidor', 'error');
                });

              }

              e.preventDefault();
          });
    });

    function CargarProveedores()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/CargaCatalogos_Controller/ConsultarServiciosProveedores_ajax",
                  method:"POST",

                  success: function(data)
                    {
                        $('#cbServicioProveedor').html(data);

                    }
              });
    }

    function SeleccionarProveedor()
    {

        var IdServicio = $("#cbServicioProveedor").val();
        $.ajax({
                  url:"<?php echo site_url();?>/Servicio_Controller/ConsultarServicioPorId_ajax",
                  method:"POST",
                  data:{IdServicio:IdServicio},

                  success: function(data)
                    {
                        var Servicio = JSON.parse(data);
                        $("#DescripcionProveedor").val(Servicio['DescripcionServicio']);
                        CargarDetalleMovimientosProveedor(IdServicio)
                        CargarResumenTipoPago(IdServicio);
                        CargarTotalPagoProveedor(IdServicio);
                    }
              });

    }

    function CargarDetalleMovimientosProveedor(IdProveedor)
    {
      var t = $('#tblMovimientosProveedor').DataTable({
        "drawCallback": function( settings ) {
                $('[data-toggle="tooltip"]').tooltip();
              },
          "ajax":{
              url:"<?php echo site_url();?>/Proveedor_Controller/ConsultarMovimientosProveedorSinPagar_ajax",
              data:{IdServicio:IdProveedor},
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
            "autoWidth":true,
            "columnDefs":[
              {
                "targets":0,"data":"IdNotaRemision","render":function(data,type,meta,row)
                {
                    return "<a href='<?=site_url()?>/NotaRemision/CargarNotaRemision/"+data+"' target='_blank'>"+data+"</a>";
                }
              }

            ],
            "columns": [

                  { "data": "IdNotaRemision"},
                  { "data": "FechaNotaRemision" },
                  { "data": "DescripcionProducto" },
                  { "data": "DescripcionTipoPago" },
                  { "data": "TotalProveedor" }
                  ]
          });


    }

    function CargarResumenTipoPago(IdProveedor)
    {
      var t = $('#tblResumenTipoPagoProveedor').DataTable({
        "drawCallback": function( settings ) {
                $('[data-toggle="tooltip"]').tooltip();
              },
          "ajax":{
              url:"<?php echo site_url();?>/Proveedor_Controller/ConsultarResumenTipoPagoProveedor_ajax",
              data:{IdServicio:IdProveedor},
              method:"POST",
              dataSrc: ""
          },
          "searching": false,
          "paging": false,
           "destroy":true,
           "language": {
                "lengthMenu": "Mostrando _MENU_ registros por pag.",
                "zeroRecords": "Sin Datos - disculpa",
                "info": "Motrando pag. _PAGE_ de _PAGES_",
                "infoEmpty": "Sin registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ total)"
            },
            "autoWidth":true,
            "columnDefs":[],
            "columns": [

                  { "data": "DescripcionTipoPago"},
                  { "data": "TotalPago" }
                  ]

          });


    }

    function CargarTotalPagoProveedor(IdProveedor) {

      $.ajax({
        url: '<?php echo site_url();?>/Proveedor_Controller/ConsultarTotalPagoProveedor_ajax',
        type: 'POST',
        data: {IdProveedor: IdProveedor}
      })
      .done(function(data) {
        var TotalPago = JSON.parse(data);

        $("#TotalPagoProveedor").val(TotalPago);

      })
      .fail(function() {
        console.log("error");
      });


    }




</script>
