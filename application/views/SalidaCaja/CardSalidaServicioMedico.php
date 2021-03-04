<div class="row match-height">
    <div class="col-md-12">
        <div class="card">
            <!--CARD HEADER-->
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form"><i class="icon-inbox"></i>Pagar Servicio Médico    </h4>
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
                                    <label for="cbCuentaSalida">Cuenta</label>
                                    <select id="cbCuentaSalida" name="cbCuentaSalida" class="form-control" onchange="SeleccionarCuenta()">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="DescripcionCuenta">Nombre Cuenta:</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="DescripcionCuenta" class="form-control" placeholder="Proveedor" name="NombreProveedor" readonly>
                                        <div class="form-control-position">
                                        <i class="icon-bankcard"></i>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="EmpleadoCuenta">Propietario Cuenta:</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="EmpleadoCuenta" class="form-control" placeholder="Proveedor" name="NombreProveedor" readonly>
                                        <div class="form-control-position">
                                        <i class="icon-user-tie"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ServicioCuenta">Servicio Cuenta:</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="ServicioCuenta" class="form-control" placeholder="Proveedor" name="NombreProveedor" readonly>
                                        <div class="form-control-position">
                                        <i class="icon-home3"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <h4 class="form-section"><i class="icon-clipboard4"></i> Detalle Movimientos</h4>
                        <!--TABLA MOVIMIENTOS CUENTA-->
                        <div class="table-responsive">
                            <table class="table" id="tablaMovimientosCuenta">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Fecha Pago</th>
                                        <th>Movimiento</th>
                                        <th>Tipo Pago</th>
                                        <th>Total</th>
                                        <th>Nota Remision</th>
                                        <th>Fecha Nota Rem.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <h4 class="form-section"><i class="icon-clipboard4"></i> Resumen Salida</h4>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ComentariosSalida">Comentarios:</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="ComentariosSalida" class="form-control" placeholder="Comentarios" name="ComentariosSalida">
                                        <div class="form-control-position">
                                        <i class="icon-pencil2"></i>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="TotalSalida">Total a Pagar:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="TotalSalida" name="TotalSalida" class="form-control" placeholder="Total a Pagar"/>
                                     </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="TotalTarjetaCredito">Total Tarjeta de Crédito:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="TotalTarjetaCredito" name="TotalTarjetaCredito" class="form-control" placeholder="Total a Pagar" readonly />
                                     </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="TotalTransferencias">Total Transferencias:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="TotalTransferencias" name="TotalTransferencias" class="form-control" placeholder="Total a Pagar" readonly />
                                     </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="TotalCuenta">Total en Cuenta:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" id="TotalCuenta" name="TotalCuenta" class="form-control" placeholder="Total a Pagar" readonly />
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions" align="center">
                        <button type="submit" class="btn btn-warning mr-1" name="action" value="cerrar">
                        <i class="icon-cross2"></i> Cerrar
                        </button>
                         <button type="submit" class="btn btn-success mr-1" name="action" value="RegistrarSalida">
                        <i class="icon-check2"></i> Pagar
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function(){
        CargarCuentas();
    });

    function CargarCuentas()
    {
        $.ajax({
                  url:"<?php echo site_url();?>/SalidaCaja_Controller/ConsultarCuentas",
                  method:"POST",

                  success: function(data)
                    {
                        $('#cbCuentaSalida').html(data);

                    }
              });
    }

    function SeleccionarCuenta()
    {

        var IdCuenta = $("#cbCuentaSalida").val();
        $.ajax({
                  url:"<?php echo site_url();?>/SalidaCaja_Controller/ConsultarCuentaPorId_ajax",
                  method:"POST",
                  data:{IdCuenta:IdCuenta},

                  success: function(data)
                    {
                        var DatosCuenta = JSON.parse(data);
                        $("#DescripcionCuenta").val(DatosCuenta['DescripcionCuenta']);
                        $("#EmpleadoCuenta").val(DatosCuenta['PropietarioCuenta']);
                        $("#ServicioCuenta").val(DatosCuenta['DescripcionServicio']);
                        CargarDetalleMovimientosCuenta(IdCuenta);
                        ConsultarTotalEfectivo(IdCuenta);



                    }
              });

    }

    function CargarDetalleMovimientosCuenta(IdCuenta)
    {

        $.ajax({
                  url:"<?php echo site_url();?>/SalidaCaja_Controller/ConsultarDetalleMovimientosCuenta_ajax",
                  method:"POST",
                  data:{IdCuenta:IdCuenta},

                  success: function(data)
                    {
                        var MovimientosCuenta = JSON.parse(data);

                         var t = $('#tablaMovimientosCuenta').DataTable({
                               "destroy":true,
                               "language": {
                                    "lengthMenu": "Mostrando _MENU_ registros por pag.",
                                    "zeroRecords": "Sin Movimientos - disculpa",
                                    "info": "Motrando pag. _PAGE_ de _PAGES_",
                                    "infoEmpty": "Sin registros disponibles",
                                    "infoFiltered": "(filtrado de _MAX_ total)"
                                }

                                });
                        t.clear();
                        t.draw();

                        var TotalSalida =0;
                        for (i=0;i<MovimientosCuenta.length;i++)
                        {
                            t.row.add([
                               MovimientosCuenta[i]['FechaPago'],
                               MovimientosCuenta[i]['DescripcionTipoMovimientoCuenta'],
                               MovimientosCuenta[i]['DescripcionTipoPago'],
                               MovimientosCuenta[i]['TotalMovimiento'],
                               MovimientosCuenta[i]['IdNotaRemision'],
                               MovimientosCuenta[i]['FechaNotaRemision']

                           ]).draw(false);

                           TotalSalida +=  parseFloat(MovimientosCuenta[i]['TotalMovimiento'])

                        }

                    }
              });

    }

    function ConsultarTotalEfectivo(IdCuenta)
    {

        var totalCuenta =0;

         $.ajax({
            url:"<?php echo site_url();?>/SalidaCaja_Controller/ConsultarTotalMovimientosCuenta_ajax",
            method:"POST",
            async: false,
            data:{
                IdCuenta:IdCuenta,
                EstatusMovimiento: <?php echo MC_PENDIENTEPAGO;?>,
                TipoPago: <?php echo TIPOPAGO_EFECTIVO;?>
                },

            success: function(data)
              {
                  var TotalEfectivo = JSON.parse(data);

                  $("#TotalSalida").val(TotalEfectivo['TotalTipoPago']);
                  totalCuenta += parseFloat(TotalEfectivo['TotalTipoPago']);
              }
          });

          $.ajax({
            url:"<?php echo site_url();?>/SalidaCaja_Controller/ConsultarTotalMovimientosCuenta_ajax",
            method:"POST",
            async: false,
            data:{
                IdCuenta:IdCuenta,
                EstatusMovimiento: <?php echo MC_PENDIENTEPAGO;?>,
                TipoPago: <?php echo TIPOPAGO_TARJETACREDITO;?>
                },

            success: function(data)
              {
                  var TotalEfectivo = JSON.parse(data);

                  if (TotalEfectivo['TotalTipoPago'] !== null)
                  {
                    $("#TotalTarjetaCredito").val(TotalEfectivo['TotalTipoPago']);

                    totalCuenta += parseFloat(TotalEfectivo['TotalTipoPago']);

                  }
                  else
                  {
                     $("#TotalTarjetaCredito").val(0);

                  }
              }
          });

          $.ajax({
            url:"<?php echo site_url();?>/SalidaCaja_Controller/ConsultarTotalMovimientosCuenta_ajax",
            method:"POST",
            async: false,
            data:{
                IdCuenta:IdCuenta,
                EstatusMovimiento: <?php echo MC_PENDIENTEPAGO;?>,
                TipoPago: <?php echo TIPOPAGO_TRANSFERENCIA;?>
                },

            success: function(data)
              {
                  var TotalEfectivo = JSON.parse(data);

                  if (TotalEfectivo['TotalTipoPago'] !== null)
                  {
                    $("#TotalTransferencias").val(TotalEfectivo['TotalTipoPago']);

                    totalCuenta += parseFloat(TotalEfectivo['TotalTipoPago']);

                  }
                  else
                  {
                     $("#TotalTransferencias").val(0);

                  }
              }
          });

          $("#TotalCuenta").val(totalCuenta);
    }


</script>
