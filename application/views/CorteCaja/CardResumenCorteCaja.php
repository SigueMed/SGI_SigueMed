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
                    <h4 class="card-title" id="basic-layout-form"><i class="icon-book"></i>Resumen Corte</h4>
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
                          <div class="row">
                              <div class="col-md-6">

                                  <!--TABLA MOVIMIENTOS CUENTA-->
                                  <div class="table-responsive table-striped table table-bordered">
                                      <table class="table" id="tblBalanceCuentas">
                                          <thead class="thead-inverse">
                                              <tr>
                                                  <th>Cuenta</th>
                                                  <th>Total Entradas</th>
                                                  <th>Total Salidas</th>
                                                  <th>Balance Cuenta</th>

                                              </tr>
                                          </thead>
                                          <tbody>
                                          </tbody>
                                      </table>
                                  </div>

                              </div>

                              <div class="row">
                                <div class="col-md-8">

                                   <!--TABLA MOVIMIENTOS CUENTA-->
                                   <div class="table-responsive table-striped table table-bordered">
                                       <table class="table" id="tblResumenTipoPago">
                                           <thead class="thead-inverse">
                                               <tr>
                                                   <th>Forma de Pago</th>
                                                   <th>Total Pagos</th>
                                                   <th>Total Entregado</th>
                                                   <th>Diferencia</th>

                                                 </tr>
                                           </thead>
                                           <tbody>
                                           </tbody>
                                       </table>
                                   </div>

                               </div>
                             </div>

                          </div>
                          <div class="row">
                              <div class="col-md-4">
                                  <div class="form-group">
                                      <label for="FechaCorte">Fecha y Hora:</label>
                                      <div class="position-relative has-icon-left">
                                          <input type="datetime-local" id="FechaCorte" class="form-control" name="FechaCorte" value="<?=$CorteCaja->FechaCorte?>" readonly/>
                                          <div class="form-control-position">
                                                  <i class="icon-calendar5"></i>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="turno">Turno:</label>
                                      <div class="position-relative has-icon-left">
                                          <input type="text" id="turno" class="form-control"  name="turno" value="<?=$CorteCaja->DescripcionTurno?>" readonly>
                                          <div class="form-control-position">
                                                  <i class="icon-clock5"></i>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-5">
                                  <div class="form-group">
                                      <label for="EmpleadoCorte">Responsable Corte:</label>
                                      <div class="position-relative has-icon-left">
                                          <input type="text" id="EmpleadoCorte" class="form-control"  name="EmpleadoCorte" value="<?=$CorteCaja->Responsable?>" readonly>
                                          <div class="form-control-position">
                                                  <i class="icon-user"></i>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                           <h4 class="form-section"><i class="icon-clipboard4"></i> Balance Corte</h4>
                          <div class="row">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="TotalEntradas">Total Entradas:</label>
                                      <div class="input-group">
                                          <span class="input-group-addon">$</span>
                                          <input type="text" id="TotalEntradas" name="TotalEntradas" class="form-control" readonly value="<?=$CorteCaja->TotalEntradas?>" />
                                       </div>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="TotalSalidas">Total Salidas:</label>
                                      <div class="input-group">
                                          <span class="input-group-addon">$</span>
                                          <input type="text" id="TotalSalidas" name="TotalSalidas" class="form-control" placeholder="Total Salidas" readonly value="<?=$CorteCaja->TotalSalidas?>" />
                                       </div>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="TotalCorte">Balance Corte:</label>
                                      <div class="input-group">
                                          <span class="input-group-addon">$</span>
                                          <input type="text" id="BalanceCorte" name="BalanceCorte" class="form-control" placeholder="Total Balance" readonly value="<?=$CorteCaja->TotalCorte?>" />
                                       </div>
                                  </div>
                              </div>


                          </div>


                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="ComentariosCorte">Comentarios:</label>
                                      <div class="position-relative has-icon-left">
                                          <input type="text" id="ComentariosCorte" class="form-control" placeholder="Comentarios..." name="ComentariosCorte" value="<?=$CorteCaja->Comentarios?>" readonly>
                                          <div class="form-control-position">
                                          <i class="icon-chatbox-working"></i>
                                          </div>
                                      </div>


                                  </div>
                              </div>
                          </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>

</div>

<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form"><i class="icon-book"></i>Detalle Movimientos</h4>
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
                          <div class="row">
                              <div class="col-md-12">

                                  <!--TABLA MOVIMIENTOS CUENTA-->
                                  <div class="table-responsive table-striped table table-bordered">
                                      <table class="table" id="tblDetalleMovimientosCuentaCorte">
                                          <thead class="thead-inverse">
                                              <tr>
                                                  <th>Nota Remisión</th>
                                                  <th>Fecha Nota</th>
                                                  <th>Paciente</th>
                                                  <th>Tipo Movimiento</th>
                                                  <th>Cuenta</th>

                                                  <th>Total Movimiento</th>
                                                  <th>Forma Pago</th>

                                                  <th>Id Salida</th>

                                              </tr>
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
            </div>
        </div>

</div>

<script type="text/javascript">
    $(document).ready(function(){
      CargarBalanceCuentas();
      CargarDetalleMovimientosCuenta();
      CargarDetalleTipoPagoCorte();
    });

    function CargarBalanceCuentas()
    {
        $.ajax({
            url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarBalanceCorteCuentas",
            data:{
              IdCorteCaja: <?=$CorteCaja->IdCorteCaja?>
            },

            method:"POST",
            success: function(data)
              {

                  var BalanceCuenta = JSON.parse(data);

                  $("#tblBalanceCuentas tbody tr").remove();
                  var TotalEntradas= 0;
                  var TotalSalidas = 0;

                  for (i=0; i<BalanceCuenta.length;i++)
                  {

                      TotalEntradas += parseFloat(BalanceCuenta[i]['TotalEntradas']);
                      TotalSalidas += parseFloat(BalanceCuenta[i]['TotalSalidas']);

                      $('#tblBalanceCuentas').append(
                          '<tr>'+
                          '<td>'+BalanceCuenta[i]['DescripcionCuenta']+'</td>'+
                          '<td>'+BalanceCuenta[i]['TotalEntradas']+'</td>'+
                          '<td>'+BalanceCuenta[i]['TotalSalidas']+'</td>'+
                          '<td>$'+BalanceCuenta[i]['Balance']+'</td>'+
                          '</tr>'
                      );
                  }




              }
          });
    }

    function CargarResumenTipoPago()
    {
        $.ajax({
            url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarResumenEntradas",
            data:{
              IdCorteCaja : <?=$CorteCaja->IdCorteCaja?>
            },

            method:"POST",
            success: function(data)
              {

                  var ResumenTipoPago = JSON.parse(data);

                  $("#tblResumenTipoPago tbody tr").remove();

                  for (i=0; i<ResumenTipoPago.length;i++)
                  {

                      $('#tblResumenTipoPago').append(
                          '<tr>'+
                          '<td>'+ResumenTipoPago[i]['DescripcionTipoPago']+'</td>'+
                          '<td>$'+ResumenTipoPago[i]['TotalTipoPago']+'</td>'+
                          '</tr>'
                      );
                  }


              }
          });
    }

    function CargarDetalleMovimientosCuenta() {

      var t = $('#tblDetalleMovimientosCuentaCorte').DataTable({
        "drawCallback": function( settings ) {
                $('[data-toggle="tooltip"]').tooltip();
              },
          "ajax":{
              url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarDetalleMovimientosCuentaPorCorte_ajax",
              data:{IdCorteCaja:<?=$CorteCaja->IdCorteCaja?>},
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
                    return "<a href='<?=site_url()?>/NotaRemision/CargarNotaRemision/"+data+"''>"+data+"</a>";
                }
              }

            ],
            "columns": [
                  // {
                  //     "className":      'details-control',
                  //     "orderable":      false,
                  //     "data":           null,
                  //     "defaultContent": ''
                  // },
                  // <th>Nota Remisión</th>
                  // <th>Fecha Nota</th>
                  // <th>Paciente</th>
                  // <th>Tipo Movimiento</th>
                  // <th>Cuenta</th>
                  //
                  // <th>Total Movimiento</th>
                  // <th>Forma Pago</th>
                  //
                  // <th>Id Salida</th>
                  { "data": "IdNotaRemision"},
                  { "data": "FechaNotaRemision" },
                  { "data": "Paciente" },
                  { "data": "DescripcionTipoMovimientoCuenta" },
                  { "data": "DescripcionCuenta" },
                  { "data": "TotalMovimiento" },
                  { "data": "DescripcionTipoPago" },
                  { "data": "IdSalidaCaja" }


                  ]

          });

    }
    function CargarDetalleTipoPagoCorte() {

      var t = $('#tblResumenTipoPago').DataTable({
        "drawCallback": function( settings ) {
                $('[data-toggle="tooltip"]').tooltip();
              },
          "ajax":{
              url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarDetalleTipoPago_ajax",
              data:{IdCorteCaja:<?=$CorteCaja->IdCorteCaja?>},
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
                "targets":3, "data":"TotalEntregado" ,"render":function(data,type,row,meta)
                {


                  //console.log(row['TotalCorteCaja']);
                    return data - row['TotalCorteCaja'];
                }
              }

            ],
            "columns": [

                  { "data": "DescripcionTipoPago"},
                  { "data": "TotalCorteCaja" },
                  { "data": "TotalEntregado" }




                  ]

          });

    }

</script>
