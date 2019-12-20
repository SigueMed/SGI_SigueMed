<div class="row match-height">
    <div class="col-md-12">
        <div class="card">
            <!--CARD HEADER-->
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form"><i class="icon-inbox"></i>Corte de Caja - <?=$Cuenta->DescripcionCuenta?></h4>
                <input type="hidden" name="IdCuenta" id="IdCuenta" value="<?=$IdCuenta?>">
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
                            <div class="col-md-8">

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

                       <div class="row">
                         <div class="col-md-2">
                           <div class="form-group">
                             <label for="TotalEntradas">Total Entradas</label>
                             <div class="input-group">
                               <span class="input-group-addon">$</span>
                               <input type="text" id="TotalEntradas" name="TotalEntradas"  value ="0" class="form-control"/>
                             </div>

                           </div>


                         </div>
                         <div class="col-md-2">
                           <div class="form-group">
                             <label for="TotalSalidas">Total Salidas</label>
                             <div class="input-group">
                               <span class="input-group-addon">$</span>
                               <input type="text" id="TotalSalidas" name="TotalSalidas"  value ="0" class="form-control"/>
                             </div>

                           </div>


                         </div>
                         <div class="col-md-2">
                           <div class="form-group">
                             <label for="BalanceCorte">Balance Corte</label>
                             <div class="input-group">
                               <span class="input-group-addon">$</span>
                               <input type="text" id="BalanceCorte" name="BalanceCorte"  value ="0" class="form-control"/>
                             </div>

                           </div>


                         </div>
                       </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="FechaCorte">Fecha y Hora:</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="datetime-local" id="FechaCorte" class="form-control" name="FechaCorte" value="<?php echo mdate('%Y-%m-%dT%H:%i:%s',now());?>" readonly/>
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
                                        <input type="text" id="turno" class="form-control"  name="turno" value="<?php echo $this->session->userdata('Turno');?>" readonly>
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
                                        <input type="text" id="EmpleadoCorte" class="form-control"  name="EmpleadoCorte" value="<?php echo $this->session->userdata('NombreUsuario');?>" readonly>
                                        <div class="form-control-position">
                                                <i class="icon-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ComentariosCorte">Comentarios:</label>
                                    <div class="position-relative has-icon-left">
                                        <input type="text" id="ComentariosCorte" class="form-control" placeholder="Comentarios..." name="ComentariosCorte">
                                        <div class="form-control-position">
                                        <i class="icon-chatbox-working"></i>
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
<div class="row match-height">
        <div class="col-md-12">
            <div class="card">
                <!--CARD HEADER-->
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form"><i class="icon-book"></i>Detalle Notas Remisión</h4>
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
        CargarResumenTipoPago();
        CargarDetalleNotasCorte()

    });


    function CargarBalanceCuentas()
    {
        $.ajax({
            url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarBalanceCorteCuentas",
            data:{
              IdCuenta: <?=$IdCuenta?>
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

                  $("#TotalEntradas").val(TotalEntradas);
                  $("#TotalSalidas").val(TotalSalidas);
                  var Balance = TotalEntradas - TotalSalidas;
                  $("#BalanceCorte").val(Balance);


              }
          });
    }

    function CargarResumenTipoPago()
    {
        $.ajax({
            url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarResumenEntradas",
            data:{
              IdCuenta : <?=$IdCuenta?>
            },

            method:"POST",
            success: function(data)
              {

                  var ResumenTipoPago = JSON.parse(data);
                  var MontosPago = <?=json_encode($MontosTipoPago)?>;

                  $("#tblResumenTipoPago tbody tr").remove();

                  for (i=0; i<ResumenTipoPago.length;i++)
                  {

                    var ValorPago = MontosPago.find(o=>o.IdTipoPago===ResumenTipoPago[i]['IdTipoPago']);


                    var TotalCorte = ResumenTipoPago[i]['TotalTipoPago'];

                    if (TotalCorte == null)
                    {
                      TotalCorte=0;
                    }

                    var Diferencia = ValorPago['Monto']-TotalCorte;



                      $('#tblResumenTipoPago').append(
                          '<tr>'+
                          '<td>'+ResumenTipoPago[i]['DescripcionTipoPago']+'</td>'+
                          '<td>$'+TotalCorte+'</td>'+
                          '<td>$'+ValorPago['Monto']+'</td>'+
                          '<td>'+
                            '<input type="hidden" name="IdTiposPago[]" value="'+ResumenTipoPago[i]['IdTipoPago']+'">'+
                            '<input type="hidden" name="TotalesCorte[]" value="'+TotalCorte+'">'+
                            '<input type="hidden" name="TotalesEntregado[]" value="'+ValorPago['Monto']+'">'+
                          '$'+Diferencia+'</td>'+
                          '</tr>'
                      );
                  }


              }
          });
    }

    function CalcularEfectivo()
    {

        var Efectivo = parseFloat($("#val_TotalCorteEfectivo").val());
        var Vales = 0;
        if ($("#TotalVales").val()!=="")
        {
            Vales = parseFloat($("#TotalVales").val());
        }


        Efectivo = Efectivo - Vales;
        $("#TotalCorteEfectivo").val(Efectivo);

    }
function CargarDetalleNotasCorte() {

  var IdCuenta = $("#IdCuenta").val();

  var t = $('#tblDetalleMovimientosCuentaCorte').DataTable({
    "drawCallback": function( settings ) {
            $('[data-toggle="tooltip"]').tooltip();
          },
      "ajax":{
          url:"<?php echo site_url();?>/CorteCaja_Controller/ConsultarDetalleMovimientosCuentaSinCorte_ajax",
          data:{IdCuenta: IdCuenta},
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

</script>
